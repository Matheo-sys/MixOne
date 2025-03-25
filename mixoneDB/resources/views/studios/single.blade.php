@extends('layouts.backend')

@section('content')

    <section class="pt-40 mt-90">
        <div class="container">
            <div class="row y-gap-20 justify-between items-end">
                <div class="col-auto">
                    <div class="row x-gap-20 items-center">
                        <div class="col-auto">
                            <h1 class="text-30 sm:text-25 fw-600">{{ $studio->name }}</h1>
                        </div>
                        <div class="col-auto">
                            <i class="icon-star text-10 text-yellow-1"></i>
                            <i class="icon-star text-10 text-yellow-1"></i>
                            <i class="icon-star text-10 text-yellow-1"></i>
                            <i class="icon-star text-10 text-yellow-1"></i>
                            <i class="icon-star text-10 text-yellow-1"></i>
                        </div>
                    </div>
                    <div class="row x-gap-20 y-gap-20 items-center">
                        <div class="col-auto">
                            <div class="d-flex items-center text-15 text-light-1">
                                <i class="icon-location-2 text-16 mr-5"></i>
                                {{ $studio->address }}, {{ $studio->city }}, {{ $studio->zipcode }}, {{ $studio->country }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="row x-gap-15 y-gap-15 items-center">
                        <div class="col-auto">
                            <div class="text-14">
                                A partir de
                                <span class="text-22 text-dark-1 fw-500">{{ $studio->hourly_rate }}€</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Galerie d'images, description, etc... -->
            <div class="galleryGrid -type-1 pt-30">
                <div class="galleryGrid__item relative d-flex">
                    <img src="{{ $studio->image1 ? asset('storage/' . $studio->image1) : asset('media/img/backgrounds/11.jpg') }}" alt="image" class="rounded-4">
                    <div class="absolute px-20 py-20 col-12 d-flex justify-end">
                    </div>
                </div>
                <div class="galleryGrid__item">
                    <img src="{{ $studio->image2 ? asset('storage/' . $studio->image2) : asset('media/img/backgrounds/11.jpg') }}" alt="image" class="rounded-4">
                </div>
                <div class="galleryGrid__item relative d-flex">
                    <img src="{{asset('media/img/gallery/1/6.png') }}" alt="image" class="rounded-4">
                    <div class="absolute h-full col-12 flex-center">
                        <a href="{{ asset('media/img/gallery/1/6.png')}}" class="button -blue-1 size-40 rounded-full flex-center bg-white text-dark-1 js-gallery" data-gallery="gallery1">
                            <i class="icon-play text-16"></i>
                        </a>
                    </div>
                </div>
                <div class="galleryGrid__item">
                    <img src="{{ $studio->image4 ? asset('storage/' . $studio->image4) : asset('media/img/backgrounds/11.jpg') }}" alt="image" class="rounded-4">
                </div>
                <div class="galleryGrid__item relative d-flex">
                    <!-- Cette dernière image pourrait être une réutilisation de la première image ou une image fixe -->
                    <img src="{{ $studio->image3 ? asset('storage/' . $studio->image3) : asset('media/img/backgrounds/11.jpg') }}" alt="image" class="rounded-4">
                </div>
            </div>
        </div>
    </section>

    <section class="pt-30">
        <div class="container">
            <div class="row y-gap-30">
                <div class="col-xl-8">
                    <div class="row y-gap-40">
                        <div id="overview" class="col-12">
                            <h3 class="text-22 fw-500 pt-40 border-top-light">Overview</h3>
                            <p class="text-dark-1 text-15 mt-20">
                                {{ $studio->description }}
                            </p>
                        </div>
                        <div class="col-12">
                            <h3 class="text-22 fw-500 pt-40 border-top-light">Most Popular Facilities</h3>
                            <div class="row y-gap-10 pt-20">
                                <div class="col-md-5">
                                    <div class="d-flex x-gap-15 y-gap-15 items-center">
                                        <i class="icon-no-smoke"></i>
                                        <div class="text-15">Non-smoking rooms</div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="d-flex x-gap-15 y-gap-15 items-center">
                                        <i class="icon-wifi"></i>
                                        <div class="text-15">Free WiFi</div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="d-flex x-gap-15 y-gap-15 items-center">
                                        <i class="icon-parking"></i>
                                        <div class="text-15">Parking</div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="d-flex x-gap-15 y-gap-15 items-center">
                                        <i class="icon-kitchen"></i>
                                        <div class="text-15">Kitchen</div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="d-flex x-gap-15 y-gap-15 items-center">
                                        <i class="icon-living-room"></i>
                                        <div class="text-15">Living Area</div>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="d-flex x-gap-15 y-gap-15 items-center">
                                        <i class="icon-shield"></i>
                                        <div class="text-15">Safety &amp; security</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="px-24 py-20 rounded-4 bg-green-1">
                                <div class="row x-gap-20 y-gap-20 items-center">
                                    <div class="col-auto">
                                        <div class="flex-center size-60 rounded-full bg-white">
                                            <i class="icon-star text-yellow-1 text-30"></i>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <h4 class="text-18 lh-15 fw-500">This property is in high demand!</h4>
                                        <div class="text-15 lh-15">7 travelers have booked today.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="ml-50 lg:ml-0">
                        <div class="px-30 py-30 border-light rounded-4 shadow-4 bg-white">
                            <!-- En-tête avec le prix total -->
                            <div class="d-flex items-center justify-between border-bottom pb-20 mb-20">
                                <div class="text-16 text-dark-1">
                                    Total pour la réservation :
                                </div>
                                <div class="text-22 fw-600 text-blue-1" data-price>
                                    {{ $studio->hourly_rate * $studio->min_hours }} €
                                </div>
                            </div>

                            <!-- Formulaire de réservation -->
                            <form action="{{ route('reservation.store') }}" method="POST" id="reservationForm">
                                @csrf
                                <input type="hidden" name="studio_id" value="{{ $studio->id }}">
                                <input type="hidden" name="date" id="hidden_date" value="">
                                <input type="hidden" name="number_of_hours" id="hidden_number_of_hours" value="{{ $studio->min_hours }}" required>
                                <input type="hidden" name="total_price" id="total_price" value="">

                                <!-- Section Date -->
                                <div class="form-group mb-25">
                                    <label for="date" class="d-block text-15 fw-500 mb-10 text-dark-1 ml-10">
                                        <i class="icon-calendar text-16 mr-5"></i> Date de réservation
                                    </label>
                                    <div class="relative">
                                        <input type="date" id="date" name="date"
                                               class="form-control h-50 px-20 border-light rounded-4 focus:border-blue-1"
                                               required
                                               onchange="updateHiddenDate()"
                                               min="{{ date('Y-m-d') }}">
                                        <i class="icon-arrow-down text-14 absolute right-20 top-15 text-light-1"></i>
                                    </div>
                                </div>

                                <!-- Section Nombre d'heures -->
                                <div class="col-12 mt-20 mb-20">
                                    <div class="searchMenu-guests px-20 py-15 border-light rounded-4 js-form-dd js-form-counters bg-white shadow-sm hover:shadow-md transition-shadow">
                                        <div data-x-dd-click="searchMenu-guests" class="cursor-pointer">
                                            <h4 class="text-15 fw-500 ls-2 lh-16 text-dark-1">
                                                <i class="icon-clock text-16 mr-5 text-blue-1"></i>
                                                Nombre d'heures (minimum {{ $studio->min_hours }}h)
                                            </h4>
                                            <div class="text-15 text-dark-1 ls-2 lh-16 flex items-center mt-5">
                                                <span class="js-count-adult fw-600">{{ $studio->min_hours }}</span>
                                                <span class="ml-5">Heures</span> <!-- Petit espace de 5px -->
                                            </div>
                                        </div>

                                        <div class="searchMenu-guests__field" data-x-dd="searchMenu-guests" data-x-dd-toggle="-is-active">
                                            <div class="bg-white px-20 py-20 rounded-4 border-light border-1 mt-10">
                                                <div class="row y-gap-10 justify-between items-center">
                                                    <div class="col-auto">
                                                        <div class="text-15 fw-500 text-dark-1">Durée de réservation</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="d-flex items-center js-counter gap-8">
                                                            <button class="button -outline-blue-1 text-blue-1 size-38 rounded-4 js-down hover:bg-blue-1 hover:text-white transition mr-10"
                                                                    type="button"
                                                                    aria-label="Réduire le nombre d'heures">
                                                                <i class="icon-minus text-12"></i>
                                                            </button>

                                                            <span class="text-16 fw-600 js-count-adult mx-15 min-w-20 text-center mr-10">{{ $studio->min_hours }}</span>

                                                            <button class="button -outline-blue-1 text-blue-1 size-38 rounded-4 js-up hover:bg-blue-1 hover:text-white transition"
                                                                    type="button"
                                                                    aria-label="Augmenter le nombre d'heures">
                                                                <i class="icon-plus text-12"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-12 text-light-1 mt-10 text-center">
                                                    Minimum {{ $studio->min_hours }} heures requises
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Section Créneaux horaires -->
                                <div class="form-group mb-30">
                                    <label class="d-block text-15 fw-500 mb-10 text-dark-1">
                                        <i class="icon-time text-16 mr-5"></i> Créneau horaire :
                                    </label>
                                    <div class="relative">
                                        <select name="time_slot" id="time_slot"
                                                class="form-control h-50 px-20 border-light rounded-4 focus:border-blue-1 appearance-none"
                                                required>
                                            @if(!empty($timeSlots) && is_array($timeSlots))
                                                @foreach($timeSlots as $slot)
                                                    <option value="{{ $slot }}">{{ $slot }}</option>
                                                @endforeach
                                            @else
                                                <option disabled selected>Aucun créneau disponible</option>
                                            @endif
                                        </select>
                                        <i class="icon-arrow-down text-14 absolute right-20 top-15 text-light-1"></i>
                                    </div>
                                    @if(empty($timeSlots))
                                        <p class="text-14 text-red-1 mt-5">Veuillez sélectionner une date valide</p>
                                    @endif
                                </div>

                                <!-- Messages d'erreur/succès -->
                                @if($errors->any())
                                    <div class="alert bg-red-1 text-white p-15 rounded-4 mb-20">
                                        <ul class="list-disc pl-20">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(session('error'))
                                    <div class="alert bg-red-1 text-white p-15 rounded-4 mb-20">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if(session('success'))
                                    <div class="alert bg-green-1 text-white p-15 rounded-4 mb-20">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @php
                                    $isStudio = auth()->check() && auth()->user()->profile === 'studio'; // Vérifie si l'utilisateur est un studio
                                @endphp

                                    <!-- Bouton de réservation -->
                                <button type="submit" id = "reserveButton"
                                        class="button px-35 h-60 col-12 transition-all fw-500 flex items-center justify-center
               {{ $isStudio ? 'bg-gray-800 text-gray-900 cursor-not-allowed' : 'bg-blue-1 text-white hover:bg-blue-2' }}"
                                        style="margin-top: 10px; border-radius: 8px; opacity: {{ $isStudio ? '1' : '1' }};"
                                        {{ $isStudio ? 'disabled' : '' }}
                                        @if($isStudio) data-tooltip="Vous ne pouvez pas réserver connecté en tant que studio" @endif>
                                    <span>Réserver maintenant</span>
                                    <i class="icon-arrow-right text-16 ml-10"></i>
                                </button>

                                <!-- Ajout du tooltip (message au survol) -->
                                @if($isStudio)
                                    <script>
                                        document.addEventListener("DOMContentLoaded", function () {
                                            let button = document.getElementById("reserveButton");

                                            if (!button) return; // Vérifie que le bouton existe

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
                                            tooltip.style.pointerEvents = "none"; // Ne bloque pas les interactions

                                            document.body.appendChild(tooltip);

                                            button.addEventListener("mousemove", function (event) {
                                                tooltip.style.display = "block";
                                                tooltip.style.top = (event.clientY + 10) + "px";
                                                tooltip.style.left = (event.clientX + 10) + "px";
                                            });

                                            button.addEventListener("mouseleave", function () {
                                                tooltip.style.display = "none";
                                            });
                                        });

                                    </script>
                                @endif

                            </form>
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </section>

    <style>
        .searchMenu-guests {
            border: 1px solid #e4e5e7;
            transition: all 0.3s ease;
        }

        .searchMenu-guests:hover {
            border-color: #c5c6c8;
        }

        .searchMenu-guests__field {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .button.-outline-blue-1:hover {
            transform: translateY(-1px);
        }
    </style>
    <style>
        .form-control {
            border: 1px solid #E4E5E7;
            width: 100%;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #335EEE;
            box-shadow: 0 0 0 2px rgba(51, 94, 238, 0.1);
        }

        .counter-btn {
            width: 32px;
            height: 32px;
            border: 1px solid #E4E5E7;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: white;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .counter-btn:hover {
            background: #F5F7FA;
            border-color: #D1D5DB;
        }

        select.form-control {
            background-image: none;
            padding-right: 40px;
        }

        .alert {
            transition: all 0.3s ease;
        }
    </style>

    <script>
        // Script pour gérer le compteur d'heures
        document.addEventListener('DOMContentLoaded', function() {
            const downBtn = document.querySelector('.js-down');
            const upBtn = document.querySelector('.js-up');
            const counter = document.querySelector('.js-count-adult');
            const hiddenHours = document.getElementById('hidden_number_of_hours');
            const minHours = {{ $studio->min_hours }};
            const hourlyRate = {{ $studio->hourly_rate }};
            const totalPrice = document.querySelector('[data-price]');

            // Gestion du compteur
            if (downBtn && upBtn) {
                downBtn.addEventListener('click', () => {
                    let current = parseInt(counter.textContent);
                    if (current > minHours) {
                        current--;
                        updateCounter(current);
                    }
                });

                upBtn.addEventListener('click', () => {
                    let current = parseInt(counter.textContent);
                    current++;
                    updateCounter(current);
                });
            }

            function updateCounter(value) {
                counter.textContent = value;
                hiddenHours.value = value;
                totalPrice.textContent = (value * hourlyRate) + ' €';
                document.getElementById('total_price').value = value * hourlyRate;
            }
        });

        function updateHiddenDate() {
            document.getElementById('hidden_date').value = document.getElementById('date').value;
        }
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gestion du compteur d'heures
            const downBtn = document.querySelector('.js-down');
            const upBtn = document.querySelector('.js-up');
            const counter = document.querySelector('.js-count-adult');
            const minHours = {{ $studio->min_hours }};

            if (downBtn && upBtn) {
                downBtn.addEventListener('click', function() {
                    let current = parseInt(counter.textContent);
                    if (current > minHours) {
                        counter.textContent = current - 1;
                        updateReservationDetails();
                    }
                });

                upBtn.addEventListener('click', function() {
                    let current = parseInt(counter.textContent);
                    counter.textContent = current + 1;
                    updateReservationDetails();
                });
            }

            function updateReservationDetails() {
                const hours = parseInt(counter.textContent);
                const hourlyRate = {{ $studio->hourly_rate }};
                const total = hours * hourlyRate;

                // Mise à jour des champs cachés
                document.getElementById('hidden_number_of_hours').value = hours;
                document.getElementById('total_price').value = total;

                // Mise à jour de l'affichage du prix
                document.querySelector('[data-price]').textContent = total + ' €';
            }
        });
    </script>
    <script>
        (function() {
            'use strict';

            document.addEventListener('DOMContentLoaded', () => {
                // Sélection des éléments critiques
                const decreaseBtn = document.querySelector('.js-down');
                const increaseBtn = document.querySelector('.js-up');
                const hourDisplays = document.querySelectorAll('.js-count-adult');
                const dateInput = document.getElementById('date');
                const hiddenDateInput = document.getElementById('hidden_date');
                const form = document.querySelector('form[action*="reservation.store"]');
                const hoursInput = document.getElementById('hidden_number_of_hours'); // Ajout important
                const totalPriceInput = document.getElementById('total_price');

                const config = {
                    minHours: {{ $studio->min_hours }},
                    hourlyRate: {{ $studio->hourly_rate }}
                };

                let selectedHours = config.minHours;

                // Fonction principale de mise à jour
                const updateDisplay = () => {
                    // Mise à jour des heures
                    hourDisplays.forEach(display => {
                        display.textContent = selectedHours;
                    });

                    // Mise à jour des champs cachés
                    if(hoursInput) hoursInput.value = selectedHours; // Correction clé

                    // Calcul et mise à jour du prix
                    const totalPrice = selectedHours * config.hourlyRate;
                    if(totalPriceInput) {
                        totalPriceInput.value = totalPrice.toFixed(2);
                        document.querySelector('[data-price]').textContent = totalPrice.toFixed(2) + '€';
                    }

                    if(decreaseBtn) decreaseBtn.disabled = selectedHours <= config.minHours;
                };

                // Gestion de la date (inchangée)
                const handleDate = () => {
                    if(!dateInput || !hiddenDateInput) return;

                    const today = new Date().toISOString().split('T')[0];
                    dateInput.min = today;

                    if(!dateInput.value) {
                        dateInput.value = today;
                        hiddenDateInput.value = today;
                    }

                    dateInput.addEventListener('change', () => {
                        hiddenDateInput.value = dateInput.value;
                    });
                };

                // Validation du formulaire (inchangée)
                const validateForm = (e) => {
                    let hasError = false;
                    document.querySelectorAll('.error-message').forEach(el => el.remove());

                    if(!hiddenDateInput.value) {
                        showError(dateInput, 'Veuillez sélectionner une date.');
                        hasError = true;
                    }

                    const timeSlotInput = document.getElementById('time_slot');
                    if(!timeSlotInput.value) {
                        showError(timeSlotInput, 'Veuillez sélectionner un créneau horaire.');
                        hasError = true;
                    }

                    if(hasError) {
                        e.preventDefault();
                        document.querySelector('.error-message')?.scrollIntoView({
                            behavior: 'smooth',
                            block: 'center'
                        });
                    }
                };

                // Gestion des boutons heures modifiée
                const setupHourButtons = () => {
                    const handleButtonClick = (action) => {
                        const newValue = action === 'increase' ? selectedHours + 1 : selectedHours - 1;
                        if(newValue >= config.minHours && newValue <= 24) {
                            selectedHours = newValue;
                            updateDisplay();
                            // Force la mise à jour immédiate des inputs
                            hoursInput.dispatchEvent(new Event('change'));
                        }
                    };

                    if(decreaseBtn) decreaseBtn.addEventListener('click', () => handleButtonClick('decrease'));
                    if(increaseBtn) increaseBtn.addEventListener('click', () => handleButtonClick('increase'));
                };

                // Initialisation
                const init = () => {
                    handleDate();
                    setupHourButtons();
                    updateDisplay();
                    if(form) form.addEventListener('submit', validateForm);

                    // Double vérification des valeurs initiales
                    if(hoursInput) hoursInput.value = config.minHours;
                    if(totalPriceInput) totalPriceInput.value = (config.minHours * config.hourlyRate).toFixed(2);
                };

                init();
            });
        })();
    </script>
@endsection

