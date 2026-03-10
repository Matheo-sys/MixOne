@extends('layouts.backendDB')

@section('content')

    <div class="row y-gap-20 justify-between items-end pb-40 lg:pb-30 md:pb-24">
        <div class="col-auto ml-10">
            <h1 class="text-26 sm:text-22 lh-14 fw-600">MODIFIER LE STUDIO</h1>
            <div class="text-15 text-light-1">Gardez les informations de votre studio à jour.</div>
        </div>
        <div class="col-auto"></div>
    </div>

    @if(session('success'))
        <div id="success-message" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="py-30 px-30 sm:px-15 rounded-4 bg-white shadow-3">
        <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 sm:x-gap-10 js-tabs-controls overflow-x-auto">
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Informations Générales</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-2">Localisation</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-3">Photos</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-4">Équipements</button>
                </div>
            </div>

            <div class="tabs__content pt-30 pb-40 js-tabs-content">
                <form action="{{ route('dashboard.studio.update', $studio->id) }}" method="POST" enctype="multipart/form-data" class="js-ajax-form" id="studioEditForm">
                    @csrf
                    @method('PUT')

                    <div class="tabs__pane -tab-item-1 is-tab-el-active">
                        <div class="col-xl-9">
                            <div class="row x-gap-20 y-gap-20">
                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="text" name="name" value="{{ old('name', $studio->name) }}" required>
                                        <label class="lh-1 text-16 text-light-1">Nom du studio</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-input">
                                        <textarea name="description" rows="5" required>{{ old('description', $studio->description) }}</textarea>
                                        <label class="lh-1 text-16 text-light-1">Description</label>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-input">
                                        <input type="number" step="0.01" name="hourly_rate" value="{{ old('hourly_rate', $studio->hourly_rate) }}" required>
                                        <label class="lh-1 text-16 text-light-1">Tarif horaire (€)</label>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-input">
                                        <input type="number" name="min_hours" value="{{ old('min_hours', $studio->min_hours) }}" required>
                                        <label class="lh-1 text-16 text-light-1">Durée minimum (heures)</label>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="tabs__pane -tab-item-2">
                        <div class="col-xl-9">
                            <div class="row x-gap-20 y-gap-20">
                                <div class="col-12 relative" style="position: relative;">
                                    <div class="form-input">
                                        <input type="text" name="address" id="edit-autocomplete-address" value="{{ old('address', $studio->address) }}" required autocomplete="off">
                                        <label class="lh-1 text-16 text-light-1">Adresse</label>
                                    </div>
                                    <!-- Autocomplete Dropdown -->
                                    <ul id="edit-address-suggestions" class="absolute bg-white shadow-2 rounded-8 w-100 z-5" style="display: none; max-height: 250px; overflow-y: auto; list-style: none; padding: 0; margin: 5px 0 0 0; top: 100%; left: 0;">
                                    </ul>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-input">
                                        <input type="text" name="city" id="edit-input-city" value="{{ old('city', $studio->city) }}" required>
                                        <label class="lh-1 text-16 text-light-1">Ville</label>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-input">
                                        <input type="text" name="zipcode" id="edit-input-zipcode" value="{{ old('zipcode', $studio->zipcode) }}" required>
                                        <label class="lh-1 text-16 text-light-1">Code Postal</label>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-input">
                                        <input type="text" name="country" id="edit-input-country" value="{{ old('country', $studio->country) }}" required>
                                        <label class="lh-1 text-16 text-light-1">Pays</label>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-input">
                                        <input type="text" name="latitude" id="edit-latitude" value="{{ old('latitude', $studio->latitude) }}" readonly>
                                        <label class="lh-1 text-16 text-light-1">Latitude</label>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-input">
                                        <input type="text" name="longitude" id="edit-longitude" value="{{ old('longitude', $studio->longitude) }}" readonly>
                                        <label class="lh-1 text-16 text-light-1">Longitude</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="text-14">
                                        <p>Les coordonnées seront automatiquement mises à jour en fonction de l'adresse saisie.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tabs__pane -tab-item-3">
                        <div class="col-xl-12 mt-30">
                            <div class="d-flex flex-wrap x-gap-20 y-gap-20"> <!-- Utilisation de flexbox pour aligner les éléments en ligne -->
                                @for ($i = 1; $i <= 4; $i++)
                                    @php
                                        $imageField = "image{$i}";
                                        $removeField = "remove_image{$i}";
                                    @endphp
                                    <div class="d-flex flex-column align-items-center mb-20"> <!-- Nettoyage des marges -->
                                        <div class="d-flex ratio ratio-3:2 w-200 position-relative">
                                            <img id="studioImage{{ $i }}" src="{{ $studio->$imageField ? asset('storage/' . $studio->$imageField) : asset('media/img/backgrounds/11.jpg') }}" alt="Image {{ $i }}" class="img-ratio rounded-4">
                                            <div class="d-flex justify-end px-10 py-10 h-100 w-1/1 absolute">
                                                <div class="size-40 bg-white rounded-4 cursor-pointer d-flex items-center justify-center" onclick="removeImage({{ $i }})">
                                                    <i class="icon-trash text-16"></i>
                                                </div>
                                            </div>
                                            <!-- Ajout du texte "Par défaut" -->
                                            <div id="defaultImageText{{ $i }}" class="default-image-text {{ $studio->$imageField ? 'd-none' : '' }}">
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

                    <div class="tabs__pane -tab-item-4">
                        <div class="col-xl-11">
                            <div class="text-18 fw-500 mb-5">Équipements du Studio</div>
                            <div class="text-14 text-light-1 mb-25">Cochez les équipements disponibles dans votre studio d'enregistrement.</div>

                            @php
                            $currentEquipment = $studio->equipment ?? [];
                            $equipmentCategories = [
                                '🎤️ Microphones' => [
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
                                                                       id="eq_edit_{{ $key }}"
                                                                       {{ in_array($key, $currentEquipment) ? 'checked' : '' }}>
                                                                <div class="form-checkbox__mark">
                                                                    <div class="form-checkbox__icon icon-check"></div>
                                                                </div>
                                                            </div>
                                                            <label class="text-14 ml-10 cursor-pointer" for="eq_edit_{{ $key }}">{{ $label }}</label>
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

                    <div class="d-inline-block pt-30">
                        <button type="submit" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                            Sauvegarder les modifications <div class="icon-arrow-top-right ml-15"></div>
                        </button>
                        <a href="{{ route('dashboard.studio.myStudios') }}" class="button h-50 px-24 -blue-1 bg-blue-1-05 text-blue-1 mt-10">
                            Retour
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Afficher le message de succès avec une animation et le faire disparaître après 5 secondes
        const successMessage = document.getElementById('success-message');
        if (successMessage) {
            // Animation fade in
            successMessage.style.opacity = '0';
            successMessage.style.transition = 'opacity 0.5s ease';

            setTimeout(() => {
                successMessage.style.opacity = '1';
            }, 100);

            // Disparition après 5 secondes
            setTimeout(() => {
                successMessage.style.opacity = '0';
                setTimeout(() => {
                    successMessage.style.display = 'none';
                }, 500);
            }, 5000);
        }

        // Initialisation des textes "Par défaut"
        for (let i = 1; i <= 4; i++) {
            const imgElement = document.getElementById('studioImage' + i);
            const defaultText = document.getElementById('defaultImageText' + i);

            // Vérifier si l'image est celle par défaut
            if (imgElement && defaultText) {
                const isDefaultImage = imgElement.src.includes('backgrounds/11.jpg');
                if (isDefaultImage) {
                    defaultText.classList.remove('d-none');
                } else {
                    defaultText.classList.add('d-none');
                }
            }
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
        // Mettre à jour la source l'image avec l'image par défaut
        document.getElementById('studioImage' + imageNumber).src = '{{ asset('media/img/backgrounds/11.jpg') }}';
        
        // Afficher le texte "Par défaut"
        const defaultText = document.getElementById('defaultImageText' + imageNumber);
        if (defaultText) {
            defaultText.classList.remove('d-none');
        }

        // Mettre à jour le champ caché
        const removeImageInput = document.getElementById('removeImage' + imageNumber + 'Input');
        if (removeImageInput) {
            removeImageInput.value = '1';
        }

        // Supprimer l'input file 
        const fileInput = document.getElementById('imageUpload' + imageNumber);
        if (fileInput) {
            fileInput.value = ''; 
        }
    }

    // ─── Edit form : validation adresse + autocomplétion ──────────────────────
    document.addEventListener('DOMContentLoaded', function() {

        const studioEditForm   = document.getElementById('studioEditForm');
        const addressInput     = document.getElementById('edit-autocomplete-address');
        const suggestionsBox   = document.getElementById('edit-address-suggestions');
        const cityInput        = document.getElementById('edit-input-city');
        const zipcodeInput     = document.getElementById('edit-input-zipcode');
        const countryInput     = document.getElementById('edit-input-country');
        const latInput         = document.getElementById('edit-latitude');
        const lonInput         = document.getElementById('edit-longitude');

        // L'adresse existante du studio est déjà validée (coordonnées en BDD)
        // On la marque en vert pour indiquer qu'elle est ok
        if (addressInput && latInput && latInput.value) {
            addressInput.style.borderColor = '#22c55e';
        }

        // ─── Interception soumission (capture, avant AJAX global) ───
        if (studioEditForm) {
            studioEditForm.addEventListener('submit', function(e) {
                const lat = latInput ? latInput.value : '';
                const lng = lonInput ? lonInput.value : '';

                if (!lat || !lng) {
                    e.preventDefault();
                    e.stopImmediatePropagation();

                    if (typeof clearFormErrors === 'function') clearFormErrors(this);
                    if (typeof showValidationErrors === 'function') {
                        showValidationErrors(this, {
                            address: ["Veuillez sélectionner une adresse depuis les suggestions (autocomplétion) pour valider la localisation."]
                        });
                    }
                    if (typeof showToast === 'function') {
                        showToast('error', 'Adresse invalide : sélectionnez une adresse dans la liste de suggestions.');
                    }
                    if (addressInput) {
                        addressInput.style.borderColor = '#dd2727';
                        addressInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        addressInput.focus();
                    }
                    return false;
                }
            }, true); // capture : s'exécute avant le listener bubble de ajax-forms.js
        }

        // ─── Autocomplétion ───
        if (!addressInput || !suggestionsBox) return;

        let debounceTimeout;

        // L'user retape → on invalide les coordonnées immédiatement
        addressInput.addEventListener('input', function() {
            if (latInput) latInput.value = '';
            if (lonInput) lonInput.value = '';
            addressInput.style.borderColor = '';

            const query = this.value.trim();
            suggestionsBox.innerHTML = '';
            suggestionsBox.style.display = 'none';
            if (query.length < 3) return;

            clearTimeout(debounceTimeout);
            debounceTimeout = setTimeout(() => {
                fetch(`https://api-adresse.data.gouv.fr/search/?q=${encodeURIComponent(query)}&limit=5`)
                    .then(r => r.json())
                    .then(data => {
                        if (!data.features || data.features.length === 0) return;
                        suggestionsBox.style.display = 'block';
                        data.features.forEach(feature => {
                            const li = document.createElement('li');
                            li.style.cssText = 'list-style:none;padding:12px 20px;border-bottom:1px solid #eee;cursor:pointer;transition:background .15s;';
                            li.innerHTML = `<span style="font-weight:600;color:#1a1a2e;">${feature.properties.name}</span><br><span style="font-size:12px;color:#888;">${feature.properties.postcode} ${feature.properties.city}</span>`;

                            li.addEventListener('mouseenter', () => li.style.background = '#f0f4ff');
                            li.addEventListener('mouseleave', () => li.style.background = '');

                            li.addEventListener('mousedown', (ev) => {
                                ev.preventDefault(); // empêche le blur avant la sélection
                                addressInput.value = feature.properties.name;
                                if (cityInput)    cityInput.value    = feature.properties.city;
                                if (zipcodeInput) zipcodeInput.value = feature.properties.postcode;
                                if (countryInput) countryInput.value = 'France';
                                if (latInput)     latInput.value     = feature.geometry.coordinates[1];
                                if (lonInput)     lonInput.value     = feature.geometry.coordinates[0];
                                addressInput.style.borderColor = '#22c55e'; // vert = validé

                                // Trigger pour les labels flottants
                                ['input','change'].forEach(ev2 => {
                                    [cityInput, zipcodeInput, countryInput, latInput, lonInput]
                                        .filter(Boolean)
                                        .forEach(inp => inp.dispatchEvent(new Event(ev2)));
                                });

                                suggestionsBox.innerHTML = '';
                                suggestionsBox.style.display = 'none';

                                // Supprime l'éventuelle erreur inline
                                document.querySelectorAll('.ajax-error').forEach(el => {
                                    if (el.textContent.includes('adresse') || el.textContent.includes('Adresse')) el.remove();
                                });
                            });

                            suggestionsBox.appendChild(li);
                        });
                    })
                    .catch(err => console.error('API Adresse (edit):', err));
            }, 300);
        });

        // Fermer les suggestions au clic en dehors
        document.addEventListener('click', function(e) {
            if (!addressInput.contains(e.target) && !suggestionsBox.contains(e.target)) {
                suggestionsBox.style.display = 'none';
            }
        });

    }); // fin DOMContentLoaded

</script>

