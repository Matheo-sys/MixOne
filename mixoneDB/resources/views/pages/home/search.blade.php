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
                            <div class="mainSearch bg-white">
                                <form id="searchForm" action="{{route("studio_list")}}" method="GET">
                                    <input type="hidden" id="latitude" name="latitude" value="48.8588897">
                                    <input type="hidden" id="longitude" name="longitude" value="2.320041">

                                    <div class="mainSearch__grid">
                                        <div class="mainSearch__item">
                                            <label for="city" class="text-15 fw-500 ls-2 lh-16">City</label>
                                            <div class="mainSearch__input">
                                                <input type="text" id="city" name="city" placeholder="(Par défaut : Paris)" value="" class="js-search js-dd-focus">
                                                <button type="button" id="geolocate-btn">
                                                    <i class="icon-location text-16"></i>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="mainSearch__item position-relative">
                                            <label for="min_hours" class="text-15 fw-500 ls-2 lh-16">Hours</label>
                                            <div class="mainSearch__input">
                                                <input type="text" id="min_hours" name="min_hours" placeholder="Hours" value="2" class="text-15 text-light-1" onclick="toggleHoursMenu(event)" readonly="">
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
                </div>
            </div>
        </div>
    </div>
</section>



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

                            // Fetch the address using our backend proxy
                            fetch(`/api/geocode/reverse?lat=${latitude}&lon=${longitude}`)
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
