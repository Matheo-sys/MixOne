/**
 * CARTE INTERACTIVE — Leaflet.js + OpenStreetMap
 */

(function() {
    'use strict';

    /**
     * Charge un script de manière asynchrone
     */
    function _loadScript(src, cb) {
        var s = document.createElement('script');
        s.src = src;
        s.onload = cb;
        s.onerror = function() { console.warn('[Carte] Erreur de chargement :', src); };
        document.head.appendChild(s);
    }

    /**
     * Initialise le système de cartographie
     */
    function _initMapSystem() {
        const mapEl = document.getElementById('studios-map');
        if (!mapEl) return;

        const _studiosData = JSON.parse(mapEl.getAttribute('data-studios') || '[]');
        const _validStudios = _studiosData.filter(s => s.lat && s.lng && s.lat !== 0 && s.lng !== 0);
        const _defaultImg = mapEl.getAttribute('data-default-img');

        // Récupérer la position de l'utilisateur si elle existe dans les champs du formulaire
        const userLatInput = document.querySelector('input[name="latitude"]');
        const userLngInput = document.querySelector('input[name="longitude"]');
        const userLat = userLatInput ? parseFloat(userLatInput.value) : null;
        const userLng = userLngInput ? parseFloat(userLngInput.value) : null;

        var map = null;
        var mapReady = false;

        /**
         * Construit la carte Leaflet
         */
        function buildMap() {
            if (mapReady) return;
            mapReady = true;

            // Centre initial (France ou position utilisateur)
            var lat = userLat || 46.6, lng = userLng || 1.9, zoom = (userLat ? 12 : 5);
            
            if (_validStudios.length === 1 && !userLat) {
                lat = _validStudios[0].lat; lng = _validStudios[0].lng; zoom = 14;
            } else if (_validStudios.length > 1 && !userLat) {
                lat = _validStudios.reduce(function(a,s){return a+s.lat;}, 0) / _validStudios.length;
                lng = _validStudios.reduce(function(a,s){return a+s.lng;}, 0) / _validStudios.length;
                zoom = 9;
            }

            map = L.map('studios-map', { center: [lat, lng], zoom: zoom });
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                maxZoom: 19
            }).addTo(map);

            // Icône Studio (Bleue)
            var blueIcon = L.divIcon({
                html: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 36" width="28" height="42"><path d="M12 0C5.37 0 0 5.37 0 12c0 9 12 24 12 24s12-15 12-24C24 5.37 18.63 0 12 0z" fill="#3554d1" stroke="#fff" stroke-width="1.5"/><circle cx="12" cy="12" r="5" fill="#fff"/></svg>',
                iconSize: [28,42], iconAnchor: [14,42], popupAnchor: [0,-44], className: ''
            });

            // Icône Utilisateur (Bonhomme Orange/Rouge)
            var userIcon = L.divIcon({
                html: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="36" height="36"><circle cx="12" cy="12" r="11" fill="#ff4d4d" stroke="#fff" stroke-width="2"/><path d="M12 11c1.66 0 3-1.34 3-3s-1.34-3-3-3-3 1.34-3 3 1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V18h14v-1.5c0-2.33-4.67-3.5-7-3.5z" fill="#fff"/></svg>',
                iconSize: [36,36], iconAnchor: [18,18], popupAnchor: [0,-20], className: ''
            });

            // Ajouter le marqueur utilisateur si position connue
            if (userLat && userLng) {
                L.marker([userLat, userLng], { icon: userIcon })
                    .addTo(map)
                    .bindPopup('<div style="font-weight:600; text-align:center;">Vous êtes ici 📍</div>')
                    .bindTooltip("Ma position", { permanent: false, direction: 'top' });
            }

            var cluster = L.markerClusterGroup({
                spiderfyOnMaxZoom: true,
                showCoverageOnHover: false,
                maxClusterRadius: 60,
                iconCreateFunction: function(c) {
                    return L.divIcon({
                        html: '<div style="background:#3554d1;color:#fff;width:40px;height:40px;border-radius:50%;border:3px solid #fff;box-shadow:0 2px 8px rgba(53,84,209,.4);display:flex;align-items:center;justify-content:center;font-size:14px;font-weight:700;">'+c.getChildCount()+'</div>',
                        iconSize: [40,40], className: ''
                    });
                }
            });

            _validStudios.forEach(function(s) {
                var eq = (s.equipment || []).slice(0, 3).join(', ');
                
                // URL Google Maps pour l'itinéraire
                // Si on a la position de l'utilisateur, on l'utilise comme origine
                var origin = (userLat && userLng) ? userLat + ',' + userLng : '';
                var gmapsUrl = 'https://www.google.com/maps/dir/?api=1&destination=' + s.lat + ',' + s.lng;
                if (origin) gmapsUrl += '&origin=' + origin;

                var html =
                    '<div style="width:220px;font-family:system-ui,sans-serif;">' +
                    '<img src="'+ s.image +'" style="width:100%;height:120px;object-fit:cover;display:block;" onerror="this.src=\''+ _defaultImg +'\'">' +
                    '<div style="padding:12px;">' +
                    '<div style="font-size:11px;color:#8695a4;margin-bottom:3px;">📍 '+ s.city +'</div>' +
                    '<div style="font-size:15px;font-weight:600;color:#051036;margin-bottom:6px;">'+ s.name +'</div>' +
                    (eq ? '<div style="font-size:11px;color:#666;margin-bottom:8px;">'+ eq +'…</div>' : '') +
                    '<div style="display:flex; flex-direction:column; gap:8px;">' +
                    '<div style="display:flex; align-items:center; justify-content:space-between;">' +
                    '<div><span style="font-size:17px;font-weight:700;color:#3554d1;">'+ parseFloat(s.price).toFixed(0) +'€</span><span style="font-size:11px;color:#8695a4;">/h</span></div>' +
                    '<a href="'+ s.url +'" style="background:#3554d1;color:#fff;padding:7px 14px;border-radius:6px;font-size:12px;font-weight:500;text-decoration:none;">Voir →</a>' +
                    '</div>' +
                    '<a href="'+ gmapsUrl +'" target="_blank" style="background:#f8f9fa; color:#051036; border:1px solid #e5e7eb; padding:6px; border-radius:6px; font-size:11px; font-weight:500; text-decoration:none; text-align:center; display:flex; align-items:center; justify-content:center; gap:5px;">' +
                    '<i class="icon-route text-14"></i> Itinéraire (Google Maps)' +
                    '</a>' +
                    '</div></div></div>';

                L.marker([s.lat, s.lng], { icon: blueIcon })
                    .bindPopup(html, { maxWidth: 240, className: 'studio-popup' })
                    .bindTooltip(s.name, { direction: 'top', offset: [0,-42] })
                    .addTo(cluster);
            });

            map.addLayer(cluster);

            if (_validStudios.length === 0 && !userLat) {
                document.getElementById('studios-map').innerHTML =
                    '<div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;background:#f8f9fa;color:#555;">' +
                    '<div style="font-size:48px;margin-bottom:12px;">🗺️</div>' +
                    '<div style="font-size:16px;font-weight:500;">Aucun studio géolocalisé</div></div>';
            }

            // Ajuster la vue pour englober tout le monde (utilisateur + studios)
            var boundsPoints = _validStudios.map(function(s){return [s.lat,s.lng];});
            if (userLat && userLng) boundsPoints.push([userLat, userLng]);

            if (boundsPoints.length > 1) {
                map.fitBounds(L.latLngBounds(boundsPoints), { padding: [40,40] });
            }
        }

        function openMap() {
            document.getElementById('mapFilter').style.display = 'flex';
            document.body.style.overflow = 'hidden';
            setTimeout(function() { buildMap(); if (map) map.invalidateSize(); }, 150);
        }

        function closeMap() {
            document.getElementById('mapFilter').style.display = 'none';
            document.body.style.overflow = '';
        }

        var closeBtn = document.getElementById('closeMapBtn');
        var overlay  = document.getElementById('mapOverlay');
        var openBtn  = document.getElementById('openMapBtn');
        if (closeBtn) closeBtn.addEventListener('click', closeMap);
        if (overlay)  overlay.addEventListener('click', closeMap);
        if (openBtn)  openBtn.addEventListener('click', function(e) { e.stopPropagation(); openMap(); });
        document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeMap(); });
    }

    document.addEventListener('DOMContentLoaded', function() {
        if (document.getElementById('studios-map')) {
            _loadScript('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', function() {
                _loadScript('https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js', function() {
                    _initMapSystem();
                });
            });
        }
    });
})();
