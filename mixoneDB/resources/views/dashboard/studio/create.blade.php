To center the trash icon within its container, you can use CSS flexbox properties. Here is the updated code with the necessary CSS adjustments:

```blade
@extends('layouts.backendDB')

@section('content')

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
                                        <input type="text" name="name" required>
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
                                        <textarea name="description" rows="5"></textarea>
                                        <label class="lh-1 text-16 text-light-1">Contenu</label>
                                    </div>
                                    @error('description')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <div class="form-input">
                                        <input type="text" name="youtube_video">
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
                                    <div class="form-input">
                                        <input type="text" name="address" required>
                                        <label class="lh-1 text-16 text-light-1">Adresse</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-input">
                                        <input type="text" name="zipcode" required>
                                        <label class="lh-1 text-16 text-light-1">Code postal</label>
                                    </div>
                                    @error('zipcode')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <div class="form-input">
                                        <input type="text" name="city" required>
                                        <label class="lh-1 text-16 text-light-1">Ville</label>
                                    </div>
                                    @error('city')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-4">
                                    <div class="form-input">
                                        <input type="text" name="country" required>
                                        <label class="lh-1 text-16 text-light-1">Pays</label>
                                    </div>
                                    @error('country')
                                    <span class="text-danger" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tabs__pane -tab-item-3">
                        <div class="col-xl-10">
                            <div class="text-18 fw-500 mb-10">Tarifs</div>
                            <div class="row x-gap-20 y-gap-20">
                                <div class="col-6">
                                    <div class="form-input">
                                        <input type="text" name="hourly_rate" required>
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
                                        <input type="text" name="min_hours" required>
                                        <label class="lh-1 text-16 text-light-1">Heures minimum</label>
                                    </div                                    @error('min_hours')
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
            if (file.type === 'image/png' || file.type === 'image/jpeg') {
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
            } else {
                alert('Only PNG and JPG images are allowed.');
            }
        }
    }

    function removeImage(element) {
        element.closest('.col-auto').remove();
    }
</script>
```
