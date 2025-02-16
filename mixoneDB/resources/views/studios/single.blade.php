@extends('layouts.backend')

@section('content')

    <section class="pt-40">
        <div class="container">
            <div class="row y-gap-20 justify-between items-end">
                <div class="col-auto">
                    <div class="row x-gap-20  items-center">
                        <div class="col-auto">
                            <h1 class="text-30 sm:text-25 fw-600">{{ $studio->name }}</h1>
                        </div>

                        <div class="col-auto">

                            <i class="icon-star text-10 text-yellow-1"></i>

                            <i class="icon-star text-10 text-yellow-1"></i>

                            <i class="icon-star text-10 text-yellow-1"></i>

                            <i class="icon-star text-10 text-yellow-1"></i>

                            <i class="icon-star text-10 text-yellow-1"></i>

                        </div>
                    </div>

                    <div class="row x-gap-20 y-gap-20 items-center">
                        <div class="col-auto">
                            <div class="d-flex items-center text-15 text-light-1">
                                <i class="icon-location-2 text-16 mr-5"></i>
                                {{$studio->address}}, {{ $studio->city}}, {{ $studio->zipcode}}, {{ $studio->country}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-auto">
                    <div class="row x-gap-15 y-gap-15 items-center">
                        <div class="col-auto">
                            <div class="text-14">
                                A partir de
                                <span class="text-22 text-dark-1 fw-500">{{$studio->hourly_rate}}€</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="galleryGrid -type-1 pt-30">
                <div class="galleryGrid__item relative d-flex">
                    <img src={{asset("media/img/gallery/1/1.png")}} alt="image" class="rounded-4">

                    <div class="absolute px-20 py-20 col-12 d-flex justify-end">
                        <button class="button -blue-1 size-40 rounded-full flex-center bg-white text-dark-1">
                            <i class="icon-heart text-16"></i>
                        </button>
                    </div>
                </div>

                <div class="galleryGrid__item">
                    <img src={{asset("media/img/gallery/1/2.png")}} alt="image" class="rounded-4">
                </div>

                <div class="galleryGrid__item relative d-flex">
                    <img src={{asset("media/img/gallery/1/3.png")}} alt="image" class="rounded-4">

                    <div class="absolute h-full col-12 flex-center">
                        <a href="{{$studio->video_url}}" class="button -blue-1 size-40 rounded-full flex-center bg-white text-dark-1 js-gallery" data-gallery="gallery1">
                            <i class="icon-play text-16"></i>
                        </a>
                    </div>
                </div>

                <div class="galleryGrid__item">
                    <img src={{asset("media/img/gallery/1/4.png")}} alt="image" class="rounded-4">
                </div>

                <div class="galleryGrid__item relative d-flex">
                    <img src={{asset("media/img/gallery/1/5.png")}} alt="image" class="rounded-4">

                </div>
            </div>
        </div>
    </section>

    <section class="pt-30">
        <div class="container">
            <div class="row y-gap-30">
                <div class="col-xl-8">
                    <div class="row y-gap-40">

                        <div id="overview" class="col-12">
                            <h3 class="text-22 fw-500 pt-40 border-top-light">Overview</h3>
                            <p class="text-dark-1 text-15 mt-20">
                            {{$studio->description}}
                            </p>
                        </div>

                        <div class="col-12">
                            <h3 class="text-22 fw-500 pt-40 border-top-light">Most Popular Facilities</h3>
                            <div class="row y-gap-10 pt-20">

                                <div class="col-md-5">
                                    <div class="d-flex x-gap-15 y-gap-15 items-center">
                                        <i class="icon-no-smoke"></i>
                                        <div class="text-15">Non-smoking rooms</div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="d-flex x-gap-15 y-gap-15 items-center">
                                        <i class="icon-wifi"></i>
                                        <div class="text-15">Free WiFi</div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="d-flex x-gap-15 y-gap-15 items-center">
                                        <i class="icon-parking"></i>
                                        <div class="text-15">Parking</div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="d-flex x-gap-15 y-gap-15 items-center">
                                        <i class="icon-kitchen"></i>
                                        <div class="text-15">Kitchen</div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="d-flex x-gap-15 y-gap-15 items-center">
                                        <i class="icon-living-room"></i>
                                        <div class="text-15">Living Area</div>
                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <div class="d-flex x-gap-15 y-gap-15 items-center">
                                        <i class="icon-shield"></i>
                                        <div class="text-15">Safety &amp; security</div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-12">
                            <div class="px-24 py-20 rounded-4 bg-green-1">
                                <div class="row x-gap-20 y-gap-20 items-center">
                                    <div class="col-auto">
                                        <div class="flex-center size-60 rounded-full bg-white">
                                            <i class="icon-star text-yellow-1 text-30"></i>
                                        </div>
                                    </div>

                                    <div class="col-auto">
                                        <h4 class="text-18 lh-15 fw-500">This property is in high demand!</h4>
                                        <div class="text-15 lh-15">7 travelers have booked today.</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="ml-50 lg:ml-0">
                        <div class="px-30 py-30 border-light rounded-4 shadow-4">
                            <div class="d-flex items-center justify-between">
                                <div class="">
                                    <span class="text-20 fw-500">{{$studio->hourly_rate}} €</span>
                                    <span class="text-14 text-light-1 ml-5">de l'heure</span>
                                </div>
                            </div>

                            <div class="row y-gap-20 pt-30">
                                <div class="col-12">

                                    <div class="searchMenu-date px-20 py-10 border-light rounded-4 -right js-form-dd js-calendar js-calendar-el">

                                        <div class="searchMenu-date px-30 lg:py-20 lg:px-0">
                                            <label for="date" class="text-15 fw-500 ls-2 lh-16">Jour</label>
                                            <input type="date" id="date" name="date" class="text-15 text-light-1 ls-2 lh-16" />
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12">

                                    <div class="searchMenu-guests px-20 py-10 border-light rounded-4 js-form-dd js-form-counters">

                                        <div data-x-dd-click="searchMenu-guests">
                                            <h4 class="text-15 fw-500 ls-2 lh-16">Nombre d'heures (minimum {{$studio->min_hours}}h)</h4>

                                            <div class="text-15 text-light-1 ls-2 lh-16">
                                                <span class="js-count-adult">2</span> Heures
                                            </div>
                                        </div>


                                        <div class="searchMenu-guests__field shadow-2" data-x-dd="searchMenu-guests" data-x-dd-toggle="-is-active">
                                            <div class="bg-white px-30 py-30 rounded-4">
                                                <div class="row y-gap-10 justify-between items-center">
                                                    <div class="col-auto">
                                                        <div class="text-15 fw-500">Heures</div>
                                                    </div>

                                                    <div class="col-auto">
                                                        <div class="d-flex items-center js-counter" data-value-change=".js-count-adult">
                                                            <button class="button -outline-blue-1 text-blue-1 size-38 rounded-4 js-down">
                                                                <i class="icon-minus text-12"></i>
                                                            </button>

                                                            <div class="flex-center size-20 ml-15 mr-15">
                                                                <div class="text-15 js-count">2</div>
                                                            </div>

                                                            <button class="button -outline-blue-1 text-blue-1 size-38 rounded-4 js-up">
                                                                <i class="icon-plus text-12"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-12">
                                    <button class="button -dark-1 px-35 h-60 col-12 bg-blue-1 text-white">
                                        Réserver
                                    </button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </section>
    <!--
        <div id="reviews"></div>
        <section class="pt-40">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h3 class="text-22 fw-500">Guest reviews</h3>
                    </div>
                </div>

                <div class="row y-gap-30 items-center pt-20">
                    <div class="col-lg-3">
                        <div class="flex-center rounded-4 min-h-250 bg-blue-1-05">
                            <div class="text-center">
                                <div class="text-60 md:text-50 fw-600 text-blue-1">4.8</div>
                                <div class="fw-500 lh-1">Exceptional</div>
                                <div class="text-14 text-light-1 lh-1 mt-5">3,014 reviews</div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-9">
                        <div class="row y-gap-30">

                            <div class="col-md-4 col-sm-6">
                                <div class="">
                                    <div class="d-flex items-center justify-between">
                                        <div class="text-15 fw-500">Location</div>
                                        <div class="text-15 text-light-1">9.4</div>
                                    </div>

                                    <div class="progressBar mt-10">
                                        <div class="progressBar__bg bg-blue-2"></div>
                                        <div class="progressBar__bar bg-dark-1" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="">
                                    <div class="d-flex items-center justify-between">
                                        <div class="text-15 fw-500">Staff</div>
                                        <div class="text-15 text-light-1">9.4</div>
                                    </div>

                                    <div class="progressBar mt-10">
                                        <div class="progressBar__bg bg-blue-2"></div>
                                        <div class="progressBar__bar bg-dark-1" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="">
                                    <div class="d-flex items-center justify-between">
                                        <div class="text-15 fw-500">Cleanliness</div>
                                        <div class="text-15 text-light-1">9.4</div>
                                    </div>

                                    <div class="progressBar mt-10">
                                        <div class="progressBar__bg bg-blue-2"></div>
                                        <div class="progressBar__bar bg-dark-1" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="">
                                    <div class="d-flex items-center justify-between">
                                        <div class="text-15 fw-500">Value for money</div>
                                        <div class="text-15 text-light-1">9.4</div>
                                    </div>

                                    <div class="progressBar mt-10">
                                        <div class="progressBar__bg bg-blue-2"></div>
                                        <div class="progressBar__bar bg-dark-1" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="">
                                    <div class="d-flex items-center justify-between">
                                        <div class="text-15 fw-500">Comfort</div>
                                        <div class="text-15 text-light-1">9.4</div>
                                    </div>

                                    <div class="progressBar mt-10">
                                        <div class="progressBar__bg bg-blue-2"></div>
                                        <div class="progressBar__bar bg-dark-1" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="">
                                    <div class="d-flex items-center justify-between">
                                        <div class="text-15 fw-500">Facilities</div>
                                        <div class="text-15 text-light-1">9.4</div>
                                    </div>

                                    <div class="progressBar mt-10">
                                        <div class="progressBar__bg bg-blue-2"></div>
                                        <div class="progressBar__bar bg-dark-1" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-4 col-sm-6">
                                <div class="">
                                    <div class="d-flex items-center justify-between">
                                        <div class="text-15 fw-500">Free WiFi</div>
                                        <div class="text-15 text-light-1">9.4</div>
                                    </div>

                                    <div class="progressBar mt-10">
                                        <div class="progressBar__bg bg-blue-2"></div>
                                        <div class="progressBar__bar bg-dark-1" style="width: 90%"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="pt-40">
            <div class="container">
                <div class="row y-gap-60">


                    <div class="col-lg-6">
                        <div class="row x-gap-20 y-gap-20 items-center">
                            <div class="col-auto">
                                <img src="img/avatars/2.png" alt="image">
                            </div>
                            <div class="col-auto">
                                <div class="fw-500 lh-15">Tonko</div>
                                <div class="text-14 text-light-1 lh-15">March 2022</div>
                            </div>
                        </div>

                        <h5 class="fw-500 text-blue-1 mt-20">9.2 Superb</h5>
                        <p class="text-15 text-dark-1 mt-10">Nice two level apartment in great London location. Located in quiet small street, but just 50 meters from main street and bus stop. Tube station is short walk, just like two grocery stores. </p>


                        <div class="row x-gap-30 y-gap-30 pt-20">

                            <div class="col-auto">
                                <img src="img/testimonials/1/1.png" alt="image" class="rounded-4">
                            </div>

                            <div class="col-auto">
                                <img src="img/testimonials/1/2.png" alt="image" class="rounded-4">
                            </div>

                            <div class="col-auto">
                                <img src="img/testimonials/1/3.png" alt="image" class="rounded-4">
                            </div>

                            <div class="col-auto">
                                <img src="img/testimonials/1/4.png" alt="image" class="rounded-4">
                            </div>

                        </div>


                        <div class="d-flex x-gap-30 items-center pt-20">
                            <button class="d-flex items-center text-blue-1">
                                <i class="icon-like text-16 mr-10"></i>
                                Helpful
                            </button>

                            <button class="d-flex items-center text-light-1">
                                <i class="icon-dislike text-16 mr-10"></i>
                                Not helpful
                            </button>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="row x-gap-20 y-gap-20 items-center">
                            <div class="col-auto">
                                <img src="img/avatars/2.png" alt="image">
                            </div>
                            <div class="col-auto">
                                <div class="fw-500 lh-15">Tonko</div>
                                <div class="text-14 text-light-1 lh-15">March 2022</div>
                            </div>
                        </div>

                        <h5 class="fw-500 text-blue-1 mt-20">9.2 Superb</h5>
                        <p class="text-15 text-dark-1 mt-10">Nice two level apartment in great London location. Located in quiet small street, but just 50 meters from main street and bus stop. Tube station is short walk, just like two grocery stores. </p>


                        <div class="row x-gap-30 y-gap-30 pt-20">

                            <div class="col-auto">
                                <img src="img/testimonials/1/1.png" alt="image" class="rounded-4">
                            </div>

                            <div class="col-auto">
                                <img src="img/testimonials/1/2.png" alt="image" class="rounded-4">
                            </div>

                            <div class="col-auto">
                                <img src="img/testimonials/1/3.png" alt="image" class="rounded-4">
                            </div>

                            <div class="col-auto">
                                <img src="img/testimonials/1/4.png" alt="image" class="rounded-4">
                            </div>

                        </div>


                        <div class="d-flex x-gap-30 items-center pt-20">
                            <button class="d-flex items-center text-blue-1">
                                <i class="icon-like text-16 mr-10"></i>
                                Helpful
                            </button>

                            <button class="d-flex items-center text-light-1">
                                <i class="icon-dislike text-16 mr-10"></i>
                                Not helpful
                            </button>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="row x-gap-20 y-gap-20 items-center">
                            <div class="col-auto">
                                <img src="img/avatars/2.png" alt="image">
                            </div>
                            <div class="col-auto">
                                <div class="fw-500 lh-15">Tonko</div>
                                <div class="text-14 text-light-1 lh-15">March 2022</div>
                            </div>
                        </div>

                        <h5 class="fw-500 text-blue-1 mt-20">9.2 Superb</h5>
                        <p class="text-15 text-dark-1 mt-10">Nice two level apartment in great London location. Located in quiet small street, but just 50 meters from main street and bus stop. Tube station is short walk, just like two grocery stores. </p>


                        <div class="d-flex x-gap-30 items-center pt-20">
                            <button class="d-flex items-center text-blue-1">
                                <i class="icon-like text-16 mr-10"></i>
                                Helpful
                            </button>

                            <button class="d-flex items-center text-light-1">
                                <i class="icon-dislike text-16 mr-10"></i>
                                Not helpful
                            </button>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="row x-gap-20 y-gap-20 items-center">
                            <div class="col-auto">
                                <img src="img/avatars/2.png" alt="image">
                            </div>
                            <div class="col-auto">
                                <div class="fw-500 lh-15">Tonko</div>
                                <div class="text-14 text-light-1 lh-15">March 2022</div>
                            </div>
                        </div>

                        <h5 class="fw-500 text-blue-1 mt-20">9.2 Superb</h5>
                        <p class="text-15 text-dark-1 mt-10">Nice two level apartment in great London location. Located in quiet small street, but just 50 meters from main street and bus stop. Tube station is short walk, just like two grocery stores. </p>


                        <div class="d-flex x-gap-30 items-center pt-20">
                            <button class="d-flex items-center text-blue-1">
                                <i class="icon-like text-16 mr-10"></i>
                                Helpful
                            </button>

                            <button class="d-flex items-center text-light-1">
                                <i class="icon-dislike text-16 mr-10"></i>
                                Not helpful
                            </button>
                        </div>
                    </div>


                </div>

                <div class="row pt-30">
                    <div class="col-auto">

                        <a href="#" class="button -md -outline-blue-1 text-blue-1">
                            Show all 116 reviews <div class="icon-arrow-top-right ml-15"></div>
                        </a>

                    </div>
                </div>
            </div>
        </section>

        <section class="pt-40">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10">
                        <div class="row">
                            <div class="col-auto">
                                <h3 class="text-22 fw-500">Leave a Reply</h3>
                                <p class="text-15 text-dark-1 mt-5">Your email address will not be published.</p>
                            </div>
                        </div>

                        <div class="row y-gap-30 pt-30">

                            <div class="col-xl-4">
                                <div class="text-15 lh-1 fw-500">Location</div>
                                <div class="d-flex x-gap-5 items-center pt-10">

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="text-15 lh-1 fw-500">Staff</div>
                                <div class="d-flex x-gap-5 items-center pt-10">

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="text-15 lh-1 fw-500">Cleanliness</div>
                                <div class="d-flex x-gap-5 items-center pt-10">

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="text-15 lh-1 fw-500">Value for money</div>
                                <div class="d-flex x-gap-5 items-center pt-10">

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="text-15 lh-1 fw-500">Comfort</div>
                                <div class="d-flex x-gap-5 items-center pt-10">

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="text-15 lh-1 fw-500">Facilities</div>
                                <div class="d-flex x-gap-5 items-center pt-10">

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                </div>
                            </div>

                            <div class="col-xl-4">
                                <div class="text-15 lh-1 fw-500">Free WiFi</div>
                                <div class="d-flex x-gap-5 items-center pt-10">

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                    <div class="icon-star text-10 text-yellow-1"></div>

                                </div>
                            </div>

                        </div>

                        <div class="row y-gap-30 pt-20">
                            <div class="col-xl-6">

                                <div class="form-input ">
                                    <input type="text" required>
                                    <label class="lh-1 text-16 text-light-1">Text</label>
                                </div>

                            </div>
                            <div class="col-xl-6">

                                <div class="form-input ">
                                    <input type="text" required>
                                    <label class="lh-1 text-16 text-light-1">Email</label>
                                </div>

                            </div>
                            <div class="col-12">

                                <div class="form-input ">
                                    <textarea required rows="4"></textarea>
                                    <label class="lh-1 text-16 text-light-1">Write Your Comment</label>
                                </div>

                            </div>
                            <div class="col-auto">

                                <a href="#" class="button -md -dark-1 bg-blue-1 text-white">
                                    Post Comment <div class="icon-arrow-top-right ml-15"></div>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    -->
@endsection


