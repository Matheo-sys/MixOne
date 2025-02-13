<div class="dashboard mt-90" data-x="dashboard" data-x-toggle="-is-sidebar-open">
    <div class="dashboard__sidebar bg-white scroll-bar-1">


        <div class="sidebar -dashboard">

            <div class="sidebar__item">
                <div class="sidebar__button ">
                    <a href="/dashboard" class="d-flex items-center text-15 lh-1 fw-500">
                        <img src={{asset("media/img/dashboard/sidebar/booking.svg")}} alt="image" class="mr-15">
                        Historique des réservations
                    </a>
                </div>
            </div>

            <div class="sidebar__item">
                <div class="sidebar__button -is-active">
                    <a href="/dashboard/wishlist" class="d-flex items-center text-15 lh-1 fw-500">
                        <img src={{asset("media/img/dashboard/sidebar/bookmark.svg")}} alt="image" class="mr-15">
                        Liste d'envie
                    </a>
                </div>
            </div>

            <div class="sidebar__item">
                <div class="sidebar__button ">
                    <a href="/dashboard/settings" class="d-flex items-center text-15 lh-1 fw-500">
                        <img src={{asset("media/img/dashboard/sidebar/gear.svg")}} alt="image" class="mr-15">
                        Paramètres
                    </a>
                </div>
            </div>

            <div class="sidebar__item">
                <div class="sidebar__button ">
                    <a href="/" class="d-flex items-center text-15 lh-1 fw-500">
                        <img src={{asset("media/img/dashboard/sidebar/log-out.svg")}} alt="image" class="mr-15">
                        Se déconnecter
                    </a>
                </div>
            </div>

        </div>


    </div>

    <div class="dashboard__main">
        <div class="dashboard__content bg-light-2">
            <div class="row y-gap-20 justify-between items-end pb-60 lg:pb-40 md:pb-32">
                <div class="col-auto">

                    <h1 class="text-30 lh-14 fw-600">Liste d'envie</h1>
                    <div class="text-15 text-light-1">Retrouvez vos studios préférés.</div>

                </div>

                <div class="col-auto">

                </div>
            </div>


            <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                <div class="tabs -underline-2 js-tabs">
                    <div class="tabs__controls row x-gap-40 y-gap-10 lg:x-gap-20 js-tabs-controls">

                        <div class="col-auto">
                            <button class="tabs__button text-18 lg:text-16 text-light-1 fw-500 pb-5 lg:pb-0 js-tabs-button is-tab-el-active" data-tab-target=".-tab-item-1">Studios</button>
                        </div>


                    </div>

                    <div class="tabs__content pt-30 js-tabs-content">

                        <div class="tabs__pane -tab-item-1 is-tab-el-active">
                            <div class="row y-gap-20">

                                <div class="col-12">
                                    <div class="">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src={{asset("media/img/masthead/1/11.jpg")}} alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Studio Paris 16</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Paris
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Voir sur la carte</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">500m du centre</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Rec</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Production</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Cabine</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptionel</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 avis</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">A partir de </div>
                                                        <span class="fw-500 text-blue-1">99€</span> / L'Heure
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src={{asset("media/img/backgrounds/11.jpg")}} alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Studio Bleu</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Paris
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Voir sur la carte</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">4 km du centre</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Accessibilité</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Production</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Rec</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptionel</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 avis</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">A partir de </div>
                                                        <span class="fw-500 text-blue-1">55€</span> / L'Heure
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="tabs__pane -tab-item-2 ">
                            <div class="row y-gap-20">

                                <div class="col-12">
                                    <div class="">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="tabs__pane -tab-item-3 ">
                            <div class="row y-gap-20">

                                <div class="col-12">
                                    <div class="">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="tabs__pane -tab-item-4 ">
                            <div class="row y-gap-20">

                                <div class="col-12">
                                    <div class="">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="tabs__pane -tab-item-5 ">
                            <div class="row y-gap-20">

                                <div class="col-12">
                                    <div class="">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="tabs__pane -tab-item-6 ">
                            <div class="row y-gap-20">

                                <div class="col-12">
                                    <div class="">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="border-top-light pt-20">
                                        <div class="row x-gap-20 y-gap-30">
                                            <div class="col-md-auto">

                                                <div class="cardImage ratio ratio-1:1 w-200 md:w-1/1 rounded-4">
                                                    <div class="cardImage__content">

                                                        <img class="rounded-4 col-12" src="img/hotels/1.png" alt="image">


                                                    </div>

                                                    <div class="cardImage__wishlist">
                                                        <button class="button -blue-1 bg-white size-30 rounded-full shadow-2">
                                                            <i class="icon-heart text-12"></i>
                                                        </button>
                                                    </div>


                                                </div>

                                            </div>

                                            <div class="col-md">
                                                <h3 class="text-18 lh-14 fw-500">Great Northern Hotel, a Tribute Portfolio Hotel, London</h3>

                                                <div class="d-flex x-gap-5 items-center pt-10">

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                    <i class="icon-star text-10 text-yellow-1"></i>

                                                </div>

                                                <div class="row x-gap-10 y-gap-10 items-center pt-20">
                                                    <div class="col-auto">
                                                        <p class="text-14">
                                                            Westminster Borough, London
                                                            <button data-x-click="mapFilter" class="text-blue-1 underline ml-10">Show on map</button>
                                                        </p>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="size-3 rounded-full bg-light-1"></div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <p class="text-14">2 km to city center</p>
                                                    </div>
                                                </div>

                                                <div class="row x-gap-10 y-gap-10 pt-20">

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Breakfast</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">WiFi</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Spa</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="border-light rounded-100 py-5 px-20 text-14 lh-14">Bar</div>
                                                    </div>

                                                </div>
                                            </div>

                                            <div class="col-md-auto text-right md:text-left">
                                                <div class="d-flex flex-column justify-between h-full">
                                                    <div class="row x-gap-10 y-gap-10 justify-end items-center md:justify-start">
                                                        <div class="col-auto">
                                                            <div class="text-14 lh-14 fw-500">Exceptional</div>
                                                            <div class="text-14 lh-14 text-light-1">3,014 reviews</div>
                                                        </div>
                                                        <div class="col-auto">
                                                            <div class="flex-center text-white fw-600 text-14 size-40 rounded-4 bg-blue-1">4.8</div>
                                                        </div>
                                                    </div>

                                                    <div class="pt-24">
                                                        <div class="fw-500">Starting from</div>
                                                        <span class="fw-500 text-blue-1">US$72</span> / night
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </div>

                <div class="pt-30">
                    <div class="row justify-between">
                        <div class="col-auto">
                            <button class="button -blue-1 size-40 rounded-full border-light">
                                <i class="icon-chevron-left text-12"></i>
                            </button>
                        </div>

                        <div class="col-auto">
                            <div class="row x-gap-20 y-gap-20 items-center">

                                <div class="col-auto">

                                    <div class="size-40 flex-center rounded-full bg-dark-1 text-white">1</div>

                                </div>

                                <div class="col-auto">

                                    <div class="size-40 flex-center rounded-full  bg-light-2">2</div>

                                </div>

                                <div class="col-auto">

                                    <div class="size-40 flex-center rounded-full">3</div>

                                </div>

                                <div class="col-auto">

                                    <div class="size-40 flex-center rounded-full">4</div>

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
                        </div>

                        <div class="col-auto">
                            <button class="button -blue-1 size-40 rounded-full border-light">
                                <i class="icon-chevron-right text-12"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
