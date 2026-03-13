<section class="layout-pt-lg layout-pb-lg bg-blue-2">
    <div data-anim-wrap class="container">
        <div class="row y-gap-40 justify-between">
            <div data-anim-child="slide-up delay-1" class="col-xl-5 col-lg-6">
                <h2 class="text-30">Que disent nos clients<br class="d-none md:d-block"> sur nous ?</h2>
                <p class="mt-20">Super expérience de réservation ! Le site est très facile à utiliser, et j'ai trouvé rapidement le studio parfait pour mes besoins. Les informations étaient claires et précises, et la réservation s'est faite en quelques clics. Je recommande vivement !</p>

                <div class="row y-gap-30 pt-60 lg:pt-40">
                    <div class="col-sm-5 col-6">
                        <div class="text-30 lh-15 fw-600">{{ $satisfiedClients ?? '13M+' }}</div>
                        <div class="text-light-1 lh-15">Clients satisfaits</div>
                    </div>

                    <div class="col-sm-5 col-6">
                        <div class="text-30 lh-15 fw-600">{{ $globalRating ?? '4.88' }}</div>
                        <div class="text-light-1 lh-15">Note globale</div>

                        <div class="d-flex x-gap-5 items-center pt-10">
                            <div class="icon-star text-blue-1 text-10"></div>
                            <div class="icon-star text-blue-1 text-10"></div>
                            <div class="icon-star text-blue-1 text-10"></div>
                            <div class="icon-star text-blue-1 text-10"></div>
                            <div class="icon-star text-blue-1 text-10"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div data-anim-child="slide-up delay-2" class="col-lg-6">
                <div class="overflow-hidden js-testimonials-slider-3" data-scrollbar>
                    <div class="swiper-wrapper">

                        <div class="swiper-slide">
                            <div class="row items-center x-gap-30 y-gap-20">
                                <div class="col-auto">
                                    <div class="size-60 rounded-full overflow-hidden">
                                        <img src="#" data-src={{asset("media/img/misc/avatar-default.png")}} alt="image" class="js-lazy h-full w-full object-cover" style="transform: scale(1.4);">
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <h5 class="text-16 fw-500">Elias Louhichi</h5>
                                    <div class="text-15 text-light-1 lh-15">Rappeur </div>
                                </div>
                            </div>

                            <p class="text-18 fw-500 text-dark-1 mt-30 sm:mt-20">Le studio était exactement comme sur les photos, propre et bien équipé. Un excellent rapport qualité/prix. J'ai eu un petit souci avec le code d'accès, mais le service client a été super réactif et a résolu ça en un rien de temps. Je reviendrai !</p>
                        </div>

                        <div class="swiper-slide">
                            <div class="row items-center x-gap-30 y-gap-20">
                                <div class="col-auto">
                                    <div class="size-60 rounded-full overflow-hidden">
                                        <img src="#" data-src={{asset("media/img/misc/avatar-default.png")}} alt="image" class="js-lazy h-full w-full object-cover" style="transform: scale(1.4);">
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <h5 class="text-16 fw-500">EL KRABITO </h5>
                                    <div class="text-15 text-light-1 lh-15">Producteur</div>
                                </div>
                            </div>

                            <p class="text-18 fw-500 text-dark-1 mt-30 sm:mt-20">Le studio était exactement comme sur les photos, propre et bien équipé. Un excellent rapport qualité/prix. J'ai eu un petit souci avec le code d'accès, mais le service client a été super réactif et a résolu ça en un rien de temps. Je reviendrai !</p>
                        </div>

                        <div class="swiper-slide">
                            <div class="row items-center x-gap-30 y-gap-20">
                                <div class="col-auto">
                                    <div class="size-60 rounded-full overflow-hidden">
                                        <img src="#" data-src={{asset("media/img/misc/avatar-default.png")}} alt="image" class="js-lazy h-full w-full object-cover" style="transform: scale(1.4);">
                                    </div>
                                </div>

                                <div class="col-auto">
                                    <h5 class="text-16 fw-500">Matheo</h5>
                                    <div class="text-15 text-light-1 lh-15">Beatmaker</div>
                                </div>
                            </div>

                            <p class="text-18 fw-500 text-dark-1 mt-30 sm:mt-20">Le studio était exactement comme sur les photos, propre et bien équipé. Un excellent rapport qualité/prix. J'ai eu un petit souci avec le code d'accès, mais le service client a été super réactif et a résolu ça en un rien de temps. Je reviendrai !</p>
                        </div>

                    </div>

                    <div class="d-flex items-center mt-60 sm:mt-20 js-testimonials-slider-pag">
                        <div class="text-dark-1 fw-500 js-current">01</div>
                        <div class="slider-scrollbar bg-border ml-20 mr-20 w-max-300 js-scrollbar"></div>
                        <div class="text-dark-1 fw-500 js-all">05</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
