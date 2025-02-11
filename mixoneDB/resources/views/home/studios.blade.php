<section class="layout-pt-md layout-pb-md">
    <div data-anim="slide-up delay-1" class="container">
        <div class="row y-gap-10 justify-between items-end">
            <div class="col-auto">
                <div class="sectionTitle -md">
                    <h2 class="sectionTitle__title">Recommended</h2>
                    <p class=" sectionTitle__text mt-5 sm:mt-0">Interdum et malesuada fames ac ante ipsum</p>
                </div>
            </div>

            <div class="col-sm-auto">

            </div>
        </div>

        <div class="relative overflow-hidden pt-40 sm:pt-20 js-section-slider" data-gap="30" data-scrollbar data-slider-cols="xl-4 lg-3 md-2 sm-2 base-1" data-nav-prev="js-hotels-prev" data-pagination="js-hotels-pag" data-nav-next="js-hotels-next">
            <div class="swiper-wrapper">
                @foreach($studios as $studio)
                    <div class="swiper-slide">
                        <a href="{{ route('studio.show', $studio) }}" class="hotelsCard -type-1 ">
                            <div class="hotelsCard__image">

                                <div class="cardImage ratio ratio-1:1">
                                    <div class="cardImage__content">
                                        <div class="cardImage-slider rounded-4 overflow-hidden js-cardImage-slider">
                                            <div class="swiper-wrapper">

                                                <div class="swiper-slide">
                                                    <img class="col-12" src="img/backgrounds/11.jpg" alt="image">
                                                </div>

                                                <div class="swiper-slide">
                                                    <img class="col-12" src="img/backgrounds/11.jpg" alt="image">
                                                </div>

                                                <div class="swiper-slide">
                                                    <img class="col-12" src="img/backgrounds/11.jpg" alt="image">
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

                            <div class="hotelsCard__content mt-10">
                                <h4 class="hotelsCard__title text-dark-1 text-18 lh-16 fw-500">
                                    <span>{{ $studio->name }}</span>
                                </h4>

                                <p class="text-light-1 lh-14 text-14 mt-5">{{ $studio->city }}</p>

                                <div class="d-flex items-center mt-20">
                                    <div class="flex-center bg-blue-1 rounded-4 size-30 text-12 fw-600 text-white">4.8</div>
                                    <div class="text-14 text-dark-1 fw-500 ml-10">Exceptional</div>
                                    <div class="text-14 text-light-1 ml-10">3,014 reviews</div>
                                </div>

                                <div class="mt-5">
                                    <div class="fw-500">
                                        A Partir de <span class="text-blue-1">50€</span>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>


            <div class="d-flex x-gap-15 items-center justify-center sm:justify-start pt-40 sm:pt-20">
                <div class="col-auto">
                    <button class="d-flex items-center text-24 arrow-left-hover js-hotels-prev">
                        <i class="icon icon-arrow-left"></i>
                    </button>
                </div>

                <div class="col-auto">
                    <div class="pagination -dots text-border js-hotels-pag"></div>
                </div>

                <div class="col-auto">
                    <button class="d-flex items-center text-24 arrow-right-hover js-hotels-next">
                        <i class="icon icon-arrow-right"></i>
                    </button>
                </div>
            </div>

        </div>
    </div>
</section>
