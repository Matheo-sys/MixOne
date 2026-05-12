/******/ (() => { // webpackBootstrap
/*!**************************************************!*\
  !*** ./resources/js/pages/studio/reservation.js ***!
  \**************************************************/
/**
 * Logique de réservation de studio
 */

(function () {
  'use strict';

  document.addEventListener('DOMContentLoaded', function () {
    var container = document.getElementById('reservationForm');
    if (!container) return;

    // Configuration récupérée via les data-attributes du formulaire
    var config = {
      studioId: container.getAttribute('data-studio-id'),
      minHours: parseInt(container.getAttribute('data-min-hours')),
      hourlyRate: parseFloat(container.getAttribute('data-hourly-rate'))
    };

    // Éléments du DOM
    var decreaseBtn = container.querySelector('.js-down');
    var increaseBtn = container.querySelector('.js-up');
    var hourDisplays = container.querySelectorAll('.js-count-adult');
    var dateInput = container.querySelector('#date');
    var hiddenDateInput = container.querySelector('#hidden_date');
    var hoursInput = container.querySelector('#hidden_number_of_hours');
    var totalPriceInput = container.querySelector('#total_price');
    var priceDisplay = document.querySelector('[data-price]');
    var timeSlotSelect = container.querySelector('#time_slot');
    var reserveButton = container.querySelector('#reserveButton');
    var selectedHours = config.minHours;

    /**
     * Met à jour l'interface utilisateur et les champs cachés
     */
    var updateDisplay = function updateDisplay() {
      // Mettre à jour l'affichage du nombre d'heures
      hourDisplays.forEach(function (display) {
        display.textContent = selectedHours;
      });

      // Mettre à jour les inputs cachés pour l'envoi du formulaire
      if (hoursInput) hoursInput.value = selectedHours;

      // Calcul et affichage du prix total
      var totalPrice = selectedHours * config.hourlyRate;
      if (totalPriceInput) {
        totalPriceInput.value = totalPrice.toFixed(2);
      }
      if (priceDisplay) {
        priceDisplay.textContent = totalPrice.toFixed(2) + '€';
      }

      // Désactiver/Activer le bouton de diminution si le minimum est atteint
      if (decreaseBtn) decreaseBtn.disabled = selectedHours <= config.minHours;
    };

    /**
     * Gère le changement de date et récupère les créneaux disponibles
     */
    var handleDateChange = function handleDateChange() {
      if (!dateInput || !hiddenDateInput) return;
      var date = dateInput.value;
      hiddenDateInput.value = date;
      if (!date) return;

      // Afficher l'état de chargement pour les créneaux
      if (timeSlotSelect) {
        timeSlotSelect.innerHTML = '<option disabled selected>Chargement...</option>';
        fetch("/studios/".concat(config.studioId, "/creneaux?date=").concat(date)).then(function (response) {
          return response.json();
        }).then(function (slots) {
          timeSlotSelect.innerHTML = '';
          if (slots.length > 0) {
            slots.forEach(function (slot) {
              var option = document.createElement('option');
              option.value = slot;
              option.textContent = slot;
              timeSlotSelect.appendChild(option);
            });
          } else {
            var option = document.createElement('option');
            option.disabled = true;
            option.selected = true;
            option.textContent = 'Aucun créneau disponible (Fermé)';
            timeSlotSelect.appendChild(option);
          }
        })["catch"](function (error) {
          console.error('Erreur lors de la récupération des créneaux:', error);
          timeSlotSelect.innerHTML = '<option disabled selected>Erreur de chargement</option>';
        });
      }
    };

    /**
     * Configure une info-bulle pour les profils Studio (qui ne peuvent pas réserver)
     */
    var setupStudioTooltip = function setupStudioTooltip() {
      if (!reserveButton || !reserveButton.disabled) return;
      var tooltip = document.createElement("div");
      tooltip.textContent = "Vous ne pouvez pas réserver en tant que studio";
      tooltip.style.position = "absolute";
      tooltip.style.padding = "5px 10px";
      tooltip.style.background = "black";
      tooltip.style.color = "white";
      tooltip.style.borderRadius = "5px";
      tooltip.style.fontSize = "12px";
      tooltip.style.whiteSpace = "nowrap";
      tooltip.style.display = "none";
      tooltip.style.pointerEvents = "none";
      tooltip.style.zIndex = "1000";
      document.body.appendChild(tooltip);
      reserveButton.addEventListener("mousemove", function (event) {
        tooltip.style.display = "block";
        tooltip.style.top = event.clientY + 10 + "px";
        tooltip.style.left = event.clientX + 10 + "px";
      });
      reserveButton.addEventListener("mouseleave", function () {
        tooltip.style.display = "none";
      });
    };

    /**
     * Initialisation de la logique de réservation
     */
    var init = function init() {
      // Définir la date minimale à aujourd'hui
      if (dateInput) {
        var today = new Date().toISOString().split('T')[0];
        dateInput.min = today;
        if (!dateInput.value) {
          dateInput.value = today;
          hiddenDateInput.value = today;
        }
        dateInput.addEventListener('change', handleDateChange);
      }

      // Configurer les boutons +/- pour les heures
      if (decreaseBtn) {
        decreaseBtn.addEventListener('click', function () {
          if (selectedHours > config.minHours) {
            selectedHours--;
            updateDisplay();
          }
        });
      }
      if (increaseBtn) {
        increaseBtn.addEventListener('click', function () {
          selectedHours++;
          updateDisplay();
        });
      }

      // Validation sommaire du formulaire avant envoi
      container.addEventListener('submit', function (e) {
        var hasError = false;
        container.querySelectorAll('.error-message').forEach(function (el) {
          return el.remove();
        });
        if (!hiddenDateInput.value) {
          hasError = true;
        }
        if (timeSlotSelect && !timeSlotSelect.value) {
          hasError = true;
        }
        if (hasError) {
          e.preventDefault();
        }
      });
      setupStudioTooltip();
      updateDisplay();
    };
    init();
  });
})();
/******/ })()
;