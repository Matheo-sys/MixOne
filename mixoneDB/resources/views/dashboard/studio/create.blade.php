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
                        <div class="col-xl-9 col-lg-11">
                            <div class="row x-gap-100 y-gap-15">
                                <div class="col-lg-3 col-sm-6">
                                    <div class="row y-gap-15">
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

        if (file) {
            if (file.size > 2 * 1024 * 1024) { // 2 Mo
                alert("L'image ne doit pas dépasser 2 Mo.");
                event.target.value = ''; // Réinitialise l'input
                return;
            }

            if (file.type === 'image/png' || file.type === 'image/jpeg') {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('studioImage' + imageNumber).src = e.target.result;

                    // Cacher le texte "Par défaut"
                    const defaultText = document.getElementById('defaultImageText' + imageNumber);
                    if (defaultText) {
                        defaultText.classList.add('d-none');
                    }
                };
                reader.readAsDataURL(file);

                // Réinitialiser le champ caché 'remove_image'
                const removeImageInput = document.getElementById('removeImage' + imageNumber + 'Input');
                if (removeImageInput) {
                    removeImageInput.value = '0';
                }
            } else {
                alert('Seuls les formats PNG et JPG sont autorisés.');
                event.target.value = ''; // Réinitialise l'input
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
</script>
