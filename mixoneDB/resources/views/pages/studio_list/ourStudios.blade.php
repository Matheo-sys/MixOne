<section class="pt-40 pb-40 bg-light-2">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h1 class="text-30 fw-600">NOS STUDIOS</h1>
                </div>

                <div class="mainSearch bg-white mt-30">
                    <form id="searchForm" action="{{route('studio_list')}}" method="GET">
                        <input type="hidden" id="latitude" name="latitude" value="48.7748198">
                        <input type="hidden" id="longitude" name="longitude" value="2.3262945">

                        <div class="mainSearch__grid">
                            <div class="mainSearch__item">
                                <label for="city" class="text-15 fw-500 ls-2 lh-16">City</label>
                                <div class="mainSearch__input">
                                    <input type="text" id="city" name="city" placeholder="City" value="" class="js-search js-dd-focus">
                                    <button type="button" id="geolocate-btn">
                                        <i class="icon-location text-16"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mainSearch__item position-relative">
                                <label for="min_hours" class="text-15 fw-500 ls-2 lh-16">Hours</label>
                                <div class="mainSearch__input">
                                    <input type="text" id="min_hours" name="min_hours" placeholder="Hours" value="{{ request('min_hours', 2) }}" class="text-15 text-light-1" onclick="toggleHoursMenu(event)" readonly="">
                                </div>
                                <div id="hoursMenu" class="hours-menu hidden">
                                    <button type="button" class="button -outline-blue-1 text-blue-1 size-38 rounded-4" onclick="changeHours(-1)">
                                        <i class="icon-minus text-12"></i>
                                    </button>
                                    <div class="flex-center size-20 ml-15 mr-15">
                                        <div id="hoursValue" class="text-15">2</div>
                                    </div>
                                    <button type="button" class="button -outline-blue-1 text-blue-1 size-38 rounded-4" onclick="changeHours(1)">
                                        <i class="icon-plus text-12"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="mainSearch__button">
                                <button type="submit" class="button bg-blue-1 text-white">
                                    <i class="icon-search text-20 mr-10"></i>
                                    Search
                                </button>
                            </div>
                        </div>
                    </form>
                </div>


            </div>
        </div>
</section>

<section class="layout-pt-md layout-pb-lg">
    <div class="container">
        <div class="row y-gap-30">
            <div class="col-xl-3 col-lg-4 desktop-sidebar">
                <style>
                    @media (max-width: 1199px) { 
                        .desktop-sidebar { display: none !important; } 
                        .mobile-filter-btn { display: flex !important; }
                    }
                    @media (min-width: 1200px) {
                        .desktop-sidebar { display: block !important; }
                        .mobile-filter-btn { display: none !important; }
                    }
                </style>
                <aside class="sidebar y-gap-40">
                    <div class="sidebar__item -no-border">
                        <div class="flex-center ratio ratio-15:9 js-lazy" data-bg={{asset("media/img/general/map.png")}}>
                            <button id="openMapBtn" type="button" class="button py-15 px-24 -blue-1 bg-white text-dark-1 absolute">
                                <i class="icon-destination text-22 mr-10"></i>
                                Regarder sur la carte
                            </button>
                        </div>
                    </div>

                    <div class="sidebar__item">
                        <form action="{{ route('studio_list') }}" method="GET" id="sidebarFilterForm">
                            {{-- Preserve search params from top search bar --}}
                            <input type="hidden" name="latitude" value="{{ request('latitude', 0) }}">
                            <input type="hidden" name="longitude" value="{{ request('longitude', 0) }}">
                            <input type="hidden" name="city" value="{{ request('city', '') }}">
                            <input type="hidden" name="min_hours" value="{{ request('min_hours', '') }}">
                            <input type="hidden" name="sort_by" value="{{ request('sort_by', 'distance') }}">
                            <input type="hidden" name="sort_direction" value="{{ request('sort_direction', 'asc') }}">

                        <label for="distanceSlider" class="text-15 fw-500 ls-2 lh-16">Périmetre</label>
                        <div class="row x-gap-10 y-gap-30">
                            <div class="col-12">
                                <div class="js-price-rangeSlider">
                                    <div class="d-flex justify-between mb-20">
                                        <div class="text-15 text-dark-1">
                                            <span class="js-lower">0km</span>
                                            -
                                            <span class="js-upper">{{ request()->input('distance', 35) }}km</span>
                                        </div>
                                    </div>

                                    <div class="px-5">
                                        <input type="range" id="distance" name="distance" min="0" max="100" value="{{ request()->input('distance', 35) }}" class="slider w-100" oninput="updateDistanceValue(this.value)">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="button-grid items-center">


                            <div class="searchMenu-date px-30 lg:py-20 lg:px-0 js-form-dd js-calendar js-calendar-el">
                                <div id="hoursMenu" class="hours-menu hidden">
                                    <button type="button" class="button -outline-blue-1 text-blue-1 size-38 rounded-4" onclick="changeHours(-1)">
                                        <i class="icon-minus text-12"></i>
                                    </button>
                                    <div class="flex-center size-20 ml-15 mr-15">
                                        <div id="hoursValue" class="text-15">2</div>
                                    </div>

                                </div>
                            </div>


                        </div>

                        <div class="button-item">
                            {{-- Filtre équipements --}}
                            <div class="sidebar__item mt-20">
                                <h5 class="text-16 fw-500 mb-15">Équipements</h5>
                                @php
                                $equipListFlat = [
                                    'micro_condenser' => '🎙️ Micro condensateur',
                                    'micro_dynamic' => '🎙️ Micro dynamique',
                                    'booth' => '🏠 Cabine vocale',
                                    'daw_protools' => '💻 Pro Tools',
                                    'daw_logic' => '💻 Logic Pro',
                                    'daw_ableton' => '💻 Ableton Live',
                                    'monitor_genelec' => '🔊 Monitors Genelec',
                                    'monitor_yamaha' => '🔊 Monitors Yamaha',
                                    'piano_grand' => '🎹 Piano à queue',
                                    'drum_kit' => '🥁 Batterie acoustique',
                                    'drum_electronic' => '🥁 Batterie électronique',
                                    'synth' => '🎹 Synthétiseur',
                                    'preamp_neve' => '🎛️ Preamp Neve',
                                    'console_ssl' => '🎛️ Console SSL',
                                    'interface_apollo' => '🔌 Interface Apollo',
                                    'interface_focusrite' => '🔌 Interface Focusrite',
                                    'wifi' => '📶 Wi-Fi',
                                    'parking' => '🅿️ Parking',
                                    'accessible' => '♿ Accessible PMR',
                                ];
                                $selectedEquipment = $selectedEquipment ?? request()->input('equipment', []);
                                @endphp
                                <div class="row y-gap-8" style="max-height: 250px; overflow-y: auto;">
                                    @foreach($equipListFlat as $key => $label)
                                        <div class="col-12">
                                            <div class="d-flex items-center">
                                                <div class="form-checkbox">
                                                    <input type="checkbox"
                                                           name="equipment[]"
                                                           value="{{ $key }}"
                                                           id="filter_{{ $key }}"
                                                           {{ in_array($key, $selectedEquipment) ? 'checked' : '' }}>
                                                    <div class="form-checkbox__mark">
                                                        <div class="form-checkbox__icon icon-check"></div>
                                                    </div>
                                                </div>
                                                <label class="text-13 ml-10 cursor-pointer" for="filter_{{ $key }}">{{ $label }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <button type="submit" class="mainSearch__submit button -dark-1 h-60 px-35 col-12 bg-blue-1 text-white mt-20">
                                <i class="icon-search text-20 mr-10"></i>
                                Appliquer
                            </button>
                        </div>
                        </form>
                    </div>
                </aside>
            </div>

            <div class="col-xl-9 col-lg-8">
                <div class="row y-gap-10 items-center justify-between">
                    <div class="col-auto">
                        <div class="text-18"><span class="fw-500">{{ count($studios) }} studios</span> correspondent à votre recherche</div>
                    </div>

                    <div class="col-auto">
                        <div class="row x-gap-20 y-gap-20">
                            <div class="col-auto">

                                <div class="col-auto">
                                    <form action="{{ route('studio_list') }}" method="GET" id="sortForm">
                                        {{-- Preserve all active filters --}}
                                        <input type="hidden" name="latitude" value="{{ request('latitude', 0) }}">
                                        <input type="hidden" name="longitude" value="{{ request('longitude', 0) }}">
                                        <input type="hidden" name="city" value="{{ request('city', '') }}">
                                        <input type="hidden" name="distance" value="{{ request('distance', 50) }}">
                                        <input type="hidden" name="min_hours" value="{{ request('min_hours', '') }}">
                                        @foreach(request('equipment', []) as $eq)
                                            <input type="hidden" name="equipment[]" value="{{ $eq }}">
                                        @endforeach
                                        <input type="hidden" name="sort_direction" id="sort_direction_sort" value="{{ request('sort_direction', 'asc') }}">

                                        <select name="sort_by" id="price-filter"
                                                class="button -blue-1 h-40 px-20 rounded-100 bg-blue-1-05 text-15 text-blue-1"
                                                onchange="
                                                    const selected = this.options[this.selectedIndex];
                                                    const dir = selected.dataset.dir || 'asc';
                                                    document.getElementById('sort_direction_sort').value = dir;
                                                    this.form.submit();
                                                ">
                                            <option value="distance" {{ request('sort_by') == 'distance' ? 'selected' : '' }}>Distance</option>
                                            <option value="price" data-dir="asc" {{ request('sort_by') == 'price' && request('sort_direction') == 'asc' ? 'selected' : '' }}>
                                                Prix Croissant
                                            </option>
                                            <option value="price" data-dir="desc" {{ request('sort_by') == 'price' && request('sort_direction') == 'desc' ? 'selected' : '' }}>
                                                Prix Décroissant
                                            </option>
                                        </select>
                                    </form>
                                </div>


                            </div>

                            <div class="col-auto mobile-filter-btn">
                                <button data-x-click="filterPopup" class="button -blue-1 h-40 px-20 rounded-100 bg-blue-1-05 text-15 text-blue-1">
                                    <i class="icon-up-down text-14 mr-10"></i>
                                    Filtrer / Carte
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="filterPopup bg-white" data-x="filterPopup" data-x-toggle="-is-active">
                    <aside class="sidebar -mobile-filter px-20 py-20 pb-100">
                        <div data-x-click="filterPopup" class="-icon-close">
                            <i class="icon-close"></i>
                        </div>

                        <div class="sidebar__item -no-border">
                            <div class="flex-center ratio ratio-15:9 js-lazy" data-bg={{asset("media/img/general/map.png")}}>
                                <button type="button" class="button py-15 px-24 -blue-1 bg-white text-dark-1 absolute" onclick="document.getElementById('openMapBtn').click()">
                                    <i class="icon-destination text-22 mr-10"></i>
                                    Regarder sur la carte
                                </button>
                            </div>
                        </div>

                        <form action="{{ route('studio_list') }}" method="GET">
                            {{-- Preserve search params --}}
                            <input type="hidden" name="latitude" value="{{ request('latitude', 0) }}">
                            <input type="hidden" name="longitude" value="{{ request('longitude', 0) }}">
                            <input type="hidden" name="city" value="{{ request('city', '') }}">
                            <input type="hidden" name="min_hours" value="{{ request('min_hours', '') }}">
                            <input type="hidden" name="sort_by" value="{{ request('sort_by', 'distance') }}">
                            <input type="hidden" name="sort_direction" value="{{ request('sort_direction', 'asc') }}">

                            <div class="sidebar__item">
                                <h5 class="text-18 fw-500 mb-15">Périmètre</h5>
                                <div class="js-price-rangeSlider">
                                    <div class="d-flex justify-between mb-20">
                                        <div class="text-15 text-dark-1">
                                            <span class="js-lower">0km</span>
                                            -
                                            <span class="js-upper-mobile">{{ request()->input('distance', 35) }}km</span>
                                        </div>
                                    </div>
                                    <div class="px-5">
                                        <input type="range" name="distance" min="0" max="100" value="{{ request()->input('distance', 35) }}" class="slider w-100" oninput="document.querySelector('.js-upper-mobile').textContent = this.value + 'km'">
                                    </div>
                                </div>
                            </div>

                            <div class="sidebar__item mt-30">
                                <h5 class="text-18 fw-500 mb-15">Équipements</h5>
                                <div class="row y-gap-8" style="max-height: 400px; overflow-y: auto;">
                                    @foreach($equipListFlat as $key => $label)
                                        <div class="col-12">
                                            <div class="d-flex items-center">
                                                <div class="form-checkbox">
                                                    <input type="checkbox" name="equipment[]" value="{{ $key }}" id="m_filter_{{ $key }}" {{ in_array($key, $selectedEquipment) ? 'checked' : '' }}>
                                                    <div class="form-checkbox__mark">
                                                        <div class="form-checkbox__icon icon-check"></div>
                                                    </div>
                                                </div>
                                                <label class="text-15 ml-10" for="m_filter_{{ $key }}">{{ $label }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="mt-30 pb-30">
                                <button type="submit" class="button -dark-1 h-60 px-35 col-12 bg-blue-1 text-white">
                                    Appliquer les filtres
                                </button>
                            </div>
                        </form>
                    </aside>
                </div>

                <div class="mt-30">
                    <!-- Boucle sur les studios comme dans le deuxième code -->
                    @foreach($studios as $studio)
                        <div class="border-top-light pt-20 mb-20">
                            <div class="row x-gap-20 y-gap-20 mobile-studio-card">
                                <div class="col-md-auto">
                                    <div class="cardImage mobile-card-image ratio w-250 md:w-1/1 rounded-4">
                                        <div class="cardImage__content">
                                            <div class="cardImage-slider rounded-4 overflow-hidden js-cardImage-slider">
                                                <div class="swiper-wrapper">
                                                    @php
                                                        $hasImages = false;
                                                        // Vérifier les 4 emplacements d'images possibles
                                                        for ($i = 1; $i <= 4; $i++) {
                                                            $imageField = "image{$i}";
                                                            if (!empty($studio->$imageField)) {
                                                                $hasImages = true;
                                                                echo '<div class="swiper-slide">';
                                                                echo '<img class="col-12" src="' . asset('storage/' . $studio->$imageField) . '" alt="Image studio ' . $studio->name . '">';
                                                                echo '</div>';
                                                            }
                                                        }

                                                        // Si aucune image n'est trouvée, afficher l'image par défaut
                                                        if (!$hasImages) {
                                                            echo '<div class="swiper-slide">';
                                                            echo '<img class="col-12" src="' . asset('media/img/backgrounds/11.jpg') . '" alt="Image par défaut">';
                                                            echo '</div>';
                                                        }
                                                    @endphp
                                                </div>
                                                <div class="cardImage-slider__pagination js-pagination"></div>
                                                <div class="cardImage-slider__nav -prev">
                                                    <button class="button -blue-1 bg-white size-30 rounded-full shadow-2 js-prev">
                                                        <i class="icon-chevron-left text-10"></i>
                                                    </button>
                                                </div>
                                                <div class="cardImage-slider__nav -next">
                                                    <button class="button -blue-1 bg-white size-30 rounded-full shadow-2 js-next">
                                                        <i class="icon-chevron-right text-10"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="cardImage__wishlist">
                                            <button class="button -blue-1 bg-white size-30 rounded-full shadow-2 wishlist-toggle" data-studio-id="{{ $studio->id }}">
                                                @if(Auth::check() && Auth::user()->favoriteStudios->contains($studio->id))
                                                    <i class="icon-heart text-12 text-blue-1"></i>
                                                @else
                                                    <i class="icon-heart text-12"></i>
                                                @endif
                                            </button>
                                        </div>

                                        @if($studio->user)
                                        <div class="cardImage__contact" style="position: absolute; bottom: 10px; right: 10px;">
                                            <button type="button" class="button -blue-1 bg-white size-30 rounded-full shadow-2"
                                                onclick="event.preventDefault(); window.startNewMessagingChat({{ $studio->user_id }}, '{{ addslashes($studio->user->first_name) }} {{ addslashes($studio->user->last_name) }}', '{{ $studio->user->avatar }}')">
                                                <i class="icon-email-2 text-12"></i>
                                            </button>
                                        </div>
                                        @endif


                                    </div>
                                </div>

                                <div class="col-md">
                                    <div class="d-flex flex-column h-full justify-between">
                                        <div class="">
                                            <p class="text-14 lh-14 mb-5">{{ $studio->city }}</p>
                                            <h3 class="text-18 lh-16 fw-500">{{ $studio->name }}</h3>

                                            <!-- Affichage de la distance si disponible -->
                                            @if(isset($studio->distance))
                                                <p class="text-light-1 lh-14 text-14 mt-5">
                                                    <i class="icon-location text-14 mr-5"></i>
                                                    {{ number_format($studio->distance, 1) }} km de votre position
                                                </p>
                                            @endif

                                            <div class="row x-gap-5 items-center pt-5">
                                                <!-- Étoiles ou autres indicateurs -->
                                            </div>
                                        </div>

                                        <div class="row x-gap-10 y-gap-10 pt-20">
                                            @php
                                            $equipLabels = [
                                                'micro_condenser' => 'Micro condensateur',
                                                'micro_dynamic' => 'Micro dynamique',
                                                'micro_ribbon' => 'Micro à ruban',
                                                'micro_large_diaphragm' => 'Grand diaphragme',
                                                'micro_small_diaphragm' => 'Petit diaphragme',
                                                'micro_usb' => 'Micro USB',
                                                'preamp_neve' => 'Preamp Neve',
                                                'preamp_api' => 'Preamp API',
                                                'preamp_ssl' => 'Preamp SSL',
                                                'interface_apollo' => 'Interface Apollo',
                                                'interface_focusrite' => 'Interface Focusrite',
                                                'interface_rme' => 'Interface RME',
                                                'interface_other' => 'Interface audio',
                                                'piano_grand' => 'Piano à queue',
                                                'piano_upright' => 'Piano droit',
                                                'clavier_midi' => 'Clavier MIDI',
                                                'synth' => 'Synthétiseur',
                                                'drum_kit' => 'Batterie acoustique',
                                                'drum_electronic' => 'Batterie électronique',
                                                'guitar_electric' => 'Guitare électrique',
                                                'guitar_acoustic' => 'Guitare acoustique',
                                                'bass' => 'Basse',
                                                'console_ssl' => 'Console SSL',
                                                'console_neve' => 'Console Neve',
                                                'console_api' => 'Console API',
                                                'daw_protools' => 'Pro Tools',
                                                'daw_logic' => 'Logic Pro',
                                                'daw_ableton' => 'Ableton Live',
                                                'daw_studio_one' => 'Studio One',
                                                'monitor_genelec' => 'Monitors Genelec',
                                                'monitor_yamaha' => 'Monitors Yamaha',
                                                'monitor_adam' => 'Monitors ADAM',
                                                'monitor_focal' => 'Monitors Focal',
                                                'subwoofer' => 'Caisson de basses',
                                                'headphones_dj' => 'Casques écoute',
                                                'compressor_hardware' => 'Compresseur',
                                                'eq_hardware' => 'Égaliseur',
                                                'reverb_hardware' => 'Reverb',
                                                'patchbay' => 'Patchbay',
                                                'plugin_bundle' => 'Bundle plugins',
                                                'booth' => 'Cabine vocale',
                                                'lounge' => 'Salon lounge',
                                                'parking' => 'Parking',
                                                'wifi' => 'Wi-Fi',
                                                'air_conditioning' => 'Climatisation',
                                                'accessible' => 'Accessible PMR',
                                                'kitchen' => 'Cuisine',
                                            ];
                                            $studioEq = $studio->equipment ?? [];
                                            $preview = array_slice($studioEq, 0, 4);
                                            $hasMore = count($studioEq) > 4;
                                            @endphp
                                            @if(!empty($preview))
                                                @foreach($preview as $eqKey)
                                                    @if(isset($equipLabels[$eqKey]))
                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-15 text-13 lh-14">{{ $equipLabels[$eqKey] }}</div>
                                                    </div>
                                                    @endif
                                                @endforeach
                                                @if($hasMore)
                                                <div class="col-auto">
                                                    <div class="border-light rounded-100 py-5 px-15 text-13 lh-14 text-light-1">+{{ count($studioEq) - 4 }}</div>
                                                </div>
                                                @endif
                                            @else
                                                <div class="col-auto">
                                                    <div class="text-13 text-light-1">Aucun équipement renseigné</div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-auto text-right md:text-left">
                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                        <div class="col-auto">
                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                        </div>
                                        <div class="col-auto">
                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                        </div>
                                    </div>

                                    <div class="text-14 text-light-1 mt-40 md:mt-20">A Partir de </div>
                                    <div class="text-22 lh-12 fw-600 mt-5">{{ $studio->hourly_rate }}€</div>
                                    <div class="text-14 text-light-1 mt-5">par heures</div>

                                    <a href="{{ route('studio.show', $studio) }}" class="button -md -dark-1 bg-blue-1 text-white mt-24">
                                        Voir Détails <div class="icon-arrow-top-right ml-15"></div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="border-top-light mt-30 pt-30">
                    <div class="row x-gap-10 y-gap-20 justify-between md:justify-center">
                        <div class="col-auto md:order-1">
                            <button class="button -blue-1 size-40 rounded-full border-light">
                                <i class="icon-chevron-left text-12"></i>
                            </button>
                        </div>

                        <div class="col-md-auto md:order-3">
                            <div class="row x-gap-20 y-gap-20 items-center md:d-none">
                                <div class="col-auto">
                                    <div class="size-40 flex-center rounded-full">1</div>
                                </div>
                                <div class="col-auto">
                                    <div class="size-40 flex-center rounded-full bg-dark-1 text-white">2</div>
                                </div>
                                <div class="col-auto">
                                    <div class="size-40 flex-center rounded-full">3</div>
                                </div>
                                <div class="col-auto">
                                    <div class="size-40 flex-center rounded-full bg-light-2">4</div>
                                </div>
                                <div class="col-auto">
                                    <div class="size-40 flex-center rounded-full">5</div>
                                </div>
                                <div class="col-auto">
                                    <div class="size-40 flex-center rounded-full">...</div>
                                </div>
                                <div class="col-auto">
                                    <div class="size-40 flex-center rounded-full">20</div>
                                </div>
                            </div>

                            <div class="row x-gap-10 y-gap-20 justify-center items-center d-none md:d-flex">
                                <div class="col-auto">
                                    <div class="size-40 flex-center rounded-full">1</div>
                                </div>
                                <div class="col-auto">
                                    <div class="size-40 flex-center rounded-full bg-dark-1 text-white">2</div>
                                </div>
                                <div class="col-auto">
                                    <div class="size-40 flex-center rounded-full">3</div>
                                </div>
                            </div>

                            <div class="text-center mt-30 md:mt-10">
                                <div class="text-14 text-light-1">1 – 20 de {{ count($studios) }} studios trouvés</div>
                            </div>
                        </div>

                        <div class="col-auto md:order-2">
                            <button class="button -blue-1 size-40 rounded-full border-light">
                                <i class="icon-chevron-right text-12"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        const searchButton = document.getElementById('search-button');

        // Fonction de recherche
        function performSearch() {
            const searchTerm = searchInput.value.toLowerCase();
            const studioCards = document.querySelectorAll('.border-top-light.pt-20.mb-20');

            studioCards.forEach(card => {
                const studioName = card.querySelector('h3').textContent.toLowerCase();
                const studioCity = card.querySelector('p.text-14.lh-14.mb-5').textContent.toLowerCase();

                if (studioName.includes(searchTerm) || studioCity.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });

            // Mise à jour du compteur de résultats
            const visibleStudios = document.querySelectorAll('.border-top-light.pt-20.mb-20[style=""]').length;
            document.querySelector('.text-18 .fw-500').textContent = visibleStudios + ' Studios';
        }

        // Écouteurs d'événements
        searchButton.addEventListener('click', performSearch);
        searchInput.addEventListener('keyup', function(event) {
            if (event.key === 'Enter') {
                performSearch();
            }
        });

        // Fonction pour mettre à jour l'affichage du périmètre
        window.updateDistanceValue = function(value) {
            document.querySelector('.js-lower').textContent = '0km';
            document.querySelector('.js-upper').textContent = value + 'km';
        };
    });

    function toggleHoursMenu(event) {
        event.stopPropagation();
        const menu = document.getElementById('hoursMenu');
        menu.classList.toggle('hidden');
    }

    function changeHours(amount) {
        const hoursInput = document.getElementById('min_hours');
        const hoursValue = document.getElementById('hoursValue');
        let currentValue = parseInt(hoursValue.textContent);
        if (!isNaN(currentValue)) {
            currentValue += amount;
            if (currentValue < 1) {
                currentValue = 1;
            }
            hoursValue.textContent = currentValue;
            hoursInput.value = currentValue;
        }
    }

    function updateDistanceValue(value) {
        document.querySelector('.js-upper').textContent = value + "km";
        document.getElementById('distance').value = value;
    }

    document.addEventListener('click', function(event) {
        const hoursInput = document.getElementById('min_hours');
        const hoursMenu = document.getElementById('hoursMenu');

        if (hoursInput && hoursMenu && !hoursInput.contains(event.target) && !hoursMenu.contains(event.target)) {
            hoursMenu.classList.add('hidden');
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const geolocateBtn = document.getElementById('geolocate-btn');

        if (geolocateBtn) {
            geolocateBtn.addEventListener('click', function() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(
                        // Success
                        function(position) {
                            const latitude = position.coords.latitude;
                            const longitude = position.coords.longitude;

                            document.getElementById('latitude').value = latitude;
                            document.getElementById('longitude').value = longitude;

                            // Fetch the address using Nominatim API
                            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&addressdetails=1`)
                                .then(response => response.json())
                                .then(data => {
                                    const city = data.address.city || data.address.town || data.address.village || "Unknown location";
                                    document.getElementById('city').value = city;
                                    document.getElementById('city').disabled = true;

                                    // Visual feedback
                                    geolocateBtn.innerHTML = '<i class="icon-check text-16"></i>';
                                    geolocateBtn.classList.add('bg-white');
                                })
                                .catch(error => {
                                    alert("Impossible de récupérer l'adresse. Veuillez entrer une ville manuellement.");
                                });
                        },
                        // Error
                        function(error) {
                            alert("Impossible d'obtenir votre position. Veuillez entrer une ville manuellement.");
                        }
                    );
                } else {
                    alert("La géolocalisation n'est pas prise en charge par votre navigateur.");
                }
            });
        }
    });

    document.getElementById("price-filter").addEventListener("change", function() {
        const selectedOption = this.options[this.selectedIndex];
        const urlParams = new URLSearchParams(window.location.search);

        // Définir sort_by
        urlParams.set('sort_by', this.value);

        // Définir sort_direction si c'est un tri par prix
        if (this.value === "price") {
            urlParams.set('sort_direction', selectedOption.getAttribute('data-dir'));
        } else {
            urlParams.delete('sort_direction');
        }

        // Conserver les autres paramètres importants
        // Ne pas toucher à latitude, longitude, distance, city, min_hours

        window.location.search = urlParams.toString();
    });

    document.getElementById('price-filter').addEventListener('change', function () {
        var selectedOption = this.options[this.selectedIndex];
        var sortDirectionInput = document.getElementById('sort_direction');

        if (selectedOption.value === 'price') {
            sortDirectionInput.value = selectedOption.getAttribute('data-dir');
        } else {
            sortDirectionInput.value = 'asc'; // Distance par défaut
        }

        this.form.submit();
    });

    document.addEventListener("DOMContentLoaded", function () {
        let minHoursInput = document.getElementById("min_hours");
        let hoursValue = document.getElementById("hoursValue");

        // Synchronisation initiale
        hoursValue.textContent = minHoursInput.value;

        window.changeHours = function (amount) {
            let newValue = parseInt(minHoursInput.value) + amount;
            if (newValue < 1) newValue = 1; // Empêcher une valeur négative
            minHoursInput.value = newValue;
            hoursValue.textContent = newValue;
        };
    });

</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.wishlist-toggle').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const studioId = this.getAttribute('data-studio-id');
                const heartIcon = this.querySelector('i.icon-heart');

                if (!heartIcon) {
                    console.error('Icône non trouvée dans le bouton wishlist.');
                    return;
                }

                fetch('{{ route('wishlist.toggle') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ studio_id: studioId })
                })
                    .then(response => response.json())
                    .then(data => {
                        console.log('Réponse serveur :', data);

                        if (data.success) {
                            // Modification pour assurer que le changement visuel se produit
                            if (data.status === 'added') {
                                heartIcon.classList.add('text-blue-1');
                                console.log('Classe ajoutée:', heartIcon.className);
                            } else {
                                heartIcon.classList.remove('text-blue-1');
                                console.log('Classe retirée:', heartIcon.className);
                            }

                            // Animation du bouton
                            button.classList.add('clicked');
                            setTimeout(() => {
                                button.classList.remove('clicked');
                            }, 300);
                        } else {
                            if (data.message) {
                                alert(data.message);
                                window.location.href = '{{ route('login') }}';
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Erreur AJAX:', error);
                    });
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        // Initialiser tous les sliders d'images de studio
        const studioImageSliders = document.querySelectorAll('.js-cardImage-slider');

        studioImageSliders.forEach(function(slider, index) {
            new Swiper(slider, {
                loop: true,
                pagination: {
                    el: slider.querySelector('.js-pagination'),
                    clickable: true,
                },
                navigation: {
                    nextEl: slider.querySelector('.js-next'),
                    prevEl: slider.querySelector('.js-prev'),
                },
            });
        });
    });
</script>


