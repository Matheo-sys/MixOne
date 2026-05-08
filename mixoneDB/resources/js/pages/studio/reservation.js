/**
 * Logique de réservation de studio
 */

(function() {
    'use strict';

    document.addEventListener('DOMContentLoaded', () => {
        const container = document.getElementById('reservationForm');
        if (!container) return;

        // Configuration récupérée via les data-attributes du formulaire
        const config = {
            studioId: container.getAttribute('data-studio-id'),
            minHours: parseInt(container.getAttribute('data-min-hours')),
            hourlyRate: parseFloat(container.getAttribute('data-hourly-rate'))
        };

        // Éléments du DOM
        const decreaseBtn = container.querySelector('.js-down');
        const increaseBtn = container.querySelector('.js-up');
        const hourDisplays = container.querySelectorAll('.js-count-adult');
        const dateInput = container.querySelector('#date');
        const hiddenDateInput = container.querySelector('#hidden_date');
        const hoursInput = container.querySelector('#hidden_number_of_hours');
        const totalPriceInput = container.querySelector('#total_price');
        const priceDisplay = document.querySelector('[data-price]');
        const timeSlotSelect = container.querySelector('#time_slot');
        const reserveButton = container.querySelector('#reserveButton');

        let selectedHours = config.minHours;

        /**
         * Met à jour l'interface utilisateur et les champs cachés
         */
        const updateDisplay = () => {
            // Mettre à jour l'affichage du nombre d'heures
            hourDisplays.forEach(display => {
                display.textContent = selectedHours;
            });

            // Mettre à jour les inputs cachés pour l'envoi du formulaire
            if (hoursInput) hoursInput.value = selectedHours;

            // Calcul et affichage du prix total
            const totalPrice = selectedHours * config.hourlyRate;
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
        const handleDateChange = () => {
            if (!dateInput || !hiddenDateInput) return;

            const date = dateInput.value;
            hiddenDateInput.value = date;

            if (!date) return;

            // Afficher l'état de chargement pour les créneaux
            if (timeSlotSelect) {
                timeSlotSelect.innerHTML = '<option disabled selected>Chargement...</option>';

                fetch(`/studios/${config.studioId}/creneaux?date=${date}`)
                    .then(response => response.json())
                    .then(slots => {
                        timeSlotSelect.innerHTML = '';
                        if (slots.length > 0) {
                            slots.forEach(slot => {
                                const option = document.createElement('option');
                                option.value = slot;
                                option.textContent = slot;
                                timeSlotSelect.appendChild(option);
                            });
                        } else {
                            const option = document.createElement('option');
                            option.disabled = true;
                            option.selected = true;
                            option.textContent = 'Aucun créneau disponible (Fermé)';
                            timeSlotSelect.appendChild(option);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur lors de la récupération des créneaux:', error);
                        timeSlotSelect.innerHTML = '<option disabled selected>Erreur de chargement</option>';
                    });
            }
        };

        /**
         * Configure une info-bulle pour les profils Studio (qui ne peuvent pas réserver)
         */
        const setupStudioTooltip = () => {
            if (!reserveButton || !reserveButton.disabled) return;

            let tooltip = document.createElement("div");
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

            reserveButton.addEventListener("mousemove", (event) => {
                tooltip.style.display = "block";
                tooltip.style.top = (event.clientY + 10) + "px";
                tooltip.style.left = (event.clientX + 10) + "px";
            });

            reserveButton.addEventListener("mouseleave", () => {
                tooltip.style.display = "none";
            });
        };

        /**
         * Initialisation de la logique de réservation
         */
        const init = () => {
            // Définir la date minimale à aujourd'hui
            if (dateInput) {
                const today = new Date().toISOString().split('T')[0];
                dateInput.min = today;
                if (!dateInput.value) {
                    dateInput.value = today;
                    hiddenDateInput.value = today;
                }
                dateInput.addEventListener('change', handleDateChange);
            }

            // Configurer les boutons +/- pour les heures
            if (decreaseBtn) {
                decreaseBtn.addEventListener('click', () => {
                    if (selectedHours > config.minHours) {
                        selectedHours--;
                        updateDisplay();
                    }
                });
            }
            if (increaseBtn) {
                increaseBtn.addEventListener('click', () => {
                    selectedHours++;
                    updateDisplay();
                });
            }

            // Validation sommaire du formulaire avant envoi
            container.addEventListener('submit', (e) => {
                let hasError = false;
                container.querySelectorAll('.error-message').forEach(el => el.remove());

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
