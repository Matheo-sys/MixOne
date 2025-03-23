@extends('layouts.backendDB')

@section('content')

    <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
        <div class="text-center">
            <h1 class="lh-14 fw-600">Modifier le Studio</h1>
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

    <div class="py-30 px-30 rounded-4 bg-white shadow-3">
        <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Informations Générales</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-2">Localisation</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-3">Photos</button>
                </div>
            </div>

            <div class="tabs__content pt-30 js-tabs-content">
                <form action="{{ route('dashboard.studio.update', $studio->id) }}" method="POST" enctype="multipart/form-data">
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
                                        <textarea name="description" rows="5">{{ old('description', $studio->description) }}</textarea>
                                        <label class="lh-1 text-16 text-light-1">Description</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-input">
                                        <input type="number" step="0.01" name="hourly_rate" value="{{ old('hourly_rate', $studio->hourly_rate) }}" required>
                                        <label class="lh-1 text-16 text-light-1">Tarif horaire (€)</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
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
                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="text" name="address" value="{{ old('address', $studio->address) }}" required>
                                        <label class="lh-1 text-16 text-light-1">Adresse</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-input">
                                        <input type="text" name="city" value="{{ old('city', $studio->city) }}" required>
                                        <label class="lh-1 text-16 text-light-1">Ville</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-input">
                                        <input type="text" name="zipcode" value="{{ old('zipcode', $studio->zipcode) }}" required>
                                        <label class="lh-1 text-16 text-light-1">Code Postal</label>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="text" name="country" value="{{ old('country', $studio->country) }}" required>
                                        <label class="lh-1 text-16 text-light-1">Pays</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-input">
                                        <input type="text" name="latitude" value="{{ old('latitude', $studio->latitude) }}" readonly>
                                        <label class="lh-1 text-16 text-light-1">Latitude</label>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-input">
                                        <input type="text" name="longitude" value="{{ old('longitude', $studio->longitude) }}" readonly>
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

                    <div class="tabs__pane -tab-item-3 mt-30 ml-30 mb-30">
                        <div class="col-xl-12">
                            <div class="d-flex flex-wrap x-gap-20 y-gap-20"> <!-- Utilisation de flexbox pour aligner les éléments en ligne -->
                                @for ($i = 1; $i <= 4; $i++)
                                    @php
                                        $imageField = "image{$i}";
                                        $removeField = "remove_image{$i}";
                                    @endphp
                                    <div class="d-flex flex-column align-items-center me-20 mb-20 ml-3"> <!-- Ajout de `me-20` pour l'espacement horizontal -->
                                        <div class="d-flex ratio ratio-3:2 w-200 position-relative">
                                            <img id="studioImage{{ $i }}" src="{{ $studio->$imageField ? asset('storage/' . $studio->$imageField) : asset('media/img/backgrounds/11.jpg') }}" alt="Image {{ $i }}" class="img-ratio rounded-4">
                                            <div class="d-flex justify-end px-10 py-10 h-100 w-1/1 absolute">
                                                <div class="size-40 bg-white rounded-4 cursor-pointer" onclick="removeImage({{ $i }})">
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

                    <div class="d-inline-block pt-30">
                        <button type="submit" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                            Sauvegarder les modifications <div class="icon-arrow-top-right ml-15"></div>
                        </button>
                        <a href="{{ route('dashboard.studios') }}" class="button h-50 px-24 -blue-1 bg-blue-1-05 text-blue-1 mt-10">
                            Retour
                        </a>
                    </div>
                </form>
            </div>
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
    .alert-success {
        color: #3c763d;
        background-color: #dff0d8;
        border-color: #d6e9c6;
    }
    .alert-danger {
        color: #a94442;
        background-color: #f2dede;
        border-color: #ebccd1;
    }

    .form-input {
        position: relative;
    }

    .form-input input[readonly] {
        background-color: transparent;
        border: 1px solid var(--color-border);
        cursor: default;
    }

    .form-input label {
        position: absolute;
        top: 0;
        left: 0;
        pointer-events: none;
        transition: all 0.2s ease;
        transform-origin: top left;
        transform: translateY(0) scale(1);
    }

    .form-input input[readonly]:focus + label,
    .form-input input[readonly]:not(:placeholder-shown) + label {
        transform: translateY(-20px) scale(0.8);
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
        pointer-events: none; /* pour éviter que le texte interfère avec les clics */
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
</script>
