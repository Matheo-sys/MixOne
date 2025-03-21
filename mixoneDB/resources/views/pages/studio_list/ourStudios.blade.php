<section class="pt-40 pb-40 bg-light-2 mt-90">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h1 class="text-30 fw-600">NOS STUDIOS</h1>
                </div>

                <div class="mainSearch bg-white px-10 py-10 lg:px-20 lg:pt-5 lg:pb-20 rounded-4 mt-30">
                    <form id="searchForm" action="{{route('studio_list')}}" method="GET">
                        <input type="hidden" id="latitude" name="latitude" value="48.7748198">
                        <input type="hidden" id="longitude" name="longitude" value="2.3262945">

                        <div class="button-grid items-center">
                            <div class="searchMenu-loc pr-30 pl-20 lg:py-20 lg:px-0 js-form-dd js-liverSearch">
                                <label for="city" class="text-15 fw-500 ls-2 lh-16">City</label>
                                <div class="input-wrapper">
                                    <input type="text" id="city" name="city" placeholder="City" value="" class="js-search js-dd-focus">
                                    <button type="button" id="geolocate-btn" class="button -blue-1 h-40 px-20 ml-10 rounded-4">
                                        <i class="icon-location text-16"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="searchMenu-guests px-30 lg:py-20 lg:px-0 position-relative">
                                <label for="min_hours" class="text-15 fw-500 ls-2 lh-16">Hours</label>
                                <input type="text" id="min_hours" name="min_hours" placeholder="Hours" value="{{ request('min_hours', 2) }}" class="text-15 text-light-1 ls-2 lh-16" onclick="toggleHoursMenu(event)" readonly="">
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

                            <div class="button-item">
                                <button type="submit" class="mainSearch__submit button -dark-1 h-60 px-35 col-12 bg-blue-1 text-white">
                                    <i class="icon-search text-20 mr-10"></i>
                                    Search
                                </button>
                            </div>
                        </div>

                </div>


            </div>
        </div>
</section>

<section class="layout-pt-md layout-pb-lg">
    <div class="container">
        <div class="row y-gap-30">
            <div class="col-xl-3 col-lg-4 lg:d-none">
                <aside class="sidebar y-gap-40">
                    <div class="sidebar__item -no-border">
                        <div class="flex-center ratio ratio-15:9 js-lazy" data-bg={{asset("media/img/general/map.png")}}>
                            <button data-x-click="mapFilter" class="button py-15 px-24 -blue-1 bg-white text-dark-1 absolute">
                                <i class="icon-destination text-22 mr-10"></i>
                                Regarder sur la carte
                            </button>
                        </div>
                    </div>

                    <div class="sidebar__item">
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
                                    <select name="sort_by" id="price-filter" class="button -blue-1 h-40 px-20 rounded-100 bg-blue-1-05 text-15 text-blue-1"
                                            onchange="this.form.submit()">
                                        <option value="distance" {{ request('sort_by') == 'distance' ? 'selected' : '' }}>Distance</option>
                                        <option value="price" data-dir="asc" {{ request('sort_by') == 'price' && request('sort_direction') == 'asc' ? 'selected' : '' }}>
                                            Prix Croissant
                                        </option>
                                        <option value="price" data-dir="desc" {{ request('sort_by') == 'price' && request('sort_direction') == 'desc' ? 'selected' : '' }}>
                                            Prix Décroissant
                                        </option>
                                    </select>

                                    <!-- Champ caché pour stocker la direction du tri -->
                                    <input type="hidden" name="sort_direction" id="sort_direction" value="{{ request('sort_direction', 'asc') }}">

                                </div>


                            </div>

                            <div class="col-auto d-none lg:d-block">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="filterPopup bg-white" data-x="filterPopup" data-x-toggle="-is-active">
                    <aside class="sidebar -mobile-filter">
                        <div data-x-click="filterPopup" class="-icon-close">
                            <i class="icon-close"></i>
                        </div>

                        <div class="sidebar__item -no-border">
                            <h5 class="text-18 fw-500 mb-10">Type of Place</h5>
                            <div class="sidebar-checkbox">
                                <!-- Contenu des filtres conservé du premier code -->
                                <div class="row y-gap-10 items-center justify-between">
                                    <div class="col-auto">
                                        <div class="d-flex items-center">
                                            <div class="form-checkbox ">
                                                <input type="checkbox" name="name">
                                                <div class="form-checkbox__mark">
                                                    <div class="form-checkbox__icon icon-check"></div>
                                                </div>
                                            </div>
                                            <div class="text-15 ml-10">Apartments</div>
                                        </div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="text-15 text-light-1">92</div>
                                    </div>
                                </div>
                                <!-- Autres options de filtre... -->
                            </div>
                        </div>
                        <!-- Autres sections de filtre... -->
                    </aside>
                </div>

                <div class="mt-30">
                    <!-- Boucle sur les studios comme dans le deuxième code -->
                    @foreach($studios as $studio)
                        <div class="border-top-light pt-20 mb-20">
                            <div class="row x-gap-20 y-gap-20">
                                <div class="col-md-auto">
                                    <div class="cardImage ratio ratio-1:1 w-250 md:w-1/1 rounded-4">
                                        <div class="cardImage__content">
                                            <div class="cardImage-slider rounded-4 overflow-hidden js-cardImage-slider">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <img class="col-12" src={{asset("media/img/backgrounds/11.jpg")}} alt="image">
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <img class="col-12" src={{asset("media/img/backgrounds/11.jpg")}} alt="image">
                                                    </div>
                                                    <div class="swiper-slide">
                                                        <img class="col-12" src={{asset("media/img/backgrounds/11.jpg")}} alt="image">
                                                    </div>
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
                                            <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                <i class="icon-heart text-12"></i>
                                            </button>
                                        </div>
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
                                            <div class="col-auto">
                                                <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Beatmaking</div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">REC</div>
                                            </div>
                                            <div class="col-auto">
                                                <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Mix/Mastering</div>
                                            </div>
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
<style>
    /* Styles généraux */
    .mainSearch {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        width: 100%;
        max-width: 1200px;
        margin: 0 auto;
    }

    .mainSearch:hover {
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    /* Grid layout amélioré */
    .button-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 15px;
        align-items: end;
    }

    /* Champs de formulaire */
    .searchMenu-loc, .searchMenu-guests, .sidebar__item {
        position: relative;
    }

    .input-wrapper {
        display: flex;
        align-items: center;
    }

    label {
        display: block;
        margin-bottom: 8px;
        color: #2c3e50;
    }

    input[type="text"] {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        font-size: 15px;
        transition: all 0.3s;
        background-color: #f9f9f9;
    }

    input[type="text"]:focus {
        border-color: #3554D1;
        box-shadow: 0 0 0 3px rgba(53, 132, 228, 0.1);
        outline: none;
        background-color: white;
    }

    /* Bouton de géolocalisation */
    #geolocate-btn {
        background-color: #ffffff;
        border: 1px solid #000000;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s;
    }

    #geolocate-btn:hover {
        background-color: #3554D1;
    }

    /* Menu des heures */
    .hours-menu {
        display: flex;
        align-items: center;
        position: absolute;
        background: white;
        padding: 15px;
        border: 1px solid #eaeaea;
        border-radius: 8px;
        z-index: 1000;
        top: calc(100% + 5px);
        left: 0;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    }

    .button.-outline-blue-1 {
        border: 1px solid #3554D1;
        background: transparent;
        color: #3554D1;
        cursor: pointer;
        transition: all 0.2s;
    }

    .button.-outline-blue-1:hover {
        background-color: #f0f7ff;
    }



    /* Affichage de la valeur du slider */
    .js-price-rangeSlider .d-flex {
        display: flex;
        justify-content: space-between;
    }

    /* Bouton de recherche */
    .mainSearch__submit {
        width: 100%;
        background: #3554D1;
        color: white;
        border: none;
        cursor: pointer;
        transition: background 0.3s;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .mainSearch__submit:hover {
        background: #3554D1;
    }

    /* Pour cacher des éléments */
    .hidden {
        display: none !important;
    }

    /* Responsive */
    @media (max-width: 992px) {
        .button-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 576px) {
        .button-grid {
            grid-template-columns: 1fr;
        }

        .px-30 {
            padding-left: 15px;
            padding-right: 15px;
        }
    }
</style>
<!-- Ajout du script pour la fonctionnalité de recherche -->
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


