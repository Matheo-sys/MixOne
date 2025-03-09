<section data-anim-wrap class="masthead -type-1 z-5">
    <div data-anim-child="fade" class="masthead__bg">
        <img src="" data-src="{{ asset('media/img/masthead/1/11.jpg') }}" alt="image" class="js-lazy">
    </div>

    <div class="container">
        <div class="row justify-center">
            <div class="col-auto">
                <div class="text-center">
                    <h1 data-anim-child="slide-up delay-4" class="text-60 lg:text-40 md:text-30 text-white">Découvrez votre prochain studio</h1>
                    <p data-anim-child="slide-up delay-5" class="text-white mt-6 md:mt-10">Trouvez d'incroyables studios au meilleurs prix</p>
                </div>

                <div data-anim-child="slide-up delay-6" class="tabs -underline mt-60 js-tabs">
                    <div class="tabs__content mt-30 md:mt-20 js-tabs-content">
                        <div class="tabs__pane -tab-item-1 is-tab-el-active">
                            <div class="mainSearch bg-white px-10 py-10 lg:px-20 lg:pt-5 lg:pb-20 rounded-100">
                                <form id="searchForm" action="{{route("studio_list")}}" method="GET">
                                    <input type="hidden" id="latitude" name="latitude" value="48.7748198">
                                    <input type="hidden" id="longitude" name="longitude" value="2.3262945">

                                    <div class="button-grid items-center">
                                        <div class="searchMenu-loc px-30 lg:py-20 lg:px-0">
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
                                            <input type="text" id="min_hours" name="min_hours" placeholder="Hours" value="2" class="text-15 text-light-1 ls-2 lh-16" onclick="toggleHoursMenu(event)" readonly="">
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
                                            <button type="submit" class="mainSearch__submit button -dark-1 h-60 px-35 col-12 rounded-100 bg-blue-1 text-white">
                                                <i class="icon-search text-20 mr-10"></i>
                                                Search
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
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

    /* Slider pour la distance */
    .slider {
        -webkit-appearance: none;
        height: 6px;
        border-radius: 3px;
        background: #e0e0e0;
        outline: none;
        width: 100%;
    }

    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #3554D1;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .slider::-moz-range-thumb {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #3554D1;
        cursor: pointer;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
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

<script>
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
</script>
