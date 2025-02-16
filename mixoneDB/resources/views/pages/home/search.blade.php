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
                            <div class="mainSearch -w-900 bg-white px-10 py-10 lg:px-20 lg:pt-5 lg:pb-20 rounded-100">
                                <form action="{{ route('studio.search') }}" method="GET">
                                    <div class="button-grid items-center">
                                        <div class="searchMenu-loc px-30 lg:py-20 lg:px-0">
                                            <label for="city" class="text-15 fw-500 ls-2 lh-16">City</label>
                                            <input type="text" id="city" name="city" placeholder="City" class="js-search js-dd-focus" />
                                        </div>

                                        <div class="searchMenu-date px-30 lg:py-20 lg:px-0">
                                            <label for="date" class="text-15 fw-500 ls-2 lh-16">Day</label>
                                            <input type="date" id="date" name="date" class="text-15 text-light-1 ls-2 lh-16" />
                                        </div>

                                        <div class="searchMenu-guests px-30 lg:py-20 lg:px-0 position-relative">
                                            <label for="min_hours" class="text-15 fw-500 ls-2 lh-16">Hours</label>
                                            <input type="text" id="min_hours" name="min_hours" placeholder="Hours" class="text-15 text-light-1 ls-2 lh-16" onclick="toggleHoursMenu(event)" readonly />
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
    .hidden {
        display: none;
    }
    .hours-menu {
        display: flex;
        gap: 10px;
        align-items: center;
        position: absolute;
        background: white;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        z-index: 1000;
        top: 100%;
        left: 0;
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

    document.addEventListener('click', function(event) {
        const hoursInput = document.getElementById('min_hours');
        const hoursMenu = document.getElementById('hoursMenu');

        // Vérifie si l'élément cliqué n'est ni le champ "Hours" ni le menu
        if (!hoursInput.contains(event.target) && !hoursMenu.contains(event.target)) {
            hoursMenu.classList.add('hidden');
        }
    });

    // Empêche la fermeture immédiate du menu quand on clique dedans
    document.getElementById('hoursMenu').addEventListener('click', function(event) {
        event.stopPropagation();
    });
</script>

