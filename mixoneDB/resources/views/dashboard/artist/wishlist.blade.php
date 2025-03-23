@extends('layouts.backendDB')

@section('content')
    <section class=" bg-light-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-center">
                        <h1 class="text-30 fw-600">MES STUDIOS FAVORIS</h1>
                    </div>
                    <div class="text-center mt-20">
                        <p>Retrouvez tous vos dans la liste d'envie</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="layout-pt-md layout-pb-lg">
        <div class="container">
            @if($favoriteStudios->isEmpty())
                <!-- Code pour affichage vide -->
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="text-18">Vous n'avez pas encore de studios favoris</p>
                        <a href="{{ route('studio_list') }}" class="button -md -dark-1 bg-blue-1 text-white mt-24">
                            Découvrir les studios <div class="icon-arrow-top-right ml-15"></div>
                        </a>
                    </div>
                </div>
            @else
                @if(count($favoriteStudios) > 3)
                    <!-- Navigation horizontale pour le carrousel -->
                    <div class="d-flex x-gap-15 items-center justify-center sm:justify-start pt-20 pb-30">
                        <div class="col-auto">
                            <button class="d-flex items-center text-24 arrow-left-hover js-wishlist-prev">
                                <i class="icon icon-arrow-left"></i>
                            </button>
                        </div>
                        <div class="col-auto">
                            <div class="pagination -dots text-border js-wishlist-pag"></div>
                        </div>
                        <div class="col-auto">
                            <button class="d-flex items-center text-24 arrow-right-hover js-wishlist-next">
                                <i class="icon icon-arrow-right"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Swiper container pour plus de 3 éléments -->
                    <div class="swiper-container wishlist-container">
                        <div class="swiper-wrapper">
                            @foreach($favoriteStudios as $studio)
                                <div class="swiper-slide">
                                    <div class="border-light rounded-4 p-10">
                                        <div class="cardImage ratio ratio-23:18 rounded-4 overflow-hidden">
                                            <div class="cardImage__content">
                                                <div class="cardImage-slider rounded-4 overflow-hidden js-cardImage-slider">
                                                    <div class="swiper-wrapper">
                                                        <div class="swiper-slide">
                                                            <img class="col-12" src={{asset("media/img/backgrounds/11.jpg")}} alt="image" alt="Image studio">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="pt-10 px-10">
                                            <div class="d-flex justify-between">
                                                <h3 class="text-18 lh-16 fw-500">{{ $studio->name }}</h3>
                                                <div class="col-auto">
                                                    <button class="flex-center bg-light-2 rounded-4 size-35 trash-btn" data-studio-id="{{ $studio->id }}">
                                                        <i class="icon-trash-2 text-16 text-light-1"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <p class="text-14 lh-14 mt-5">{{ $studio->city }}</p>
                                            <div class="text-14 text-light-1 mt-5">A partir de {{ $studio->hourly_rate }}€/heure</div>
                                            <a href="{{ route('studio.show', $studio) }}" class="button -sm -dark-1 bg-blue-1 text-white mt-10 w-100" style="padding: 12px 24px; font-size: 16px; border-radius: 4px;">
                                                Voir Détails
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Affichage en grille pour 3 éléments ou moins -->
                    <div class="row y-gap-30">
                        @foreach($favoriteStudios as $studio)
                            <div class="col-lg-4 col-md-6 wishlist-item">
                                <div class="border-light rounded-4 p-10">
                                    <!-- Conteneur de l'image -->
                                    <div class="cardImage ratio ratio-23:18 rounded-4 overflow-hidden">
                                        <div class="cardImage__content">
                                            <div class="cardImage-slider rounded-4 overflow-hidden js-cardImage-slider">
                                                <div class="swiper-wrapper">
                                                    <div class="swiper-slide">
                                                        <img class="col-12" src="{{ asset('media/img/backgrounds/11.jpg') }}" alt="Image studio">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Bouton de la wishlist -->

                                    </div>

                                    <!-- Conteneur du texte -->
                                    <div class="pt-10 px-10">
                                        <div class="d-flex justify-between">
                                            <h3 class="text-18 lh-16 fw-500">{{ $studio->name }}</h3>
                                            <div class="col-auto">
                                                <button class="flex-center bg-light-2 rounded-4 size-35 trash-btn" data-studio-id="{{ $studio->id }}">
                                                    <i class="icon-trash-2 text-16 text-light-1"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <p class="text-14 lh-14 mt-5">{{ $studio->city }}</p>
                                        <div class="text-14 text-light-1 mt-5">A partir de {{ $studio->hourly_rate }}€/heure</div>

                                        <!-- Bouton "Voir Détails" -->
                                        <a href="{{ route('studio.show', $studio) }}" class="button -sm -dark-1 bg-blue-1 text-white mt-10 w-100" style="padding: 12px 24px; font-size: 16px; border-radius: 4px;">
                                            Voir Détails
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            @endif
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Gérer la suppression d'un studio des favoris
            document.querySelectorAll('.trash-btn').forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    const studioId = this.getAttribute('data-studio-id');
                    const studioCard = this.closest('.swiper-slide') || this.closest('.wishlist-item');

                    if (confirm('Êtes-vous sûr de vouloir supprimer ce studio de vos favoris?')) {
                        // Envoyer une requête AJAX pour supprimer des favoris
                        fetch('{{ route('wishlist.toggle') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                studio_id: studioId
                            })
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success && data.status === 'removed') {
                                    // Animation de suppression
                                    studioCard.style.transition = 'opacity 0.5s ease';
                                    studioCard.style.opacity = 0;

                                    setTimeout(() => {
                                        studioCard.remove();

                                        // Vérifier s'il reste des studios
                                        const remainingStudios = document.querySelectorAll('.swiper-slide, .wishlist-item');
                                        if (remainingStudios.length === 0) {
                                            location.reload(); // Recharger pour afficher le message "pas de favoris"
                                        }
                                    }, 500);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                            });
                    }
                });
            });

            if (typeof Swiper !== 'undefined' && document.querySelectorAll('.wishlist-container .swiper-slide').length > 3) {
                new Swiper('.wishlist-container', {
                    slidesPerView: 1,
                    spaceBetween: 30,
                    pagination: {
                        el: '.js-wishlist-pag',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.js-wishlist-next',
                        prevEl: '.js-wishlist-prev',
                    },
                    breakpoints: {
                        576: {
                            slidesPerView: 2,
                        },
                        992: {
                            slidesPerView: 3,
                        }
                    }
                });
            }
        });
    </script>

    <style>
        /* Styles pour le bouton de suppression */
        .trash-btn {
            transition: all 0.3s ease;
        }

        .trash-btn:hover {
            background-color: #ff4d4d;
        }

        .trash-btn:hover i {
            color: red !important;
        }

        /* Style pour les carrousels */
        .wishlist-container {
            width: 100%;
            overflow: hidden;
        }

        /* Animation pour la suppression */
        .wishlist-item, .swiper-slide {
            transition: opacity 0.5s ease;
        }
    </style>
@endsection
