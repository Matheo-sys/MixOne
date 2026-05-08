/******/ (() => { // webpackBootstrap
/*!*******************************************!*\
  !*** ./resources/js/pages/home/search.js ***!
  \*******************************************/
/**
 * Logique de recherche de la page d'accueil
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    var hoursInput = document.getElementById('min_hours');
    var hoursValue = document.getElementById('hoursValue');
    var hoursMenu = document.getElementById('hoursMenu');
    var geolocateBtn = document.getElementById('geolocate-btn');

    /**
     * Met à jour TOUS les champs de recherche (ville, lat, lng) dans la page
     */
    function updateAllSearchFields(city, lat, lng) {
      document.querySelectorAll('input[name="city"]').forEach(function (el) {
        return el.value = city;
      });
      document.querySelectorAll('input[name="latitude"]').forEach(function (el) {
        return el.value = lat;
      });
      document.querySelectorAll('input[name="longitude"]').forEach(function (el) {
        return el.value = lng;
      });
    }

    /**
     * Bascule l'affichage du menu de sélection des heures
     */
    window.toggleHoursMenu = function (event) {
      event.stopPropagation();
      if (hoursMenu) hoursMenu.classList.toggle('hidden');
    };

    /**
     * Modifie le nombre d'heures minimum
     */
    window.changeHours = function (amount) {
      if (!hoursInput || !hoursValue) return;
      var currentValue = parseInt(hoursValue.textContent);
      if (!isNaN(currentValue)) {
        currentValue += amount;
        if (currentValue < 1) currentValue = 1;
        hoursValue.textContent = currentValue;
        // Mettre à jour tous les inputs d'heures (y compris les cachés)
        document.querySelectorAll('input[name="min_hours"]').forEach(function (el) {
          return el.value = currentValue;
        });
      }
    };

    // Fermer le menu si on clique ailleurs sur la page
    document.addEventListener('click', function (event) {
      if (hoursInput && hoursMenu && !hoursInput.contains(event.target) && !hoursMenu.contains(event.target)) {
        hoursMenu.classList.add('hidden');
      }
    });

    // Écouteur global pour la saisie manuelle de la ville
    document.addEventListener('input', function (e) {
      if (e.target.name === 'city') {
        // Si on tape manuellement, on vide les coordonnées pour forcer le géocodage serveur
        document.querySelectorAll('input[name="latitude"]').forEach(function (el) {
          return el.value = '';
        });
        document.querySelectorAll('input[name="longitude"]').forEach(function (el) {
          return el.value = '';
        });
        e.target.readOnly = false;
      }
    });

    /**
     * Logique de géolocalisation pour la barre de recherche
     */
    if (geolocateBtn) {
      geolocateBtn.addEventListener('click', function () {
        if (navigator.geolocation) {
          geolocateBtn.innerHTML = '<i class="icon-loading-2 text-16 rotate"></i>';
          navigator.geolocation.getCurrentPosition(function (position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;

            // Récupération du nom de la ville via notre proxy backend
            fetch("/studios/geocoder-inverse?lat=".concat(lat, "&lon=").concat(lng)).then(function (response) {
              return response.json();
            }).then(function (data) {
              var city = data.address.city || data.address.town || data.address.village || "Lieu inconnu";

              // Mise à jour de tous les formulaires de la page
              updateAllSearchFields(city, lat, lng);

              // Verrouiller visuellement pour confirmer la géolocalisation
              document.querySelectorAll('input[name="city"]').forEach(function (el) {
                return el.readOnly = true;
              });
              geolocateBtn.innerHTML = '<i class="icon-check text-16"></i>';
              geolocateBtn.classList.add('bg-white');
            })["catch"](function (error) {
              geolocateBtn.innerHTML = '<i class="icon-location text-16"></i>';
              alert("Impossible de récupérer l'adresse.");
            });
          }, function (error) {
            geolocateBtn.innerHTML = '<i class="icon-location text-16"></i>';
            alert("Géolocalisation refusée ou indisponible.");
          });
        }
      });
    }
  });
})();
/******/ })()
;