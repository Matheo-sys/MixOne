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



                    <div class="sidebar__item pb-30">
                        <h5 class="text-18 fw-500 mb-10">Price</h5>
                        <div class="row x-gap-10 y-gap-30">
                            <div class="col-12">
                                <div class="js-price-rangeSlider">
                                    <div class="text-14 fw-500"></div>

                                    <div class="d-flex justify-between mb-20">
                                        <div class="text-15 text-dark-1">
                                            <span class="js-lower"></span>
                                            -
                                            <span class="js-upper"></span>
                                        </div>
                                    </div>

                                    <div class="px-5">
                                        <div class="js-slider"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                </aside>
            </div>

            <div class="col-xl-9 col-lg-8">
                <div class="row y-gap-10 items-center justify-between">
                    <div class="col-auto">
                        <div class="text-18"><span class="fw-500">100 Studios</span> en France</div>
                    </div>

                    <div class="col-auto">
                        <div class="row x-gap-20 y-gap-20">
                            <div class="col-auto">
                                <button class="button -blue-1 h-40 px-20 rounded-100 bg-blue-1-05 text-15 text-blue-1">
                                    <i class="icon-up-down text-14 mr-10"></i>
                                    Filtre
                                </button>
                            </div>

                            <div class="col-auto d-none lg:d-block">
                                <button data-x-click="filterPopup" class="button -blue-1 h-40 px-20 rounded-100 bg-blue-1-05 text-15 text-blue-1">
                                    <i class="icon-up-down text-14 mr-10"></i>
                                    Filtre
                                </button>
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

                                <div class="row y-gap-10 items-center justify-between">
                                    <div class="col-auto">

                                        <div class="d-flex items-center">
                                            <div class="form-checkbox ">
                                                <input type="checkbox" name="name">
                                                <div class="form-checkbox__mark">
                                                    <div class="form-checkbox__icon icon-check"></div>
                                                </div>
                                            </div>

                                            <div class="text-15 ml-10">Shared Room </div>

                                        </div>

                                    </div>

                                    <div class="col-auto">
                                        <div class="text-15 text-light-1">45</div>
                                    </div>
                                </div>

                                <div class="row y-gap-10 items-center justify-between">
                                    <div class="col-auto">

                                        <div class="d-flex items-center">
                                            <div class="form-checkbox ">
                                                <input type="checkbox" name="name">
                                                <div class="form-checkbox__mark">
                                                    <div class="form-checkbox__icon icon-check"></div>
                                                </div>
                                            </div>

                                            <div class="text-15 ml-10">Villa</div>

                                        </div>

                                    </div>

                                    <div class="col-auto">
                                        <div class="text-15 text-light-1">21</div>
                                    </div>
                                </div>

                                <div class="row y-gap-10 items-center justify-between">
                                    <div class="col-auto">

                                        <div class="d-flex items-center">
                                            <div class="form-checkbox ">
                                                <input type="checkbox" name="name">
                                                <div class="form-checkbox__mark">
                                                    <div class="form-checkbox__icon icon-check"></div>
                                                </div>
                                            </div>

                                            <div class="text-15 ml-10">Motel </div>

                                        </div>

                                    </div>

                                    <div class="col-auto">
                                        <div class="text-15 text-light-1">78</div>
                                    </div>
                                </div>

                                <div class="row y-gap-10 items-center justify-between">
                                    <div class="col-auto">

                                        <div class="d-flex items-center">
                                            <div class="form-checkbox ">
                                                <input type="checkbox" name="name">
                                                <div class="form-checkbox__mark">
                                                    <div class="form-checkbox__icon icon-check"></div>
                                                </div>
                                            </div>

                                            <div class="text-15 ml-10">Cabins </div>

                                        </div>

                                    </div>

                                    <div class="col-auto">
                                        <div class="text-15 text-light-1">679</div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="sidebar__item pb-30">
                            <h5 class="text-18 fw-500 mb-10">Price</h5>
                            <div class="row x-gap-10 y-gap-30">
                                <div class="col-12">
                                    <div class="js-price-rangeSlider">
                                        <div class="text-14 fw-500"></div>

                                        <div class="d-flex justify-between mb-20">
                                            <div class="text-15 text-dark-1">
                                                <span class="js-lower"></span>
                                                -
                                                <span class="js-upper"></span>
                                            </div>
                                        </div>

                                        <div class="px-5">
                                            <div class="js-slider"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="sidebar__item">
                            <h5 class="text-18 fw-500 mb-10">Guest Rating</h5>
                            <div class="sidebar-checkbox">

                                <div class="row y-gap-10 items-center justify-between">
                                    <div class="col-auto">

                                        <div class="form-radio d-flex items-center ">
                                            <div class="radio">
                                                <input type="radio" name="name">
                                                <div class="radio__mark">
                                                    <div class="radio__icon"></div>
                                                </div>
                                            </div>
                                            <div class="ml-10">Any</div>
                                        </div>

                                    </div>

                                    <div class="col-auto">
                                        <div class="text-15 text-light-1">92</div>
                                    </div>
                                </div>

                                <div class="row y-gap-10 items-center justify-between">
                                    <div class="col-auto">

                                        <div class="form-radio d-flex items-center ">
                                            <div class="radio">
                                                <input type="radio" name="name">
                                                <div class="radio__mark">
                                                    <div class="radio__icon"></div>
                                                </div>
                                            </div>
                                            <div class="ml-10">Wonderful 4.5+</div>
                                        </div>

                                    </div>

                                    <div class="col-auto">
                                        <div class="text-15 text-light-1">45</div>
                                    </div>
                                </div>

                                <div class="row y-gap-10 items-center justify-between">
                                    <div class="col-auto">

                                        <div class="form-radio d-flex items-center ">
                                            <div class="radio">
                                                <input type="radio" name="name">
                                                <div class="radio__mark">
                                                    <div class="radio__icon"></div>
                                                </div>
                                            </div>
                                            <div class="ml-10">Very good 4+</div>
                                        </div>

                                    </div>

                                    <div class="col-auto">
                                        <div class="text-15 text-light-1">21</div>
                                    </div>
                                </div>

                                <div class="row y-gap-10 items-center justify-between">
                                    <div class="col-auto">

                                        <div class="form-radio d-flex items-center ">
                                            <div class="radio">
                                                <input type="radio" name="name">
                                                <div class="radio__mark">
                                                    <div class="radio__icon"></div>
                                                </div>
                                            </div>
                                            <div class="ml-10">Good 3.5+ </div>
                                        </div>

                                    </div>

                                    <div class="col-auto">
                                        <div class="text-15 text-light-1">78</div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="sidebar__item">
                            <h5 class="text-18 fw-500 mb-10">Amenities</h5>
                            <div class="sidebar-checkbox">

                                <div class="row y-gap-10 items-center justify-between">
                                    <div class="col-auto">

                                        <div class="d-flex items-center">
                                            <div class="form-checkbox ">
                                                <input type="checkbox" name="name">
                                                <div class="form-checkbox__mark">
                                                    <div class="form-checkbox__icon icon-check"></div>
                                                </div>
                                            </div>

                                            <div class="text-15 ml-10">Breakfast Included</div>

                                        </div>

                                    </div>

                                    <div class="col-auto">
                                        <div class="text-15 text-light-1">92</div>
                                    </div>
                                </div>

                                <div class="row y-gap-10 items-center justify-between">
                                    <div class="col-auto">

                                        <div class="d-flex items-center">
                                            <div class="form-checkbox ">
                                                <input type="checkbox" name="name">
                                                <div class="form-checkbox__mark">
                                                    <div class="form-checkbox__icon icon-check"></div>
                                                </div>
                                            </div>

                                            <div class="text-15 ml-10">WiFi Included </div>

                                        </div>

                                    </div>

                                    <div class="col-auto">
                                        <div class="text-15 text-light-1">45</div>
                                    </div>
                                </div>

                                <div class="row y-gap-10 items-center justify-between">
                                    <div class="col-auto">

                                        <div class="d-flex items-center">
                                            <div class="form-checkbox ">
                                                <input type="checkbox" name="name">
                                                <div class="form-checkbox__mark">
                                                    <div class="form-checkbox__icon icon-check"></div>
                                                </div>
                                            </div>

                                            <div class="text-15 ml-10">Pool</div>

                                        </div>

                                    </div>

                                    <div class="col-auto">
                                        <div class="text-15 text-light-1">21</div>
                                    </div>
                                </div>

                                <div class="row y-gap-10 items-center justify-between">
                                    <div class="col-auto">

                                        <div class="d-flex items-center">
                                            <div class="form-checkbox ">
                                                <input type="checkbox" name="name">
                                                <div class="form-checkbox__mark">
                                                    <div class="form-checkbox__icon icon-check"></div>
                                                </div>
                                            </div>

                                            <div class="text-15 ml-10">Restaurant </div>

                                        </div>

                                    </div>

                                    <div class="col-auto">
                                        <div class="text-15 text-light-1">78</div>
                                    </div>
                                </div>

                                <div class="row y-gap-10 items-center justify-between">
                                    <div class="col-auto">

                                        <div class="d-flex items-center">
                                            <div class="form-checkbox ">
                                                <input type="checkbox" name="name">
                                                <div class="form-checkbox__mark">
                                                    <div class="form-checkbox__icon icon-check"></div>
                                                </div>
                                            </div>

                                            <div class="text-15 ml-10">Air conditioning </div>

                                        </div>

                                    </div>

                                    <div class="col-auto">
                                        <div class="text-15 text-light-1">679</div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </aside>
                </div>

                <div class="mt-30"></div>

                <div class="row y-gap-30">

                    <div class="col-12">

                        <div class="border-top-light pt-20">
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
                                            <p class="text-14 lh-14 mb-5">Paris</p>
                                            <h3 class="text-18 lh-16 fw-500">Studio <br> Bleu</h3>

                                            <div class="row x-gap-5 items-center pt-5">

                                                <div class="col-auto">

                                                </div>
                                                <div class="col-auto">

                                                </div>
                                                <div class="col-auto">

                                                </div>
                                                <div class="col-auto">

                                                </div>
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
                                    <div class="text-22 lh-12 fw-600 mt-5">50€</div>
                                    <div class="text-14 text-light-1 mt-5">par heures</div>


                                    <a href="#" class="button -md -dark-1 bg-blue-1 text-white mt-24">
                                        View Detail <div class="icon-arrow-top-right ml-15"></div>
                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-12">

                        <div class="border-top-light pt-20">
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
                                            <p class="text-14 lh-14 mb-5">Paris</p>
                                            <h3 class="text-18 lh-16 fw-500">Studio <br> Bleu</h3>

                                            <div class="row x-gap-5 items-center pt-5">

                                                <div class="col-auto">

                                                </div>
                                                <div class="col-auto">

                                                </div>
                                                <div class="col-auto">

                                                </div>
                                                <div class="col-auto">

                                                </div>
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
                                    <div class="text-22 lh-12 fw-600 mt-5">50€</div>
                                    <div class="text-14 text-light-1 mt-5">par heures</div>


                                    <a href="#" class="button -md -dark-1 bg-blue-1 text-white mt-24">
                                        View Detail <div class="icon-arrow-top-right ml-15"></div>
                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-12">

                        <div class="border-top-light pt-20">
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
                                            <p class="text-14 lh-14 mb-5">Paris</p>
                                            <h3 class="text-18 lh-16 fw-500">Studio <br> Bleu</h3>

                                            <div class="row x-gap-5 items-center pt-5">

                                                <div class="col-auto">

                                                </div>
                                                <div class="col-auto">

                                                </div>
                                                <div class="col-auto">

                                                </div>
                                                <div class="col-auto">

                                                </div>
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
                                    <div class="text-22 lh-12 fw-600 mt-5">50€</div>
                                    <div class="text-14 text-light-1 mt-5">par heures</div>


                                    <a href="#" class="button -md -dark-1 bg-blue-1 text-white mt-24">
                                        View Detail <div class="icon-arrow-top-right ml-15"></div>
                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-12">

                        <div class="border-top-light pt-20">
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
                                            <p class="text-14 lh-14 mb-5">Paris</p>
                                            <h3 class="text-18 lh-16 fw-500">Studio <br> Bleu</h3>

                                            <div class="row x-gap-5 items-center pt-5">

                                                <div class="col-auto">

                                                </div>
                                                <div class="col-auto">

                                                </div>
                                                <div class="col-auto">

                                                </div>
                                                <div class="col-auto">

                                                </div>
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
                                    <div class="text-22 lh-12 fw-600 mt-5">50€</div>
                                    <div class="text-14 text-light-1 mt-5">par heures</div>


                                    <a href="#" class="button -md -dark-1 bg-blue-1 text-white mt-24">
                                        View Detail <div class="icon-arrow-top-right ml-15"></div>
                                    </a>

                                </div>
                            </div>
                        </div>

                    </div>



                </div>

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
                                <div class="text-14 text-light-1">1 – 20 of 300+ properties found</div>
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
