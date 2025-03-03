<section class="pt-40 pb-40 bg-light-2 mt-90">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h1 class="text-30 fw-600">NOS STUDIOS</h1>
                </div>

                <div class="mainSearch bg-white px-10 py-10 lg:px-20 lg:pt-5 lg:pb-20 rounded-4 mt-30">
                    <div class="button-grid items-center">

                        <div class="searchMenu-loc pr-30 pl-20 lg:py-20 lg:px-0 js-form-dd js-liverSearch">

                            <div class="searchMenu-loc px-30 lg:py-20 lg:px-0">
                                <label for="city" class="text-15 fw-500 ls-2 lh-16">City</label>
                                <div class="input-wrapper">
                                    <input type="text" id="city" name="city" placeholder="City" value="" class="js-search js-dd-focus">
                                    <button type="button" id="geolocate-btn" class="button -blue-1 h-40 px-20 ml-10 rounded-4">
                                        <i class="icon-location text-16"></i>
                                    </button>
                                </div>
                            </div>


                            <div class="searchMenu-loc__field shadow-2 js-popup-window" data-x-dd="searchMenu-loc" data-x-dd-toggle="-is-active">
                                <div class="bg-white px-30 py-30 sm:px-0 sm:py-15 rounded-4">
                                    <div class="y-gap-5 js-results">

                                        <div>
                                            <button class="-link d-block col-12 text-left rounded-4 px-20 py-15 js-search-option">
                                                <div class="d-flex">
                                                    <div class="icon-location-2 text-light-1 text-20 pt-4"></div>
                                                    <div class="ml-10">
                                                        <div class="text-15 lh-12 fw-500 js-search-option-target">London</div>
                                                        <div class="text-14 lh-12 text-light-1 mt-5">Greater London, United Kingdom</div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>

                                        <div>
                                            <button class="-link d-block col-12 text-left rounded-4 px-20 py-15 js-search-option">
                                                <div class="d-flex">
                                                    <div class="icon-location-2 text-light-1 text-20 pt-4"></div>
                                                    <div class="ml-10">
                                                        <div class="text-15 lh-12 fw-500 js-search-option-target">New York</div>
                                                        <div class="text-14 lh-12 text-light-1 mt-5">New York State, United States</div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>

                                        <div>
                                            <button class="-link d-block col-12 text-left rounded-4 px-20 py-15 js-search-option">
                                                <div class="d-flex">
                                                    <div class="icon-location-2 text-light-1 text-20 pt-4"></div>
                                                    <div class="ml-10">
                                                        <div class="text-15 lh-12 fw-500 js-search-option-target">Paris</div>
                                                        <div class="text-14 lh-12 text-light-1 mt-5">France</div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>

                                        <div>
                                            <button class="-link d-block col-12 text-left rounded-4 px-20 py-15 js-search-option">
                                                <div class="d-flex">
                                                    <div class="icon-location-2 text-light-1 text-20 pt-4"></div>
                                                    <div class="ml-10">
                                                        <div class="text-15 lh-12 fw-500 js-search-option-target">Madrid</div>
                                                        <div class="text-14 lh-12 text-light-1 mt-5">Spain</div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>

                                        <div>
                                            <button class="-link d-block col-12 text-left rounded-4 px-20 py-15 js-search-option">
                                                <div class="d-flex">
                                                    <div class="icon-location-2 text-light-1 text-20 pt-4"></div>
                                                    <div class="ml-10">
                                                        <div class="text-15 lh-12 fw-500 js-search-option-target">Santorini</div>
                                                        <div class="text-14 lh-12 text-light-1 mt-5">Greece</div>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="searchMenu-date px-30 lg:py-20 lg:px-0 js-form-dd js-calendar js-calendar-el">

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


                            <div class="searchMenu-date__field shadow-2" data-x-dd="searchMenu-date" data-x-dd-toggle="-is-active">
                                <div class="bg-white px-30 py-30 rounded-4">
                                    <div class="elCalendar js-calendar-el-calendar"></div>
                                </div>
                            </div>
                        </div>


                        <div class="searchMenu-guests px-30 lg:py-20 lg:px-0 js-form-dd js-form-counters">

                            <div data-x-dd-click="searchMenu-guests">
                                <h4 class="text-15 fw-500 ls-2 lh-16"></h4>

                                <div class="text-15 text-light-1 ls-2 lh-16">
                                    <span class="js-count-adult"></span>


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
