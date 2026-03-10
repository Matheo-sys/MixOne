@extends('layouts.backendDB')

@section('content')

    <div class="row y-gap-20 justify-center items-end pb-40 lg:pb-30 md:pb-24">
        <div class="col-auto text-center">
            <h1 class="text-26 sm:text-22 lh-14 fw-700 mb-10">Paramètres</h1>
            <div class="text-15 text-light-1">Personnalisez vos informations et mettez à jour votre profil.</div>
        </div>
    </div>


    <div class="py-30 px-30 sm:px-15 rounded-4 bg-white shadow-3">
        <div class="tabs -underline-2 js-tabs">
            <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Informations Personnelles</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-2">Moyens de Paiement</button>
                </div>
                <div class="col-auto">
                    <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button" data-tab-target=".-tab-item-3">Changer le Mot de Passe</button>
                </div>
            </div>

            <div class="tabs__content pt-30 js-tabs-content">
                <div class="tabs__pane -tab-item-1 is-tab-el-active">
                    <form action="{{ route('dashboard.settings.update') }}" method="POST" enctype="multipart/form-data" class="js-ajax-form">
                        @csrf
                        <div class="row y-gap-30 items-center">
                            <div class="col-auto">
                                <div class="d-flex ratio ratio-1:1 w-200">
                                    <img id="avatarImage" src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('media/img/misc/avatar-default.png') }}" alt="image" class="img-ratio rounded-4">
                                    <div class="d-flex justify-end px-10 py-10 h-100 w-1/1 absolute">
                                        <div class="size-40 bg-white rounded-4 cursor-pointer" onclick="removeImage()">
                                            <i class="icon-trash text-16"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <h4 class="text-16 fw-500">Ton avatar</h4>
                                <div class="text-14 mt-5">PNG ou JPG pas plus de 800px de hauteur et de largeur.</div>
                                <div class="d-inline-block mt-15">
                                    <input type="hidden" name="remove_avatar" id="removeAvatarInput" value="0">
                                    <p id="error-message" class="text-danger" style="display:none;">L'image ne doit pas dépasser 2 Mo.</p>
                                    <input type="file" id="imageUpload" name="avatar" accept="image/png, image/jpeg" style="display: none;" onchange="previewImage(event)">
                                    <label for="imageUpload" class="button h-50 px-24 -dark-1 bg-blue-1 text-white cursor-pointer">
                                        <i class="icon-upload-file text-20 mr-10"></i>
                                        Parcourir
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="border-top-light mt-30 mb-30"></div>

                        <div class="col-xl-9">
                            <div class="row x-gap-20 y-gap-20">
                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="text" name="username" value="{{ old('username', auth()->user()->username) }}">
                                        <label class="lh-1 text-16 text-light-1">Nom d'utilisateur</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-input">
                                        <input type="text" name="first_name" value="{{ old('first_name', auth()->user()->first_name) }}" required>
                                        <label class="lh-1 text-16 text-light-1">Prénom</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-input">
                                        <input type="text" name="last_name" value="{{ old('last_name', auth()->user()->last_name) }}" required>
                                        <label class="lh-1 text-16 text-light-1">Nom de famille</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-input">
                                        <input type="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
                                        <label class="lh-1 text-16 text-light-1">Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-input">
                                        <input type="text" name="phone" value="{{ old('phone', auth()->user()->phone) }}">
                                        <label class="lh-1 text-16 text-light-1">Numéro de téléphone</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="date" name="birth_date" value="{{ old('birth_date', auth()->user()->birth_date) }}">
                                        <label class="lh-1 text-16 text-light-1">Date de naissance</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-input">
                                        <textarea name="about" rows="5">{{ old('about', auth()->user()->about) }}</textarea>
                                        <label class="lh-1 text-16 text-light-1">À propos de toi</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="d-inline-block pt-30">
                            <button type="submit" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                Sauvegarder <div class="icon-arrow-top-right ml-15"></div>
                            </button>
                        </div>
                    </form>
                </div>

                <div class="tabs__pane -tab-item-2">
                    <form action="{{ route('dashboard.settings.update') }}" method="POST" class="js-ajax-form">
                        @csrf
                        <div class="col-xl-9">
                            <div class="row x-gap-20 y-gap-20">
                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="text" name="address_line1" value="{{ old('address_line1', auth()->user()->address_line1) }}">
                                        <label class="lh-1 text-16 text-light-1">Adresse (ligne 1)</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="text" name="address_line2" value="{{ old('address_line2', auth()->user()->address_line2) }}">
                                        <label class="lh-1 text-16 text-light-1">Adresse (ligne 2)</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-input">
                                        <input type="text" name="city" value="{{ old('city', auth()->user()->city) }}">
                                        <label class="lh-1 text-16 text-light-1">Ville</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-input">
                                        <input type="text" name="state" value="{{ old('state', auth()->user()->state) }}">
                                        <label class="lh-1 text-16 text-light-1">État/Région</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-input">
                                        <input type="text" name="country" value="{{ old('country', auth()->user()->country) }}">
                                        <label class="lh-1 text-16 text-light-1">Pays</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-input">
                                        <input type="text" name="zipcode" value="{{ old('zipcode', auth()->user()->zipcode) }}">
                                        <label class="lh-1 text-16 text-light-1">Code Postal</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="d-inline-block">
                                        <button type="submit" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                            Sauvegarder <div class="icon-arrow-top-right ml-15"></div>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="tabs__pane -tab-item-3">
                    <form action="{{ route('dashboard.settings.password') }}" method="POST" class="js-ajax-form" data-reset>
                        @csrf
                        <div class="col-xl-9">
                            <div class="row x-gap-20 y-gap-20">
                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="password" name="current_password" required>
                                        <label class="lh-1 text-16 text-light-1">Mot de passe actuel</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="password" name="password" required>
                                        <label class="lh-1 text-16 text-light-1">Nouveau mot de passe</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="password" name="password_confirmation" required>
                                        <label class="lh-1 text-16 text-light-1">Confirmer le nouveau mot de passe</label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="row x-gap-10 y-gap-10">
                                        <div class="col-auto">
                                            <button type="submit" class="button h-50 px-24 -dark-1 bg-blue-1 text-white">
                                                Sauvegarder <div class="icon-arrow-top-right ml-15"></div>
                                            </button>
                                        </div>
                                        <div class="col-auto">
                                            <button type="reset" class="button h-50 px-24 -blue-1 bg-blue-1-05 text-blue-1">Annuler</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
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
</style>


<script>
    function previewImage(event) {
        const file = event.target.files[0];
        const errorMessage = document.getElementById('error-message');

        if (file) {
            if (file.size > 2 * 1024 * 1024) { // 2 Mo
                errorMessage.style.display = 'block';
                event.target.value = ''; // Réinitialise l’input
                return;
            } else {
                errorMessage.style.display = 'none'; // Cache le message si OK
            }

            if (file.type === 'image/png' || file.type === 'image/jpeg') {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('avatarImage').src = e.target.result;
                };
                reader.readAsDataURL(file);

                // Supprimer le champ caché 'remove_avatar' s'il existe
                const removeAvatarInput = document.getElementById('removeAvatarInput');
                if (removeAvatarInput) {
                    removeAvatarInput.value = '0';
                }
            } else {
                alert('Only PNG and JPG images are allowed.');
                event.target.value = ''; // Réinitialise l’input
            }
        }
    }

    function removeImage() {
        // Mettre à jour la source de l'image avec l'image par défaut
        document.getElementById('avatarImage').src = '{{ asset('media/img/misc/avatar-default.png') }}';

        // Mettre à jour le champ caché pour indiquer que l'image doit être supprimée
        const removeAvatarInput = document.getElementById('removeAvatarInput');
        if (removeAvatarInput) {
            removeAvatarInput.value = '1';
        }

        // Supprimer l'input file pour éviter les conflits
        const fileInput = document.getElementById('imageUpload');
        if (fileInput) {
            fileInput.value = ''; // Réinitialiser la valeur du champ de fichier
        }
    }
</script>



