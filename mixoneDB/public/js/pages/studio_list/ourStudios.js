/******/ (() => { // webpackBootstrap
/*!******************************************************!*\
  !*** ./resources/js/pages/studio_list/ourStudios.js ***!
  \******************************************************/
/**
 * Logique de la page de liste des studios (Our Studios)
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    /**
     * Met à jour TOUS les champs de recherche (ville, lat, lng) dans la page
     * Pour synchroniser le formulaire du Hero et le formulaire de la Sidebar
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

    // 1. Logique de recherche (Filtrage côté client)
    var searchInput = document.getElementById('search-input');
    var searchButton = document.getElementById('search-button');
    function performSearch() {
      if (!searchInput) return;
      var searchTerm = searchInput.value.toLowerCase();
      var studioCards = document.querySelectorAll('.studioListCard');
      studioCards.forEach(function (card) {
        var nameEl = card.querySelector('.studioListCard__name');
        var cityEl = card.querySelector('.studioListCard__location span');
        var studioName = nameEl ? nameEl.textContent.toLowerCase() : '';
        var studioCity = cityEl ? cityEl.textContent.toLowerCase() : '';
        if (studioName.includes(searchTerm) || studioCity.includes(searchTerm)) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    }
    if (searchButton) searchButton.addEventListener('click', performSearch);
    if (searchInput) {
      searchInput.addEventListener('keyup', function (event) {
        if (event.key === 'Enter') performSearch();
      });
    }

    // 2. Logique du curseur de distance (Périmètre)
    var distRange = document.getElementById('distance');
    var distRangeMobile = document.getElementById('distance-mobile');
    var upper = document.querySelector('.js-upper');
    var upperMobile = document.querySelector('.js-upper-mobile');
    var updateDistDisplay = function updateDistDisplay(val, target) {
      if (target) target.textContent = val + "km";
    };
    if (distRange) {
      distRange.addEventListener('input', function () {
        updateDistDisplay(this.value, upper);
        updateSliderTrack(this);
      });
      updateDistDisplay(distRange.value, upper);
      updateSliderTrack(distRange);
    }
    if (distRangeMobile) {
      distRangeMobile.addEventListener('input', function () {
        updateDistDisplay(this.value, upperMobile);
      });
      updateDistDisplay(distRangeMobile.value, upperMobile);
    }
    function updateSliderTrack(input) {
      var val = (input.value - input.min) / (input.max - input.min) * 100;
      input.style.background = "linear-gradient(to right, #3554D1 ".concat(val, "%, #fff ").concat(val, "%)");
    }

    // 3. Sélecteur d'heures minimum
    var minHoursInputs = document.querySelectorAll('input[name="min_hours"]');
    var hoursValue = document.getElementById("hoursValue");
    var hoursMenu = document.getElementById('hoursMenu');
    if (hoursValue) {
      window.changeHours = function (amount) {
        var currentVal = parseInt(hoursValue.textContent) || 2;
        var newValue = currentVal + amount;
        if (newValue < 1) newValue = 1;
        hoursValue.textContent = newValue;
        minHoursInputs.forEach(function (el) {
          return el.value = newValue;
        });
      };
    }
    window.toggleHoursMenu = function (event) {
      event.stopPropagation();
      if (hoursMenu) hoursMenu.classList.toggle('hidden');
    };
    document.addEventListener('click', function (event) {
      if (hoursMenu && !hoursMenu.contains(event.target)) {
        hoursMenu.classList.add('hidden');
      }
    });

    // 4. Logique de géolocalisation et synchronisation
    var geolocateBtn = document.getElementById('geolocate-btn');

    // Détection de saisie manuelle pour vider les coordonnées
    document.addEventListener('input', function (e) {
      if (e.target.name === 'city') {
        updateAllSearchFields(e.target.value, '', '');
        e.target.readOnly = false;
      }
    });
    if (geolocateBtn) {
      geolocateBtn.addEventListener('click', function () {
        if (navigator.geolocation) {
          geolocateBtn.innerHTML = '<i class="icon-loading-2 text-16 rotate"></i>';
          navigator.geolocation.getCurrentPosition(function (position) {
            var lat = position.coords.latitude;
            var lng = position.coords.longitude;
            fetch("/studios/geocoder-inverse?lat=".concat(lat, "&lon=").concat(lng)).then(function (response) {
              return response.json();
            }).then(function (data) {
              var city = data.address.city || data.address.town || data.address.village || "Lieu inconnu";
              updateAllSearchFields(city, lat, lng);
              document.querySelectorAll('input[name="city"]').forEach(function (el) {
                return el.readOnly = true;
              });
              geolocateBtn.innerHTML = '<i class="icon-check text-16"></i>';
              geolocateBtn.classList.add('bg-white');
            })["catch"](function (error) {
              geolocateBtn.innerHTML = '<i class="icon-location-2 text-16"></i>';
              alert("Impossible de récupérer l'adresse.");
            });
          }, function (error) {
            geolocateBtn.innerHTML = '<i class="icon-location-2 text-16"></i>';
            alert("Géolocalisation refusée.");
          });
        }
      });
    }

    // 5. Gestion de la Wishlist (Favoris)
    document.querySelectorAll('.wishlist-toggle').forEach(function (button) {
      button.addEventListener('click', function (e) {
        var _document$querySelect,
          _this = this;
        e.preventDefault();
        var studioId = this.getAttribute('data-studio-id');
        var container = document.querySelector('.row.y-gap-40');
        var isGuest = (container === null || container === void 0 ? void 0 : container.getAttribute('data-guest')) === 'true';
        var wishlistUrl = container === null || container === void 0 ? void 0 : container.getAttribute('data-wishlist-url');
        var loginUrl = container === null || container === void 0 ? void 0 : container.getAttribute('data-login-url');
        var csrf = (_document$querySelect = document.querySelector('meta[name="csrf-token"]')) === null || _document$querySelect === void 0 ? void 0 : _document$querySelect.content;
        if (isGuest) {
          window.location.href = loginUrl;
          return;
        }
        fetch(wishlistUrl, {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrf
          },
          body: JSON.stringify({
            studio_id: studioId
          })
        }).then(function (response) {
          return response.json();
        }).then(function (data) {
          if (data.success) {
            if (data.status === 'added') {
              _this.classList.add('-active');
              _this.innerHTML = "<svg xmlns=\"http://www.w3.org/2000/svg\" viewBox=\"0 0 24 24\" width=\"14\" height=\"14\" fill=\"#ff4d4d\"><path d=\"M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z\"/></svg>";
            } else {
              _this.classList.remove('-active');
              _this.innerHTML = "<i class=\"icon-heart text-12\"></i>";
            }
          }
        })["catch"](function (error) {
          return console.error('Erreur AJAX:', error);
        });
      });
    });

    // 6. Swiper
    var studioImageSliders = document.querySelectorAll('.js-cardImage-slider');
    studioImageSliders.forEach(function (slider) {
      if (typeof Swiper !== 'undefined') {
        new Swiper(slider, {
          loop: true,
          pagination: {
            el: slider.querySelector('.js-pagination'),
            clickable: true
          },
          navigation: {
            nextEl: slider.querySelector('.js-next'),
            prevEl: slider.querySelector('.js-prev')
          }
        });
      }
    });
  });
})();
/******/ })()
;