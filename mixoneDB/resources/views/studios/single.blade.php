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
                    <img src="{{ asset('media/img/gallery/1/1.png') }}" alt="image" class="rounded-4">
                    <div class="absolute px-20 py-20 col-12 d-flex justify-end">
                        <button class="button -blue-1 size-40 rounded-full flex-center bg-white text-dark-1">
                            <i class="icon-heart text-16"></i>
                        </button>
                    </div>
                </div>
                <div class="galleryGrid__item">
                    <img src="{{ asset('media/img/gallery/1/2.png') }}" alt="image" class="rounded-4">
                </div>
                <div class="galleryGrid__item relative d-flex">
                    <img src="{{ asset('media/img/gallery/1/3.png') }}" alt="image" class="rounded-4">
                    <div class="absolute h-full col-12 flex-center">
                        <a href="{{ $studio->video_url }}" class="button -blue-1 size-40 rounded-full flex-center bg-white text-dark-1 js-gallery" data-gallery="gallery1">
                            <i class="icon-play text-16"></i>
                        </a>
                    </div>
                </div>
                <div class="galleryGrid__item">
                    <img src="{{ asset('media/img/gallery/1/4.png') }}" alt="image" class="rounded-4">
                </div>
                <div class="galleryGrid__item relative d-flex">
                    <img src="{{ asset('media/img/gallery/1/5.png') }}" alt="image" class="rounded-4">
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
                        <div class="px-30 py-30 border-light rounded-4 shadow-4">
                            <div class="d-flex items-center justify-between">
                                <div class="text-14">
                                    Total :
                                    <span class="text-22 text-dark-1 fw-500" data-price>{{ $studio->hourly_rate * $studio->min_hours }}</span>
                                </div>
                            </div>

                            <div class="row y-gap-20 pt-30">
                                <!-- Champ pour la date -->
                                <div class="row y-gap-10 pt-10">
                                    <!-- Champ de date avec un calendrier dynamique -->
                                    <label for="date" class="text-15 text-light-1">Choisissez la date :</label>
                                    <input type="date" id="date" name="date" class="form-control" required onchange="updateHiddenDate()" />
                                </div>

                                <!-- Champ pour le nombre d'heures -->
                                <div class="col-12 mt-20 mb-20">
                                    <div class="searchMenu-guests px-20 py-10 border-light rounded-4 js-form-dd js-form-counters">
                                        <div data-x-dd-click="searchMenu-guests">
                                            <h4 class="text-15 fw-500 ls-2 lh-16">Nombre d'heures (minimum {{ $studio->min_hours }}h)</h4>
                                            <div class="text-15 text-light-1 ls-2 lh-16">
                                                <span class="js-count-adult">{{ $studio->min_hours }}</span> Heures
                                            </div>
                                        </div>
                                        <div class="searchMenu-guests__field " data-x-dd="searchMenu-guests" data-x-dd-toggle="-is-active">
                                        <div class="bg-white px-30 py-30 rounded-4">
                                                <div class="row y-gap-10 justify-between items-center">
                                                    <div class="col-auto">
                                                        <div class="text-15 fw-500">Heures</div>
                                                    </div>
                                                    <div class="col-auto" >
                                                        <div class="d-flex items-center js-counter gap-8"> <!-- 8 = 2rem (32px) -->
                                                            <button class="button -outline-blue-1 text-blue-1 size-38 rounded-4 js-down" type="button">
                                                                <i class="icon-minus text-12"></i>
                                                            </button>

                                                            <span class="text-15 fw-500 js-count-adult ml-15 mr-15">{{ $studio->min_hours }}</span>

                                                            <button class="button -outline-blue-1 text-blue-1 size-38 rounded-4 js-up" type="button">
                                                                <i class="icon-plus text-12"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Affichage des erreurs -->
                                @if ($errors->any())
                                    <div class="alert bg-red-1 text-white p-10 rounded-4 mt-10 mb-10">
                                        <ul class="list-disc pl-15">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if (session('error'))
                                    <div class="alert bg-red-1 text-white p-10 rounded-4 mt-10 mb-10">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if (session('success'))
                                    <div class="alert bg-green-1 text-white p-10 rounded-4 mt-10 mb-10">
                                        {{ session('success') }}
                                    </div>
                                @endif

                                <!-- Formulaire de réservation -->
                                <div class="col-12">
                                    <h4 class="text-15 fw-500 ls-2 lh-16">Créneaux horaires disponibles</h4>
                                    <form action="{{ route('reservation.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="studio_id" value="{{ $studio->id }}">
                                        <input type="hidden" name="date" value="" id="hidden_date">
                                        <input type="hidden" name="number_of_hours" id="hidden_number_of_hours" value="{{ $studio->min_hours }}" required>
                                        <input type="hidden" name="total_price" id="total_price" value="">


                                        <div class="row y-gap-10">
                                            @if (!empty($timeSlots) && is_array($timeSlots))
                                                <label for="time_slot" class="text-15 text-light-1">Choisissez un créneau :</label>
                                                <select name="time_slot" id="time_slot" class="form-control" required>
                                                    @foreach ($timeSlots as $slot)
                                                        <option value="{{ $slot }}">{{ $slot }}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <p class="text-15 text-light-1 py-2">Aucun créneau disponible</p>
                                            @endif
                                        </div>
                                        <button class="button -dark-1 px-35 h-60 col-12 bg-blue-1 text-white">
                                            Réserver
                                        </button>
                                    </form>
                                </div>

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
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


@endsection

<!--
        <div id="reviews"></div>
        <section class="pt-40">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-22 fw-500">Guest reviews</h3>
                    </div>
                </div>

                <div class="row y-gap-30 items-center pt-20">
                    <div class="col-lg-3">
                        <div class="flex-center rounded-4 min-h-250 bg-blue-1-05">
                            <div class="text-center">
                                <div class="text-60 md:text-50 fw-600 text-blue-1">4.8</div>
                                <div class="fw-500 lh-1">Exceptional</div>
                                <div class="text-14 text-light-1 lh-1 mt-5">3,014 reviews</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="row y-gap-30">

                            <div class="col-md-4 col-sm-6">
                                <div class="">
                                    <div class="d-flex items-center justify-between">
                                        <div class="text-15 fw-500">Location</div>
                                        <div class="text-15 text-light-1">9.4</div>
                                    </div>

                                    <div class="progressBar mt-10">
                                        <div class="progressBar__bg bg-blue-2"></div>
                                        <div class="progressBar__bar bg-dark-1" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="">
                                    <div class="d-flex items-center justify-between">
                                        <div class="text-15 fw-500">Staff</div>
                                        <div class="text-15 text-light-1">9.4</div>
                                    </div>

                                    <div class="progressBar mt-10">
                                        <div class="progressBar__bg bg-blue-2"></div>
                                        <div class="progressBar__bar bg-dark-1" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="">
                                    <div class="d-flex items-center justify-between">
                                        <div class="text-15 fw-500">Cleanliness</div>
                                        <div class="text-15 text-light-1">9.4</div>
                                    </div>

                                    <div class="progressBar mt-10">
                                        <div class="progressBar__bg bg-blue-2"></div>
                                        <div class="progressBar__bar bg-dark-1" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="">
                                    <div class="d-flex items-center justify-between">
                                        <div class="text-15 fw-500">Value for money</div>
                                        <div class="text-15 text-light-1">9.4</div>
                                    </div>

                                    <div class="progressBar mt-10">
                                        <div class="progressBar__bg bg-blue-2"></div>
                                        <div class="progressBar__bar bg-dark-1" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="">
                                    <div class="d-flex items-center justify-between">
                                        <div class="text-15 fw-500">Comfort</div>
                                        <div class="text-15 text-light-1">9.4</div>
                                    </div>

                                    <div class="progressBar mt-10">
                                        <div class="progressBar__bg bg-blue-2"></div>
                                        <div class="progressBar__bar bg-dark-1" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="">
                                    <div class="d-flex items-center justify-between">
                                        <div class="text-15 fw-500">Facilities</div>
                                        <div class="text-15 text-light-1">9.4</div>
                                    </div>

                                    <div class="progressBar mt-10">
                                        <div class="progressBar__bg bg-blue-2"></div>
                                        <div class="progressBar__bar bg-dark-1" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="">
                                    <div class="d-flex items-center justify-between">
                                        <div class="text-15 fw-500">Free WiFi</div>
                                        <div class="text-15 text-light-1">9.4</div>
                                    </div>

                                    <div class="progressBar mt-10">
                                        <div class="progressBar__bg bg-blue-2"></div>
                                        <div class="progressBar__bar bg-dark-1" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-40">
            <div class="container">
                <div class="row y-gap-60">


                    <div class="col-lg-6">
                        <div class="row x-gap-20 y-gap-20 items-center">
                            <div class="col-auto">
                                <img src="img/avatars/2.png" alt="image">
                            </div>
                            <div class="col-auto">
                                <div class="fw-500 lh-15">Tonko</div>
                                <div class="text-14 text-light-1 lh-15">March 2022</div>
                            </div>
                        </div>

                        <h5 class="fw-500 text-blue-1 mt-20">9.2 Superb</h5>
                        <p class="text-15 text-dark-1 mt-10">Nice two level apartment in great London location. Located in quiet small street, but just 50 meters from main street and bus stop. Tube station is short walk, just like two grocery stores. </p>


                        <div class="row x-gap-30 y-gap-30 pt-20">

                            <div class="col-auto">
                                <img src="img/testimonials/1/1.png" alt="image" class="rounded-4">
                            </div>

                            <div class="col-auto">
                                <img src="img/testimonials/1/2.png" alt="image" class="rounded-4">
                            </div>

                            <div class="col-auto">
                                <img src="img/testimonials/1/3.png" alt="image" class="rounded-4">
                            </div>

                            <div class="col-auto">
                                <img src="img/testimonials/1/4.png" alt="image" class="rounded-4">
                            </div>

                        </div>


                        <div class="d-flex x-gap-30 items-center pt-20">
                            <button class="d-flex items-center text-blue-1">
                                <i class="icon-like text-16 mr-10"></i>
                                Helpful
                            </button>

                            <button class="d-flex items-center text-light-1">
                                <i class="icon-dislike text-16 mr-10"></i>
                                Not helpful
                            </button>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="row x-gap-20 y-gap-20 items-center">
                            <div class="col-auto">
                                <img src="img/avatars/2.png" alt="image">
                            </div>
                            <div class="col-auto">
                                <div class="fw-500 lh-15">Tonko</div>
                                <div class="text-14 text-light-1 lh-15">March 2022</div>
                            </div>
                        </div>

                        <h5 class="fw-500 text-blue-1 mt-20">9.2 Superb</h5>
                        <p class="text-15 text-dark-1 mt-10">Nice two level apartment in great London location. Located in quiet small street, but just 50 meters from main street and bus stop. Tube station is short walk, just like two grocery stores. </p>


                        <div class="row x-gap-30 y-gap-30 pt-20">

                            <div class="col-auto">
                                <img src="img/testimonials/1/1.png" alt="image" class="rounded-4">
                            </div>

                            <div class="col-auto">
                                <img src="img/testimonials/1/2.png" alt="image" class="rounded-4">
                            </div>

                            <div class="col-auto">
                                <img src="img/testimonials/1/3.png" alt="image" class="rounded-4">
                            </div>

                            <div class="col-auto">
                                <img src="img/testimonials/1/4.png" alt="image" class="rounded-4">
                            </div>

                        </div>


                        <div class="d-flex x-gap-30 items-center pt-20">
                            <button class="d-flex items-center text-blue-1">
                                <i class="icon-like text-16 mr-10"></i>
                                Helpful
                            </button>

                            <button class="d-flex items-center text-light-1">
                                <i class="icon-dislike text-16 mr-10"></i>
                                Not helpful
                            </button>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="row x-gap-20 y-gap-20 items-center">
                            <div class="col-auto">
                                <img src="img/avatars/2.png" alt="image">
                            </div>
                            <div class="col-auto">
                                <div class="fw-500 lh-15">Tonko</div>
                                <div class="text-14 text-light-1 lh-15">March 2022</div>
                            </div>
                        </div>

                        <h5 class="fw-500 text-blue-1 mt-20">9.2 Superb</h5>
                        <p class="text-15 text-dark-1 mt-10">Nice two level apartment in great London location. Located in quiet small street, but just 50 meters from main street and bus stop. Tube station is short walk, just like two grocery stores. </p>


                        <div class="d-flex x-gap-30 items-center pt-20">
                            <button class="d-flex items-center text-blue-1">
                                <i class="icon-like text-16 mr-10"></i>
                                Helpful
                            </button>

                            <button class="d-flex items-center text-light-1">
                                <i class="icon-dislike text-16 mr-10"></i>
                                Not helpful
                            </button>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="row x-gap-20 y-gap-20 items-center">
                            <div class="col-auto">
                                <img src="img/avatars/2.png" alt="image">
                            </div>
                            <div class="col-auto">
                                <div class="fw-500 lh-15">Tonko</div>
                                <div class="text-14 text-light-1 lh-15">March 2022</div>
                            </div>
                        </div>

                        <h5 class="fw-500 text-blue-1 mt-20">9.2 Superb</h5>
                        <p class="text-15 text-dark-1 mt-10">Nice two level apartment in great London location. Located in quiet small street, but just 50 meters from main street and bus stop. Tube station is short walk, just like two grocery stores. </p>


                        <div class="d-flex x-gap-30 items-center pt-20">
                            <button class="d-flex items-center text-blue-1">
                                <i class="icon-like text-16 mr-10"></i>
                                Helpful
                            </button>

                            <button class="d-flex items-center text-light-1">
                                <i class="icon-dislike text-16 mr-10"></i>
                                Not helpful
                            </button>
                        </div>
                    </div>


                </div>

                <div class="row pt-30">
                    <div class="col-auto">

                        <a href="#" class="button -md -outline-blue-1 text-blue-1">
                            Show all 116 reviews <div class="icon-arrow-top-right ml-15"></div>
                        </a>

                    </div>
                </div>
            </div>
        </section>

        <section class="pt-40">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10">
                        <div class="row">
                            <div class="col-auto">
                                <h3 class="text-22 fw-500">Leave a Reply</h3>
                                <p class="text-15 text-dark-1 mt-5">Your email address will not be published.</p>
                            </div>
                        </div>

                        <div class="row y-gap-30 pt-30">

                            <div class="col-xl-4">
                                <div class="text-15 lh-1 fw-500">Location</div>
                                <div class="d-flex x-gap-5 items-center pt-10">

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="text-15 lh-1 fw-500">Staff</div>
                                <div class="d-flex x-gap-5 items-center pt-10">

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="text-15 lh-1 fw-500">Cleanliness</div>
                                <div class="d-flex x-gap-5 items-center pt-10">

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="text-15 lh-1 fw-500">Value for money</div>
                                <div class="d-flex x-gap-5 items-center pt-10">

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="text-15 lh-1 fw-500">Comfort</div>
                                <div class="d-flex x-gap-5 items-center pt-10">

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="text-15 lh-1 fw-500">Facilities</div>
                                <div class="d-flex x-gap-5 items-center pt-10">

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="text-15 lh-1 fw-500">Free WiFi</div>
                                <div class="d-flex x-gap-5 items-center pt-10">

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                </div>
                            </div>

                        </div>

                        <div class="row y-gap-30 pt-20">
                            <div class="col-xl-6">

                                <div class="form-input ">
                                    <input type="text" required>
                                    <label class="lh-1 text-16 text-light-1">Text</label>
                                </div>

                            </div>
                            <div class="col-xl-6">

                                <div class="form-input ">
                                    <input type="text" required>
                                    <label class="lh-1 text-16 text-light-1">Email</label>
                                </div>

                            </div>
                            <div class="col-12">

                                <div class="form-input ">
                                    <textarea required rows="4"></textarea>
                                    <label class="lh-1 text-16 text-light-1">Write Your Comment</label>
                                </div>

                            </div>
                            <div class="col-auto">

                                <a href="#" class="button -md -dark-1 bg-blue-1 text-white">
                                    Post Comment <div class="icon-arrow-top-right ml-15"></div>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    -->
