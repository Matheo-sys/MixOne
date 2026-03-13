<section class="layout-pt-md layout-pb-md">
    <div data-anim="slide-up delay-1" class="container">
        <div class="row y-gap-10 justify-between items-end">
            <div class="col-auto">
                <div class="sectionTitle -md">
                    <h2 class="sectionTitle__title">Studios Recommandés</h2>
                    <p class="sectionTitle__text mt-5 sm:mt-0">Découvrez les studios recommandés pour vous en fonction de vos préférences.</p>
                </div>
            </div>

            <div class="col-sm-auto">

            </div>
        </div>

        <div class="relative overflow-hidden pt-40 sm:pt-20 js-section-slider" data-gap="30" data-scrollbar data-slider-cols="xl-4 lg-3 md-2 sm-2 base-1" data-nav-prev="js-hotels-prev" data-pagination="js-hotels-pag" data-nav-next="js-hotels-next">
            <div class="swiper-wrapper">
                @foreach($studios as $studio)
                    <div class="swiper-slide">
                        <a href="{{ route('studio.show', $studio) }}" class="studioCard">
                            {{-- Image Section --}}
                            <div class="studioCard__image">
                                <div class="cardImage ratio studioCard__ratio">
                                    <div class="cardImage__content">
                                        <div class="cardImage-slider rounded-4 overflow-hidden js-cardImage-slider">
                                            <div class="swiper-wrapper">

                                                @php
                                                    $hasImages = false;
                                                    for ($i = 1; $i <= 4; $i++) {
                                                        $imageField = "image{$i}";
                                                        if (!empty($studio->$imageField)) {
                                                            $hasImages = true;
                                                            echo '<div class="swiper-slide">';
                                                            echo '<img class="col-12 studioCard__img" src="' . asset('storage/' . $studio->$imageField) . '" alt="Image studio ' . $studio->name . '">';
                                                            echo '</div>';
                                                        }
                                                    }

                                                    if (!$hasImages) {
                                                        echo '<div class="swiper-slide">';
                                                        echo '<img class="col-12 studioCard__img" src="' . asset('media/img/backgrounds/11.jpg') . '" alt="Image par défaut">';
                                                        echo '</div>';
                                                    }
                                                @endphp

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

                                    {{-- Top overlay badges --}}
                                    <div class="studioCard__badges">
                                        <div class="studioCard__wishlist">
                                            @php
                                                $isFavorite = Auth::check() && Auth::user()->favoriteStudios->contains($studio->id);
                                            @endphp
                                            <button class="button -blue-1 bg-white size-30 rounded-full shadow-2 wishlist-toggle {{ $isFavorite ? '-active' : '' }}" data-studio-id="{{ $studio->id }}">
                                                @if($isFavorite)
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="14" height="14" fill="#ff4d4d">
                                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                                    </svg>
                                                @else
                                                    <i class="icon-heart text-12"></i>
                                                @endif
                                            </button>
                                        </div>
                                    </div>

                                    {{-- Price tag overlay --}}
                                    <div class="studioCard__priceTag">
                                        <span>{{ $studio->hourly_rate }}€<small>/h</small></span>
                                    </div>

                                    @if($studio->user)
                                    <div class="studioCard__contact">
                                        <button type="button" class="button -blue-1 bg-white size-30 rounded-full shadow-2"
                                            onclick="event.preventDefault(); @if(!Auth::check()) window.location.href='{{ route('login') }}'; @else window.startNewMessagingChat({{ $studio->user_id }}, '{{ addslashes($studio->user->first_name) }} {{ addslashes($studio->user->last_name) }}', '{{ $studio->user->avatar }}'); @endif">
                                            <i class="icon-email-2 text-12"></i>
                                        </button>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Content Section --}}
                            <div class="studioCard__content">
                                <div class="studioCard__header">
                                    <h4 class="studioCard__title">{{ $studio->name }}</h4>
                                    <div class="studioCard__rating">
                                        <i class="icon-star text-10"></i>
                                        <span>4.8</span>
                                    </div>
                                </div>

                                <div class="studioCard__location">
                                    <i class="icon-location-2 text-12"></i>
                                    <span>{{ $studio->city }}</span>
                                </div>

                                @if(isset($studio->distance))
                                    <div class="studioCard__distance">
                                        <i class="icon-route text-12"></i>
                                        <span>{{ number_format($studio->distance, 1) }} km</span>
                                    </div>
                                @endif

                                <div class="studioCard__footer">
                                    <div class="studioCard__reviews">
                                        <span class="studioCard__reviewCount">3,014 avis</span>
                                    </div>
                                    <div class="studioCard__cta">
                                        Réserver <i class="icon-arrow-top-right text-10"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>


            <div class="d-flex x-gap-15 items-center justify-center pt-40 sm:pt-20">
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.wishlist-toggle').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                @if(!Auth::check())
                    window.location.href = '{{ route('login') }}';
                    return;
                @endif

                const studioId = this.getAttribute('data-studio-id');

                fetch('{{ route('wishlist.toggle') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ studio_id: studioId })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            if (data.status === 'added') {
                                this.classList.add('-active');
                                this.innerHTML = `<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="14" height="14" fill="#ff4d4d"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>`;
                            } else {
                                this.classList.remove('-active');
                                this.innerHTML = `<i class="icon-heart text-12"></i>`;
                            }
                            this.classList.add('clicked');
                            setTimeout(() => {
                                this.classList.remove('clicked');
                            }, 450);
                        }
                    })
                    .catch(error => {
                        console.error('Erreur AJAX:', error);
                    });
            });
        });
    });
</script>
