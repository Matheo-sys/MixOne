{{-- ============================================================
     CARTE INTERACTIVE — Leaflet.js + OpenStreetMap (100% gratuit)
     ============================================================ --}}

@php
$studioBaseUrl = url('/studio');
$studioMapData = $studios->map(function($s) use ($studioBaseUrl) {
    return [
        'id'        => $s->id,
        'name'      => $s->name,
        'city'      => $s->city,
        'address'   => $s->address,
        'price'     => (float) $s->hourly_rate,
        'lat'       => (float) $s->latitude,
        'lng'       => (float) $s->longitude,
        'image'     => $s->image1 ? asset('storage/' . $s->image1) : asset('media/img/backgrounds/11.jpg'),
        'url'       => $studioBaseUrl . '/' . $s->id,
        'equipment' => $s->equipment ?? [],
    ];
});
@endphp

{{-- Modal plein écran --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />

<div id="mapFilter"
     style="
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        z-index: 9000;
        display: none;
        align-items: center;
        justify-content: center;
     ">

    {{-- Fond flou — clic pour fermer --}}
    <div id="mapOverlay"
         style="
            position: absolute; inset: 0;
            background: rgba(5,16,54,.55);
            backdrop-filter: blur(3px);
         ">
    </div>

    {{-- Panneau carte --}}
    <div style="
            position: relative;
            width: min(96vw, 1380px);
            height: min(92vh, 860px);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 32px 80px rgba(0,0,0,.5);
            display: flex;
            flex-direction: column;
         ">

        {{-- En-tête --}}
        <div style="
                background: #fff;
                padding: 14px 22px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                border-bottom: 1px solid #e5e7eb;
                flex-shrink: 0;
             ">
            <div style="display:flex; align-items:center; gap:12px;">
                <span style="font-size:20px;">🗺️</span>
                <span style="font-size:17px; font-weight:600; color:#051036;">Studios sur la carte</span>
                <span style="
                        background: #eef2ff;
                        color: #3554d1;
                        font-size: 13px;
                        font-weight: 600;
                        padding: 3px 10px;
                        border-radius: 20px;
                    ">{{ count($studios) }}</span>
            </div>
            <button id="closeMapBtn" type="button"
                    style="
                        width:36px; height:36px;
                        border-radius:50%;
                        border:1px solid #e5e7eb;
                        background:#fff;
                        cursor:pointer;
                        font-size:16px;
                        color:#555;
                        display:flex; align-items:center; justify-content:center;
                    ">✕</button>
        </div>

        {{-- Carte Leaflet --}}
        <div id="studios-map" style="flex:1; width:100%; z-index:1;"></div>
    </div>
</div>

@push('scripts')
<script>
// Données PHP → JS
const _studiosData   = @json($studioMapData);
const _validStudios  = _studiosData.filter(s => s.lat && s.lng && s.lat !== 0 && s.lng !== 0);
const _defaultImg    = '{{ asset('media/img/backgrounds/11.jpg') }}';

// Chargement dynamique de Leaflet APRÈS les scripts du thème
function _loadScript(src, cb) {
    var s = document.createElement('script');
    s.src = src;
    s.onload = cb;
    s.onerror = function() { console.warn('[Map] Erreur chargement :', src); };
    document.head.appendChild(s);
}

_loadScript('https://unpkg.com/leaflet@1.9.4/dist/leaflet.js', function() {
    _loadScript('https://unpkg.com/leaflet.markercluster@1.5.3/dist/leaflet.markercluster.js', function() {
        _initMapSystem();
    });
});

function _initMapSystem() {
    var map = null;
    var mapReady = false;

    function buildMap() {
        if (mapReady) return;
        mapReady = true;

        // Centre initial
        var lat = 46.6, lng = 1.9, zoom = 5;
        if (_validStudios.length === 1) {
            lat = _validStudios[0].lat; lng = _validStudios[0].lng; zoom = 14;
        } else if (_validStudios.length > 1) {
            lat = _validStudios.reduce(function(a,s){return a+s.lat;}, 0) / _validStudios.length;
            lng = _validStudios.reduce(function(a,s){return a+s.lng;}, 0) / _validStudios.length;
            zoom = 9;
        }

        map = L.map('studios-map', { center: [lat, lng], zoom: zoom });
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 19
        }).addTo(map);

        // Icône bleue SVG
        var blueIcon = L.divIcon({
            html: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 36" width="28" height="42"><path d="M12 0C5.37 0 0 5.37 0 12c0 9 12 24 12 24s12-15 12-24C24 5.37 18.63 0 12 0z" fill="#3554d1" stroke="#fff" stroke-width="1.5"/><circle cx="12" cy="12" r="5" fill="#fff"/></svg>',
            iconSize: [28,42], iconAnchor: [14,42], popupAnchor: [0,-44], className: ''
        });

        // Clustering bleu
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
            var html =
                '<div style="width:220px;font-family:system-ui,sans-serif;">' +
                '<img src="'+ s.image +'" style="width:100%;height:120px;object-fit:cover;display:block;" onerror="this.src=\''+ _defaultImg +'\'">' +
                '<div style="padding:12px;">' +
                '<div style="font-size:11px;color:#8695a4;margin-bottom:3px;">📍 '+ s.city +'</div>' +
                '<div style="font-size:15px;font-weight:600;color:#051036;margin-bottom:6px;">'+ s.name +'</div>' +
                (eq ? '<div style="font-size:11px;color:#666;margin-bottom:8px;">'+ eq +'…</div>' : '') +
                '<div style="display:flex;align-items:center;justify-content:space-between;">' +
                '<div><span style="font-size:17px;font-weight:700;color:#3554d1;">'+ parseFloat(s.price).toFixed(0) +'€</span><span style="font-size:11px;color:#8695a4;">/h</span></div>' +
                '<a href="'+ s.url +'" style="background:#3554d1;color:#fff;padding:7px 14px;border-radius:6px;font-size:12px;font-weight:500;text-decoration:none;">Voir →</a>' +
                '</div></div></div>';

            L.marker([s.lat, s.lng], { icon: blueIcon })
                .bindPopup(html, { maxWidth: 240, className: 'studio-popup' })
                .bindTooltip(s.name, { direction: 'top', offset: [0,-42] })
                .addTo(cluster);
        });

        map.addLayer(cluster);

        if (_validStudios.length === 0) {
            document.getElementById('studios-map').innerHTML =
                '<div style="display:flex;flex-direction:column;align-items:center;justify-content:center;height:100%;background:#f8f9fa;color:#555;">' +
                '<div style="font-size:48px;margin-bottom:12px;">🗺️</div>' +
                '<div style="font-size:16px;font-weight:500;">Aucun studio géolocalisé</div>' +
                '<div style="font-size:13px;color:#999;margin-top:6px;">Les studios doivent avoir une adresse valide</div></div>';
        }

        if (_validStudios.length > 1) {
            map.fitBounds(L.latLngBounds(_validStudios.map(function(s){return [s.lat,s.lng];})), { padding: [40,40] });
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

    // Listeners
    var closeBtn = document.getElementById('closeMapBtn');
    var overlay  = document.getElementById('mapOverlay');
    var openBtn  = document.getElementById('openMapBtn');
    if (closeBtn) closeBtn.addEventListener('click', closeMap);
    if (overlay)  overlay.addEventListener('click', closeMap);
    if (openBtn)  openBtn.addEventListener('click', function(e) { e.stopPropagation(); openMap(); });
    document.addEventListener('keydown', function(e) { if (e.key === 'Escape') closeMap(); });
}
</script>

<style>
.studio-popup .leaflet-popup-content-wrapper { padding:0; border-radius:10px; overflow:hidden; box-shadow:0 8px 32px rgba(0,0,0,.18); }
.studio-popup .leaflet-popup-content { margin:0; width:auto !important; }
.studio-popup .leaflet-popup-tip { background:#fff; }
</style>
@endpush
