{{-- ==========================================
    HERO SEARCH SECTION
   ========================================== --}}
<section class="studioList-hero">
    <div class="container">
        <div class="studioList-hero__inner">
            <h1 class="studioList-hero__title">Trouvez votre studio</h1>
            <p class="studioList-hero__subtitle">Explorez notre sélection de studios professionnels</p>

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

{{-- ==========================================
    MAIN CONTENT: SIDEBAR + STUDIOS
   ========================================== --}}
<section class="studioList-main">
    <div class="container">
        <div class="row y-gap-30">
            {{-- ======= SIDEBAR ======= --}}
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
                <aside class="studioList-sidebar">
                    {{-- Map Preview --}}
                    <div class="studioList-sidebar__mapPreview">
                        <div class="flex-center ratio ratio-15:9 js-lazy rounded-14 overflow-hidden" data-bg={{asset("media/img/general/map.png")}}>
                            <button id="openMapBtn" type="button" class="studioList-sidebar__mapBtn">
                                <i class="icon-destination text-18 mr-8"></i>
                                Voir sur la carte
                            </button>
                        </div>
                    </div>

                    {{-- Filters --}}
                    <div class="studioList-sidebar__filters">
                        <form action="{{ route('studio_list') }}" method="GET" id="sidebarFilterForm">
                            <input type="hidden" name="latitude" value="{{ request('latitude', 0) }}">
                            <input type="hidden" name="longitude" value="{{ request('longitude', 0) }}">
                            <input type="hidden" name="city" value="{{ request('city', '') }}">
                            <input type="hidden" name="min_hours" value="{{ request('min_hours', '') }}">
                            <input type="hidden" name="sort_by" value="{{ request('sort_by', 'distance') }}">
                            <input type="hidden" name="sort_direction" value="{{ request('sort_direction', 'asc') }}">

                            {{-- Distance Slider --}}
                            <div class="studioList-sidebar__section">
                                <h5 class="studioList-sidebar__sectionTitle">
                                    <i class="icon-location-2 text-14"></i>
                                    Périmètre
                                </h5>
                                <div class="js-price-rangeSlider">
                                    <div class="d-flex justify-between mb-15">
                                        <div class="studioList-sidebar__rangeLabel">
                                            <span class="js-lower">0km</span>
                                            <span>—</span>
                                            <span class="js-upper">{{ request()->input('distance', 35) }}km</span>
                                        </div>
                                    </div>
                                    <div class="studioList-sidebar__slider">
                                        <input type="range" id="distance" name="distance" min="0" max="100" value="{{ request()->input('distance', 35) }}" class="studioList-rangeInput" oninput="updateDistanceValue(this.value); updateSliderTrack(this)">
                                    </div>
                                </div>
                            </div>

                            {{-- Equipment Filters --}}
                            <div class="studioList-sidebar__section">
                                <h5 class="studioList-sidebar__sectionTitle">
                                    <i class="icon-star text-14"></i>
                                    Équipements
                                </h5>
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
                                <div class="studioList-sidebar__equipList">
                                    @foreach($equipListFlat as $key => $label)
                                        <label class="studioList-sidebar__equipItem" for="filter_{{ $key }}">
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
                                            <span>{{ $label }}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <button type="submit" class="studioList-sidebar__applyBtn">
                                <i class="icon-search text-16 mr-8"></i>
                                Appliquer les filtres
                            </button>
                        </form>
                    </div>
                </aside>
            </div>

            {{-- ======= STUDIO LIST ======= --}}
            <div class="col-xl-9 col-lg-8">
                {{-- Toolbar --}}
                <div class="studioList-toolbar">
                    <div class="studioList-toolbar__count">
                        <span class="studioList-toolbar__number">{{ count($studios) }}</span> studios correspondent à votre recherche :
                    </div>

                    <div class="studioList-toolbar__actions">
                        <div class="col-auto">
                            <form action="{{ route('studio_list') }}" method="GET" id="sortForm">
                                <input type="hidden" name="latitude" value="{{ request('latitude', 0) }}">
                                <input type="hidden" name="longitude" value="{{ request('longitude', 0) }}">
                                <input type="hidden" name="city" value="{{ request('city', '') }}">
                                <input type="hidden" name="distance" value="{{ request('distance', 50) }}">
                                <input type="hidden" name="min_hours" value="{{ request('min_hours', '') }}">
                                @foreach(request('equipment', []) as $eq)
                                    <input type="hidden" name="equipment[]" value="{{ $eq }}">
                                @endforeach
                                <input type="hidden" name="sort_direction" id="sort_direction_sort" value="{{ request('sort_direction', 'asc') }}">

                                <select name="sort_by" id="price-filter" class="studioList-toolbar__sort"
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

                        <div class="col-auto mobile-filter-btn">
                            <button data-x-click="filterPopup" class="studioList-toolbar__filterBtn -black-white">
                                <i class="icon-up-down text-14 mr-8"></i>
                                Filtrer / Carte
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Mobile Filter Popup --}}
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
                                        <input type="range" name="distance" min="0" max="100" value="{{ request()->input('distance', 35) }}" class="studioList-rangeInput" oninput="document.querySelector('.js-upper-mobile').textContent = this.value + 'km'">
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

                {{-- ======= STUDIO CARDS ======= --}}
                <div class="studioList-grid">
                    @foreach($studios as $studio)
                        <div class="studioListCard">
                            <div class="studioListCard__imageWrap">
                                <div class="cardImage ratio studioListCard__ratio">
                                    <div class="cardImage__content">
                                        <div class="cardImage-slider rounded-4 overflow-hidden js-cardImage-slider">
                                            <div class="swiper-wrapper">
                                                @php
                                                    $hasImages = false;
                                                    for ($i = 1; $i <= 4; $i++) {
                                                        $imageField = "image{$i}";
                                                        if (!empty($studio->$imageField)) {
                                                            $hasImages = true;
                                                            echo '<div class="swiper-slide">';
                                                            echo '<img class="col-12 studioListCard__img" src="' . asset('storage/' . $studio->$imageField) . '" alt="Image studio ' . $studio->name . '">';
                                                            echo '</div>';
                                                        }
                                                    }
                                                    if (!$hasImages) {
                                                        echo '<div class="swiper-slide">';
                                                        echo '<img class="col-12 studioListCard__img" src="' . asset('media/img/backgrounds/11.jpg') . '" alt="Image par défaut">';
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
                                    <div class="studioListCard__badges">
                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2 wishlist-toggle" data-studio-id="{{ $studio->id }}">
                                            @if(Auth::check() && Auth::user()->favoriteStudios->contains($studio->id))
                                                <i class="icon-heart text-12 text-blue-1"></i>
                                            @else
                                                <i class="icon-heart text-12"></i>
                                            @endif
                                        </button>
                                    </div>

                                    @if($studio->user)
                                    <div class="studioListCard__contact">
                                        <button type="button" class="button -blue-1 bg-white size-30 rounded-full shadow-2"
                                            onclick="event.preventDefault(); @if(!Auth::check()) window.location.href='{{ route('login') }}'; @else window.startNewMessagingChat({{ $studio->user_id }}, '{{ addslashes($studio->user->first_name) }} {{ addslashes($studio->user->last_name) }}', '{{ $studio->user->avatar }}'); @endif">
                                            <i class="icon-email-2 text-12"></i>
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <div class="studioListCard__body">
                                <div class="studioListCard__info">
                                    <div class="studioListCard__top">
                                        <div>
                                            <h3 class="studioListCard__name">{{ $studio->name }}</h3>
                                            <div class="studioListCard__location">
                                                <i class="icon-location-2 text-12"></i>
                                                <span>{{ $studio->city }}</span>
                                            </div>
                                        </div>
                                        <div class="studioListCard__ratingBadge">
                                            <span>4.8</span>
                                            <i class="icon-star text-9"></i>
                                        </div>
                                    </div>

                                    @if(isset($studio->distance))
                                        <div class="studioListCard__distance">
                                            <i class="icon-route text-12"></i>
                                            {{ number_format($studio->distance, 1) }} km de vous
                                        </div>
                                    @endif

                                    {{-- Equipment Tags --}}
                                    <div class="studioListCard__tags">
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
                                                <span class="studioListCard__tag">{{ $equipLabels[$eqKey] }}</span>
                                                @endif
                                            @endforeach
                                            @if($hasMore)
                                            <span class="studioListCard__tag --more">+{{ count($studioEq) - 4 }}</span>
                                            @endif
                                        @else
                                            <span class="studioListCard__tagEmpty">Aucun équipement renseigné</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="studioListCard__priceSection">
                                    <div class="studioListCard__reviews">
                                        <span class="studioListCard__reviewLabel">Excellent</span>
                                        <span class="studioListCard__reviewCount">3,014 avis</span>
                                    </div>
                                    <div class="studioListCard__price">
                                        <span class="studioListCard__priceLabel">A partir de</span>
                                        <span class="studioListCard__priceValue">{{ $studio->hourly_rate }}€</span>
                                        <span class="studioListCard__priceUnit">/ heure</span>
                                    </div>
                                    <a href="{{ route('studio.show', $studio) }}" class="studioListCard__cta">
                                        Voir Détails
                                        <i class="icon-arrow-top-right text-12"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- ======= PAGINATION ======= --}}
                @if($studios->total() > 0)
                <div class="studioList-pagination">
                    <div class="studioList-pagination__inner">
                        {{-- Previous --}}
                        <div class="studioList-pagination__nav">
                            @if($studios->onFirstPage())
                                <button class="studioList-pagination__btn --disabled" disabled>
                                    <i class="icon-chevron-left text-12"></i>
                                </button>
                            @else
                                <a href="{{ $studios->appends(request()->input())->previousPageUrl() }}" class="studioList-pagination__btn">
                                    <i class="icon-chevron-left text-12"></i>
                                </a>
                            @endif
                        </div>

                        {{-- Pages (Desktop) --}}
                        <div class="studioList-pagination__pages d-none md:d-none lg:d-flex">
                            @php
                                $currentPage = $studios->currentPage();
                                $lastPage = $studios->lastPage();
                                $start = max(1, $currentPage - 1);
                                $end = min($lastPage, $currentPage + 1);
                                if ($currentPage == 1) $end = min($lastPage, 3);
                                if ($currentPage == $lastPage) $start = max(1, $lastPage - 2);
                            @endphp

                            @if($start > 1)
                                <a href="{{ $studios->appends(request()->input())->url(1) }}" class="studioList-pagination__page">1</a>
                                @if($start > 2)
                                    <span class="studioList-pagination__dots">...</span>
                                @endif
                            @endif

                            @for($i = $start; $i <= $end; $i++)
                                <a href="{{ $studios->appends(request()->input())->url($i) }}"
                                   class="studioList-pagination__page {{ $i == $currentPage ? '--active' : '' }}">
                                    {{ $i }}
                                </a>
                            @endfor

                            @if($end < $lastPage)
                                @if($end < $lastPage - 1)
                                    <span class="studioList-pagination__dots">...</span>
                                @endif
                                <a href="{{ $studios->appends(request()->input())->url($lastPage) }}" class="studioList-pagination__page">{{ $lastPage }}</a>
                            @endif
                        </div>

                        {{-- Pages (Mobile) --}}
                        <div class="studioList-pagination__mobile d-flex lg:d-none">
                            <span class="studioList-pagination__page --active">{{ $currentPage }}</span>
                            <span class="studioList-pagination__mobileText">sur {{ $lastPage }}</span>
                        </div>

                        {{-- Next --}}
                        <div class="studioList-pagination__nav">
                            @if($studios->hasMorePages())
                                <a href="{{ $studios->appends(request()->input())->nextPageUrl() }}" class="studioList-pagination__btn">
                                    <i class="icon-chevron-right text-12"></i>
                                </a>
                            @else
                                <button class="studioList-pagination__btn --disabled" disabled>
                                    <i class="icon-chevron-right text-12"></i>
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="studioList-pagination__info">
                        {{ $studios->firstItem() }} – {{ $studios->lastItem() }} de {{ $studios->total() }} studios trouvés
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ==========================================
    SCRIPTS
   ========================================== --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        const searchButton = document.getElementById('search-button');

        function performSearch() {
            const searchTerm = searchInput.value.toLowerCase();
            const studioCards = document.querySelectorAll('.studioListCard');

            studioCards.forEach(card => {
                const studioName = card.querySelector('.studioListCard__name').textContent.toLowerCase();
                const studioCity = card.querySelector('.studioListCard__location span').textContent.toLowerCase();

                if (studioName.includes(searchTerm) || studioCity.includes(searchTerm)) {
                    card.style.display = '';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        if (searchButton) searchButton.addEventListener('click', performSearch);
        if (searchInput) searchInput.addEventListener('keyup', function(event) {
            if (event.key === 'Enter') performSearch();
        });

        window.updateDistanceValue = function(value) {
            const lower = document.querySelector('.js-lower');
            const upper = document.querySelector('.js-upper');
            if (lower) lower.textContent = '0km';
            if (upper) upper.textContent = value + 'km';
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
            if (currentValue < 1) currentValue = 1;
            hoursValue.textContent = currentValue;
            hoursInput.value = currentValue;
        }
    }

    function updateDistanceValue(value) {
        const upper = document.querySelector('.js-upper');
        if (upper) upper.textContent = value + "km";
        const distInput = document.getElementById('distance');
        if (distInput) distInput.value = value;
    }

    function updateSliderTrack(input) {
        const val = (input.value - input.min) / (input.max - input.min) * 100;
        input.style.background = `linear-gradient(to right, #3554D1 ${val}%, #fff ${val}%)`;
    }

    // Initialize track on load
    document.addEventListener('DOMContentLoaded', function() {
        const distRange = document.getElementById('distance');
        if (distRange) updateSliderTrack(distRange);
    });

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
                        function(position) {
                            const latitude = position.coords.latitude;
                            const longitude = position.coords.longitude;
                            document.getElementById('latitude').value = latitude;
                            document.getElementById('longitude').value = longitude;

                            fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${latitude}&lon=${longitude}&addressdetails=1`)
                                .then(response => response.json())
                                .then(data => {
                                    const city = data.address.city || data.address.town || data.address.village || "Unknown location";
                                    document.getElementById('city').value = city;
                                    document.getElementById('city').disabled = true;
                                    geolocateBtn.innerHTML = '<i class="icon-check text-16"></i>';
                                    geolocateBtn.classList.add('bg-white');
                                })
                                .catch(error => {
                                    alert("Impossible de récupérer l'adresse. Veuillez entrer une ville manuellement.");
                                });
                        },
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

    document.addEventListener("DOMContentLoaded", function () {
        let minHoursInput = document.getElementById("min_hours");
        let hoursValue = document.getElementById("hoursValue");
        if (minHoursInput && hoursValue) {
            hoursValue.textContent = minHoursInput.value;
            window.changeHours = function (amount) {
                let newValue = parseInt(minHoursInput.value) + amount;
                if (newValue < 1) newValue = 1;
                minHoursInput.value = newValue;
                hoursValue.textContent = newValue;
            };
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.wishlist-toggle').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();

                const studioId = this.getAttribute('data-studio-id');
                const heartIcon = this.querySelector('i.icon-heart');

                if (!heartIcon) return;

                @if(!Auth::check())
                    window.location.href = '{{ route('login') }}';
                    return;
                @endif

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
                        if (data.success) {
                            if (data.status === 'added') {
                                heartIcon.classList.add('text-blue-1');
                            } else {
                                heartIcon.classList.remove('text-blue-1');
                            }
                            button.classList.add('clicked');
                            setTimeout(() => {
                                button.classList.remove('clicked');
                            }, 300);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur AJAX:', error);
                    });
            });
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
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
