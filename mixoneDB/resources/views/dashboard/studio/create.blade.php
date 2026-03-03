@extends('layouts.backendDB')

@section('content')
    @if(session('success'))
        <div id="success-alert" class="alert-success rounded-4 py-20 px-30 bg-green-1 mb-30" style="transition: opacity 0.5s ease;">
            <div class="d-flex items-center">
                <div class="size-40 flex-center rounded-full bg-green-2 text-green-6 mr-10">
                    <i class="icon-check text-16"></i>
                </div>
                <div class="text-green-6 fw-500">{{ session('success') }}</div>
            </div>
        </div>
    @endif

    @if($errors->has('address_not_found'))
        <div id="error-alert" class="alert-error rounded-4 py-20 px-30 bg-red-1 mb-30" style="transition: opacity 0.5s ease;">
            <div class="d-flex items-center">
                <div class="size-40 flex-center rounded-full bg-red-2 text-red-6 mr-10">
                    <i class="icon-close text-16"></i>
                </div>
                <div class="text-red-6 fw-500">{{ $errors->first('address_not_found') }}</div>
            </div>
        </div>
    @endif

    <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
        <div class="col-auto ml-10">
            <h1 class="text-30 lh-14 fw-600">AJOUTER UN STUDIO</h1>
            <div class="text-15 text-light-1">Ajoutez un nouveau studio et mettez-le à disposition des artistes en quelques instants.</div>
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
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-4">4. Photos</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-5">5. Attributs</button>
                </div>
            </div>

            <form method="post" action="{{ route('studio.store') }}" enctype="multipart/form-data" class="js-studio-form">
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
                                        <textarea name="description" rows="5" required>{{ old('description') }}</textarea>
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
                        </div>
                    </div>

                    <div class="tabs__pane -tab-item-2">
                        <div class="col-xl-10">
                            <div class="text-18 fw-500 mb-10">Location</div>
                            <div class="row x-gap-20 y-gap-20">
                                <div class="col-12 relative" style="position: relative;">
                                    <div class="form-input @if($errors->has('address_not_found')) is-error @endif">
                                        <input type="text" name="address" id="autocomplete-address" required value="{{ old('address') }}" autocomplete="off">
                                        <label class="lh-1 text-16 text-light-1">Adresse</label>
                                    </div>
                                    <!-- Autocomplete Dropdown -->
                                    <ul id="address-suggestions" class="absolute bg-white shadow-2 rounded-8 w-100 z-5" style="display: none; max-height: 250px; overflow-y: auto; list-style: none; padding: 0; margin: 5px 0 0 0; top: 100%; left: 0;">
                                    </ul>
                                </div>
                                <div class="col-4">
                                    <div class="form-input @if($errors->has('address_not_found')) is-error @endif">
                                        <input type="text" name="zipcode" id="input-zipcode" required value="{{ old('zipcode') }}">
                                        <label class="lh-1 text-16 text-light-1">Code postal</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-input @if($errors->has('address_not_found')) is-error @endif">
                                        <input type="text" name="city" id="input-city" required value="{{ old('city') }}">
                                        <label class="lh-1 text-16 text-light-1">Ville</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-input @if($errors->has('address_not_found')) is-error @endif">
                                        <input type="text" name="country" id="input-country" required value="{{ old('country') ?? 'France' }}">
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

                    {{-- Section des images dans edit.blade.php --}}
                    <div class="tabs__pane -tab-item-4">
                        <div class="col-xl-12">
                            <div class="text-18 fw-500 mb-10">Photos</div>
                            <div class="d-flex flex-wrap x-gap-20 y-gap-20">
                                @for ($i = 1; $i <= 4; $i++)
                                    <div class="d-flex flex-column align-items-center me-20 mb-20 ml-3">
                                        <div class="d-flex ratio ratio-3:2 w-200 position-relative">
                                            @php
                                                $imageField = "image{$i}";
                                                $imageUrl = isset($studio) && $studio->$imageField ? asset('storage/' . $studio->$imageField) : asset('media/img/backgrounds/11.jpg');
                                            @endphp
                                            <img id="studioImage{{ $i }}"
                                                 src="{{ isset($studio->$imageField) && $studio->$imageField ? asset('storage/' . $studio->$imageField) : asset('media/img/backgrounds/11.jpg') }}"
                                                 alt="Image {{ $i }}"
                                                 class="img-ratio rounded-4">
                                            <div class="d-flex justify-end px-10 py-10 h-100 w-1/1 absolute">
                                                <div class="size-40 bg-white rounded-4 cursor-pointer" onclick="removeImage({{ $i }})">
                                                    <i class="icon-trash text-16"></i>
                                                </div>
                                            </div>
                                            <div id="defaultImageText{{ $i }}" class="default-image-text {{ isset($studio) && isset($studio->$imageField) && $studio->$imageField ? 'd-none' : '' }}">
                                                Par défaut
                                            </div>
                                        </div>
                                        <div class="text-14 mt-10">Image {{ $i }}</div>
                                        <div class="d-inline-block mt-15">
                                            <input type="hidden" name="remove_image{{ $i }}" id="removeImage{{ $i }}Input" value="0">
                                            <input type="file" id="imageUpload{{ $i }}" name="image{{ $i }}" accept="image/png, image/jpeg" style="display: none;" onchange="previewImage(event, {{ $i }})">
                                            <label for="imageUpload{{ $i }}" class="button h-50 px-24 -dark-1 bg-blue-1 text-white cursor-pointer">
                                                <i class="icon-upload-file text-20 mr-10"></i>
                                                Parcourir
                                            </label>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <div class="tabs__pane -tab-item-5">
                        <div class="col-xl-11">
                            <div class="text-18 fw-500 mb-5">Équipements du Studio</div>
                            <div class="text-14 text-light-1 mb-25">Cochez les équipements disponibles dans votre studio d'enregistrement.</div>

                            @php
                            $equipmentCategories = [
                                '🎙️ Microphones' => [
                                    'micro_condenser' => 'Microphone à condensateur',
                                    'micro_dynamic' => 'Microphone dynamique',
                                    'micro_ribbon' => 'Microphone à ruban',
                                    'micro_large_diaphragm' => 'Grand diaphragme',
                                    'micro_small_diaphragm' => 'Petit diaphragme',
                                    'micro_usb' => 'Microphone USB',
                                ],
                                '🔊 Préamplis & Interfaces' => [
                                    'preamp_neve' => 'Preamp Neve',
                                    'preamp_api' => 'Preamp API',
                                    'preamp_ssl' => 'Preamp SSL',
                                    'interface_apollo' => 'Interface Apollo (Universal Audio)',
                                    'interface_focusrite' => 'Interface Focusrite',
                                    'interface_rme' => 'Interface RME',
                                    'interface_other' => 'Autre interface audio',
                                ],
                                '🎹 Instruments & Claviers' => [
                                    'piano_grand' => 'Piano à queue',
                                    'piano_upright' => 'Piano droit',
                                    'clavier_midi' => 'Clavier MIDI',
                                    'synth' => 'Synthétiseur',
                                    'drum_kit' => 'Batterie acoustique',
                                    'drum_electronic' => 'Batterie électronique',
                                    'guitar_electric' => 'Guitare électrique (prêt)',
                                    'guitar_acoustic' => 'Guitare acoustique (prêt)',
                                    'bass' => 'Basse (prêt)',
                                ],
                                '🎛️ Mixage & Monitoring' => [
                                    'console_ssl' => 'Console SSL',
                                    'console_neve' => 'Console Neve',
                                    'console_api' => 'Console API',
                                    'daw_protools' => 'Pro Tools',
                                    'daw_logic' => 'Logic Pro',
                                    'daw_ableton' => 'Ableton Live',
                                    'daw_studio_one' => 'Studio One',
                                    'monitor_genelec' => 'Monitors Genelec',
                                    'monitor_yamaha' => 'Monitors Yamaha HS',
                                    'monitor_adam' => 'Monitors ADAM Audio',
                                    'monitor_focal' => 'Monitors Focal',
                                    'subwoofer' => 'Caisson de basses (sub)',
                                    'headphones_dj' => 'Casques d\'écoute',
                                ],
                                '🎚️ Traitement du signal' => [
                                    'compressor_hardware' => 'Compresseur hardware',
                                    'eq_hardware' => 'Égaliseur hardware',
                                    'reverb_hardware' => 'Reverb hardware',
                                    'patchbay' => 'Patchbay',
                                    'plugin_bundle' => 'Bundle plugins (Waves, iZotope...)',
                                ],
                                '🏠 Infrastructures' => [
                                    'booth' => 'Cabine vocale (booth)',
                                    'lounge' => 'Salon d\'attente / lounge',
                                    'parking' => 'Parking disponible',
                                    'wifi' => 'Wi-Fi haut débit',
                                    'air_conditioning' => 'Climatisation',
                                    'accessible' => 'Accessible PMR',
                                    'kitchen' => 'Cuisine / coin repas',
                                ],
                            ];
                            @endphp

                            <div class="row x-gap-30 y-gap-30">
                                @foreach($equipmentCategories as $category => $items)
                                    <div class="col-xl-4 col-lg-6 col-12">
                                        <div class="bg-light-2 rounded-8 p-20 h-full">
                                            <div class="text-15 fw-600 mb-15 text-dark-1">{{ $category }}</div>
                                            <div class="row y-gap-10">
                                                @foreach($items as $key => $label)
                                                    <div class="col-12">
                                                        <div class="d-flex items-center">
                                                            <div class="form-checkbox">
                                                                <input type="checkbox"
                                                                       name="equipment[]"
                                                                       value="{{ $key }}"
                                                                       id="eq_{{ $key }}"
                                                                       {{ in_array($key, old('equipment', [])) ? 'checked' : '' }}>
                                                                <div class="form-checkbox__mark">
                                                                    <div class="form-checkbox__icon icon-check"></div>
                                                                </div>
                                                            </div>
                                                            <label class="text-14 ml-10 cursor-pointer" for="eq_{{ $key }}">{{ $label }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
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
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .cursor-pointer {
        cursor: pointer;
    }
    .alert {
        padding: 15px;
        margin-bottom: 20px;
        border: 1px solid transparent;
        border-radius: 4px;
    }
    .default-image-text {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-weight: bold;
        pointer-events: none;
    }
    .position-relative {
        position: relative;
    }
    .d-none {
        display: none;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Activer l'onglet approprié en fonction de la session
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

        // Gestion des messages flash
        const successMessage = document.querySelector('.alert-success');
        const errorMessage = document.querySelector('.alert-error');

        // Fonction pour faire disparaître un message
        function fadeOutMessage(element) {
            if (element) {
                element.style.transition = 'opacity 0.5s ease';
                element.style.opacity = '0';
                setTimeout(() => {
                    element.style.display = 'none';
                }, 500);
            }
        }

        // Disparition après 3 secondes
        if (successMessage) {
            setTimeout(() => fadeOutMessage(successMessage), 3000);
        }

        if (errorMessage) {
            setTimeout(() => fadeOutMessage(errorMessage), 3000);
        }
    });

    function previewImage(event, imageNumber) {
        const file = event.target.files[0];
        const defaultSrc = '{{ asset('media/img/backgrounds/11.jpg') }}';

        function resetToDefault() {
            document.getElementById('studioImage' + imageNumber).src = defaultSrc;
            const defaultText = document.getElementById('defaultImageText' + imageNumber);
            if (defaultText) defaultText.classList.remove('d-none');
            event.target.value = '';
        }

        if (file) {
            if (file.size > 2 * 1024 * 1024) {
                if (typeof showToast === 'function') showToast('error', "L'image ne doit pas dépasser 2 Mo.");
                resetToDefault();
                return;
            }

            if (file.type === 'image/png' || file.type === 'image/jpeg') {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = new Image();
                    img.onload = function() {
                        const minWidth = 400;
                        const minHeight = 300;
                        if (img.width < minWidth || img.height < minHeight) {
                            if (typeof showToast === 'function') showToast('error', `L'image doit faire au minimum ${minWidth}×${minHeight} px (votre image : ${img.width}×${img.height} px).`);
                            resetToDefault();
                            return;
                        }
                        document.getElementById('studioImage' + imageNumber).src = e.target.result;
                        const defaultText = document.getElementById('defaultImageText' + imageNumber);
                        if (defaultText) defaultText.classList.add('d-none');
                        const removeImageInput = document.getElementById('removeImage' + imageNumber + 'Input');
                        if (removeImageInput) removeImageInput.value = '0';
                    };
                    img.src = e.target.result;
                };
                reader.readAsDataURL(file);
            } else {
                if (typeof showToast === 'function') showToast('error', 'Seuls les formats PNG et JPG sont autorisés.');
                resetToDefault();
            }
        }
    }

    function removeImage(imageNumber) {
        // Mettre à jour la source de l'image avec l'image par défaut
        document.getElementById('studioImage' + imageNumber).src = '{{ asset('media/img/backgrounds/11.jpg') }}';

        // Afficher le texte "Par défaut"
        const defaultText = document.getElementById('defaultImageText' + imageNumber);
        if (defaultText) {
            defaultText.classList.remove('d-none');
        }

        // Mettre à jour le champ caché pour indiquer que l'image doit être supprimée
        const removeImageInput = document.getElementById('removeImage' + imageNumber + 'Input');
        if (removeImageInput) {
            removeImageInput.value = '1';
        }

        // Supprimer l'input file pour éviter les conflits
        const fileInput = document.getElementById('imageUpload' + imageNumber);
        if (fileInput) {
            fileInput.value = ''; // Réinitialiser la valeur du champ de fichier
        }
    }

    document.querySelector('.js-studio-form').addEventListener('submit', async function(e) {
        e.preventDefault();

        // If latitude and longitude are not already filled
        if (!document.getElementById('latitude').value || !document.getElementById('longitude').value) {
            const address = document.querySelector('input[name="address"]').value;
            const city = document.querySelector('input[name="city"]').value;
            const zipcode = document.querySelector('input[name="zipcode"]').value;
            const country = document.querySelector('input[name="country"]').value;

            const fullAddress = `${address}, ${city}, ${zipcode}, ${country}`;

            try {
                const response = await fetch(`/api/geocode/search?q=${encodeURIComponent(fullAddress)}`);
                const data = await response.json();

                if (data && data.length > 0) {
                    document.getElementById('latitude').value = data[0].lat;
                    document.getElementById('longitude').value = data[0].lon;
                } else {
                    clearFormErrors(this);
                    showValidationErrors(this, { address: ["Adresse introuvable. Veuillez utiliser l'autocomplétion pour sélectionner une adresse valide."] });
                    if (typeof showToast === 'function') showToast('error', 'Adresse non trouvée.');
                    return;
                }
            } catch (error) {
                console.error('Erreur lors de la récupération des coordonnées:', error);
                clearFormErrors(this);
                showValidationErrors(this, { address: ["Erreur de communication avec le service d'adresses."] });
                if (typeof showToast === 'function') showToast('error', 'Erreur serveur.');
                return;
            }
        }

        // Now submit via AJAX handler
        handleAjaxForm(this);
    });

    // Address Autocomplete Logic using api-adresse.data.gouv.fr
    const addressInput = document.getElementById('autocomplete-address');
    const suggestionsBox = document.getElementById('address-suggestions');
    const cityInput = document.getElementById('input-city');
    const zipcodeInput = document.getElementById('input-zipcode');
    const countryInput = document.getElementById('input-country');
    const latInput = document.getElementById('latitude');
    const lonInput = document.getElementById('longitude');

    let debounceTimeout;

    addressInput.addEventListener('input', function() {
        const query = this.value;
        suggestionsBox.innerHTML = '';
        suggestionsBox.style.display = 'none';

        if (query.length < 3) return;

        clearTimeout(debounceTimeout);
        debounceTimeout = setTimeout(() => {
            fetch(`https://api-adresse.data.gouv.fr/search/?q=${encodeURIComponent(query)}&limit=5`)
                .then(response => response.json())
                .then(data => {
                    if (data.features && data.features.length > 0) {
                        suggestionsBox.style.display = 'block';
                        data.features.forEach(feature => {
                            const li = document.createElement('li');
                            li.className = 'px-20 py-15 border-bottom-light cursor-pointer hover:bg-light-2 transition';
                            li.innerHTML = `<span class="fw-500">${feature.properties.name}</span><br><span class="text-13 text-light-1">${feature.properties.postcode} ${feature.properties.city}</span>`;
                            
                            li.addEventListener('click', () => {
                                // Fill inputs
                                addressInput.value = feature.properties.name;
                                cityInput.value = feature.properties.city;
                                zipcodeInput.value = feature.properties.postcode;
                                countryInput.value = 'France'; // API is France-only
                                latInput.value = feature.geometry.coordinates[1]; // Latitude
                                lonInput.value = feature.geometry.coordinates[0]; // Longitude
                                
                                // Trigger input event to update label floating states if needed
                                ['input', 'change'].forEach(eventType => {
                                    cityInput.dispatchEvent(new Event(eventType));
                                    zipcodeInput.dispatchEvent(new Event(eventType));
                                    countryInput.dispatchEvent(new Event(eventType));
                                });

                                // Hide suggestions
                                suggestionsBox.innerHTML = '';
                                suggestionsBox.style.display = 'none';
                            });

                            suggestionsBox.appendChild(li);
                        });
                    }
                })
                .catch(error => console.error('Erreur API Adresse:', error));
        }, 300); // 300ms delay to avoid spamming the API
    });

    // Close suggestions when clicking outside
    document.addEventListener('click', function(e) {
        if (!addressInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
            suggestionsBox.style.display = 'none';
        }
    });
</script>
