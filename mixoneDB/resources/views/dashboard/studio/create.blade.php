@extends('layouts.backendDB')

@section('content')
    @if(session('success'))
        <div class="alert-success rounded-4 py-20 px-30 bg-green-1 mb-30">
            <div class="d-flex items-center">
                <div class="size-40 flex-center rounded-full bg-green-2 text-green-6 mr-10">
                    <i class="icon-check text-16"></i>
                </div>
                <div class="text-green-6 fw-500">{{ session('success') }}</div>
            </div>
        </div>
    @endif

    @if($errors->has('address_not_found'))
        <div class="alert-error rounded-4 py-20 px-30 bg-red-1 mb-30">
            <div class="d-flex items-center">
                <div class="size-40 flex-center rounded-full bg-red-2 text-red-6 mr-10">
                    <i class="icon-close text-16"></i>
                </div>
                <div class="text-red-6 fw-500">{{ $errors->first('address_not_found') }}</div>
            </div>
        </div>
    @endif

    <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
        <div class="col-auto">
            <h1 class="text-30 lh-14 fw-600">Ajouter un studio</h1>
            <div class="text-15 text-light-1">Lorem ipsum dolor sit amet, consectetur.</div>
        </div>
        <div class="col-auto"></div>
    </div>

    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
        <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">1. Contenu</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-2">2. Localisation</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-3">3. Tarifs</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-4">4. Attributs</button>
                </div>
            </div>

            <form method="post" action="{{ route('studio.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="tabs__content pt-30 js-tabs-content">
                    <div class="tabs__pane -tab-item-1 is-tab-el-active">
                        <div class="col-xl-10">
                            <div class="text-18 fw-500 mb-10">Studio Content</div>
                            <div class="row x-gap-20 y-gap-20">
                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="text" name="name" required value="{{ old('name') }}">
                                        <label class="lh-1 text-16 text-light-1">Nom du Studio</label>
                                    </div>
                                    @error('name')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-input">
                                        <textarea name="description" rows="5">{{ old('description') }}</textarea>
                                        <label class="lh-1 text-16 text-light-1">Contenu (Horaires, materiels ...)</label>
                                    </div>
                                    @error('description')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="text" name="youtube_video" value="{{ old('youtube_video') }}">
                                        <label class="lh-1 text-16 text-light-1">Youtube Video</label>
                                    </div>
                                    @error('youtube_video')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="mt-30">
                                <div class="fw-500">Gallery</div>
                                <div class="row x-gap-20 y-gap-20 pt-15" id="imagePreviewContainer">
                                    <div class="col-auto">
                                        <div class="w-200">
                                            <div class="d-flex ratio ratio-1:1">
                                                <input type="file" id="imageUpload" name="images[]" accept="image/png, image/jpeg" onchange="previewImages(event)" multiple style="display: none;">
                                                <label for="imageUpload" class="flex-center flex-column text-center bg-blue-2 h-full w-1/1 absolute rounded-4 border-type-1 cursor-pointer">
                                                    <div class="icon-upload-file text-40 text-blue-1 mb-10"></div>
                                                    <div class="text-blue-1 fw-500">Ajouter une image</div>
                                                </label>
                                            </div>
                                            <div class="text-center mt-10 text-14 text-light-1">PNG ou JPG pas plus grand que 800px de hauteur et largeur.</div>
                                        </div>
                                    </div>
                                    <!-- Image previews will be added here -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tabs__pane -tab-item-2">
                        <div class="col-xl-10">
                            <div class="text-18 fw-500 mb-10">Location</div>
                            <div class="row x-gap-20 y-gap-20">
                                <div class="col-12">
                                    <div class="form-input @if($errors->has('address_not_found')) is-error @endif">
                                        <input type="text" name="address" required value="{{ old('address') }}">
                                        <label class="lh-1 text-16 text-light-1">Adresse</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-input @if($errors->has('address_not_found')) is-error @endif">
                                        <input type="text" name="zipcode" required value="{{ old('zipcode') }}">
                                        <label class="lh-1 text-16 text-light-1">Code postal</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-input @if($errors->has('address_not_found')) is-error @endif">
                                        <input type="text" name="city" required value="{{ old('city') }}">
                                        <label class="lh-1 text-16 text-light-1">Ville</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-input @if($errors->has('address_not_found')) is-error @endif">
                                        <input type="text" name="country" required value="{{ old('country') }}">
                                        <label class="lh-1 text-16 text-light-1">Pays</label>
                                    </div>
                                </div>
                                <input type="hidden" name="latitude" id="latitude">
                                <input type="hidden" name="longitude" id="longitude">
                            </div>
                        </div>
                    </div>

                    <div class="tabs__pane -tab-item-3">
                        <div class="col-xl-10">
                            <div class="text-18 fw-500 mb-10">Tarifs</div>
                            <div class="row x-gap-20 y-gap-20">
                                <div class="col-6">
                                    <div class="form-input">
                                        <input type="text" name="hourly_rate" required value="{{ old('hourly_rate') }}">
                                        <label class="lh-1 text-16 text-light-1">Tarif horaire</label>
                                    </div>
                                    @error('hourly_rate')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-6">
                                    <div class="form-input">
                                        <input type="text" name="min_hours" required value="{{ old('min_hours') }}">
                                        <label class="lh-1 text-16 text-light-1">Heures minimum</label>
                                    </div>
                                    @error('min_hours')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tabs__pane -tab-item-4">
                        <div class="col-xl-9 col-lg-11">
                            <div class="row x-gap-100 y-gap-15">
                                <div class="col-12">
                                    <div class="text-18 fw-500">Services</div>
                                </div>
                                <div class="col-lg-3 col-sm-6">
                                    <div class="row y-gap-15">
                                        <div class="col-12">
                                            <div class="d-flex items-center">
                                                <div class="form-checkbox">
                                                    <input type="checkbox" name="service_apartments">
                                                    <div class="form-checkbox__mark">
                                                        <div class="form-checkbox__icon icon-check"></div>
                                                    </div>
                                                </div>
                                                <div class="text-15 lh-11 ml-10">Apartments</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex items-center">
                                                <div class="form-checkbox">
                                                    <input type="checkbox" name="service_boats">
                                                    <div class="form-checkbox__mark">
                                                        <div class="form-checkbox__icon icon-check"></div>
                                                    </div>
                                                </div>
                                                <div class="text-15 lh-11 ml-10">Boats</div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="d-flex items-center">
                                                <div class="form-checkbox">
                                                    <input type="checkbox" name="service_holiday_homes">
                                                    <div class="form-checkbox__mark">
                                                        <div class="form-checkbox__icon icon-check"></div>
                                                    </div>
                                                </div>
                                                <div class="text-15 lh-11 ml-10">Holiday homes</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Add more service checkboxes as needed -->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-inline-block mt-30">
                    <button type="submit" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                        Enregistrer <div class="icon-arrow-top-right ml-15"></div>
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

<style>
    .img-ratio {
        width: 100%;
        height: auto;
    }
    .w-200 {
        width: 200px;
    }
    .h-200 {
        height: 200px;
    }
    .size-40 {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>

<script>
    function previewImages(event) {
        const files = event.target.files;
        const container = document.getElementById('imagePreviewContainer');

        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
                const div = document.createElement('div');
                div.classList.add('col-auto');
                div.innerHTML = `
                <div class="d-flex ratio ratio-1:1 w-200">
                    <img src="${e.target.result}" alt="image" class="img-ratio rounded-4">
                    <div class="d-flex justify-end px-10 py-10 h-100 w-1/1 absolute">
                        <div class="size-40 bg-white rounded-4" onclick="removeImage(this)">
                            <i class="icon-trash text-16"></i>
                        </div>
                    </div>
                </div>
            `;
                container.insertBefore(div, container.children[1]);
            };

            reader.readAsDataURL(file);
        }
    }

    function removeImage(element) {
        element.closest('.col-auto').remove();

        // Réinitialiser l'input file pour permettre de sélectionner à nouveau le même fichier
        const imageUpload = document.getElementById('imageUpload');
        imageUpload.value = '';
    }

    document.addEventListener('DOMContentLoaded', function() {
        const cityInput = document.getElementById('city');
        const postalCodeInput = document.getElementById('postal_code');
        const countryInput = document.getElementById('country');
        const streetInput = document.getElementById('street');

        function fetchSuggestions(input, query) {
            fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${query}`)
                .then(response => response.json())
                .then(data => {
                    // Handle the suggestions (e.g., show them in a dropdown)
                    console.log(data);
                })
                .catch(error => console.error('Error fetching suggestions:', error));
        }

        cityInput.addEventListener('input', function() {
            fetchSuggestions(cityInput, cityInput.value);
        });

        postalCodeInput.addEventListener('input', function() {
            fetchSuggestions(postalCodeInput, postalCodeInput.value);
        });

        countryInput.addEventListener('input', function() {
            fetchSuggestions(countryInput, countryInput.value);
        });

        streetInput.addEventListener('input', function() {
            fetchSuggestions(streetInput, streetInput.value);
        });
    });

    document.querySelector('form').addEventListener('submit', async function(e) {
        e.preventDefault();

        // Si latitude et longitude ne sont pas déjà remplies
        if (!document.getElementById('latitude').value || !document.getElementById('longitude').value) {
            const address = document.querySelector('input[name="address"]').value;
            const city = document.querySelector('input[name="city"]').value;
            const zipcode = document.querySelector('input[name="zipcode"]').value;
            const country = document.querySelector('input[name="country"]').value;

            const fullAddress = `${address}, ${city}, ${zipcode}, ${country}`;

            try {
                const response = await fetch(`https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(fullAddress)}&limit=1`);
                const data = await response.json();

                if (data && data.length > 0) {
                    document.getElementById('latitude').value = data[0].lat;
                    document.getElementById('longitude').value = data[0].lon;
                    this.submit();
                } else {
                    alert('Adresse non trouvée. Veuillez vérifier les informations saisies.');
                }
            } catch (error) {
                console.error('Erreur lors de la récupération des coordonnées:', error);
                alert('Erreur lors de la récupération des coordonnées. Veuillez réessayer.');
            }
        } else {
            this.submit();
        }
    });

    // Activer l'onglet approprié en fonction de la session
    document.addEventListener('DOMContentLoaded', function() {
        @if(session('active_tab'))
        const tabButtons = document.querySelectorAll('.js-tabs-button');
        const tabIndex = {{ session('active_tab') }} - 1; // Convertir en index basé sur 0

        if (tabButtons[tabIndex]) {
            // Désactiver tous les onglets
            document.querySelectorAll('.js-tabs-button').forEach(button => {
                button.classList.remove('is-tab-el-active');
            });

            document.querySelectorAll('.tabs__pane').forEach(pane => {
                pane.classList.remove('is-tab-el-active');
            });

            // Activer l'onglet spécifié
            tabButtons[tabIndex].classList.add('is-tab-el-active');
            const targetSelector = tabButtons[tabIndex].getAttribute('data-tab-target');
            document.querySelector(targetSelector).classList.add('is-tab-el-active');
        }
        @endif
    });
</script>
