@extends('layouts.backend')

@section('title', $studio->name . ' | Studio de Musique à ' . $studio->city . ' | MixOne')
@section('meta_description', 'Réservez votre session au studio ' . $studio->name . ' à ' . $studio->city . '. Tarif : ' . $studio->hourly_rate . '€/h. Équipements professionnels et confort garantis.')

@section('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "LocalBusiness",
  "name": "{{ $studio->name }}",
  "description": "{{ $studio->description ?? 'Studio professionnel de musique' }}",
  "url": "{{ url()->current() }}",
  "telephone": "{{ $studio->phone ?? '' }}",
  "address": {
    "@type": "PostalAddress",
    "streetAddress": "{{ $studio->address }}",
    "addressLocality": "{{ $studio->city }}",
    "addressCountry": "FR"
  },
  "geo": {
    "@type": "GeoCoordinates",
    "latitude": {{ $studio->latitude }},
    "longitude": {{ $studio->longitude }}
  },
  "priceRange": "{{ $studio->hourly_rate }}€/h",
  "image": "{{ $studio->image1 ? storage_url($studio->image1) : asset('media/img/backgrounds/11.jpg') }}"
}
</script>
@endsection

@section('content')

    <section class="mt-90 studio-show-header">
        <div class="container">
            <div class="row y-gap-5 md:y-gap-20 justify-between items-center">
                <div class="col-auto">
                    <div class="row x-gap-20 items-center">
                        <div class="col-auto">
                            <h1 class="text-30 sm:text-25 fw-600">{{ $studio->name }}</h1>
                        </div>
                        @if($studio->reviews_count > 0)
                            <div class="col-auto">
                                <div class="d-flex items-center">
                                    <i class="icon-star text-10 text-yellow-1 mr-5"></i>
                                    <span class="text-14 fw-500">{{ $studio->average_rating }}</span>
                                    <span class="text-14 text-light-1 ml-5">({{ $studio->reviews_count }})</span>
                                </div>
                            </div>
                        @else
                            <div class="col-auto">
                                <div class="text-14 text-light-1">Nouveau studio</div>
                            </div>
                        @endif
                    </div>
                    <div class="row x-gap-20 y-gap-20 items-center">
                        <div class="col-auto">
                            <div class="d-flex items-center text-15 sm:text-14 text-light-1">
                                <i class="icon-location-2 text-16 mr-5"></i>
                                {{ $studio->address }}, {{ $studio->city }}, {{ $studio->zipcode }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <div class="row x-gap-15 y-gap-15 items-center">
                        <div class="col-auto">
                            <div class="text-14 text-light-1">A partir de</div>
                            <div class="text-22 sm:text-20 text-dark-1 fw-500">{{ $studio->hourly_rate }}€<span class="text-14 fw-400 text-light-1">/h</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Galerie d'images, description, etc... -->
            <div class="galleryGrid -type-1 pt-30">
                <div class="galleryGrid__item relative d-flex">
                    <img src="{{ $studio->image1 ? storage_url($studio->image1) : asset('media/img/backgrounds/11.jpg') }}" alt="image" class="rounded-4">
                    <div class="absolute px-20 py-20 col-12 d-flex justify-end">
                    </div>
                </div>
                <div class="galleryGrid__item">
                    <img src="{{ $studio->image2 ? storage_url($studio->image2) : asset('media/img/backgrounds/11.jpg') }}" alt="image" class="rounded-4">
                </div>
                <div class="galleryGrid__item relative d-flex">
                    <img src="{{ $studio->image3 ? storage_url($studio->image3) : asset('media/img/backgrounds/11.jpg') }}" alt="image" class="rounded-4">
                    <div class="absolute h-full col-12 flex-center">
                    </div>
                </div>
                <div class="galleryGrid__item">
                    <img src="{{ $studio->image4 ? storage_url($studio->image4) : asset('media/img/backgrounds/11.jpg') }}" alt="image" class="rounded-4">
                </div>
                <div class="galleryGrid__item relative d-flex">
                    <img src="{{ $studio->image5 ? storage_url($studio->image5) : ($studio->image1 ? storage_url($studio->image1) : asset('media/img/backgrounds/11.jpg')) }}" alt="image" class="rounded-4">
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
                            <h3 class="text-22 fw-500 pt-40 border-top-light">Présentation</h3>
                            <p class="text-dark-1 text-15 mt-20">
                                {{ $studio->description }}
                            </p>
                        </div>
                        <div class="col-12">
                            @php
                            // Icons: using available theme icons (icomoon). SVG inline for audio-specific icons not in font
                            $allEquipment = [
                                // Microphones
                                'micro_condenser'       => ['label' => 'Micro condensateur',    'svg' => true],
                                'micro_dynamic'         => ['label' => 'Micro dynamique',        'svg' => true],
                                'micro_ribbon'          => ['label' => 'Micro à ruban',          'svg' => true],
                                'micro_large_diaphragm' => ['label' => 'Grand diaphragme',       'svg' => true],
                                'micro_small_diaphragm' => ['label' => 'Petit diaphragme',       'svg' => true],
                                'micro_usb'             => ['label' => 'Micro USB',              'svg' => true],
                                // Preamps / Interfaces
                                'preamp_neve'           => ['label' => 'Preamp Neve',            'icon' => 'icon-speedometer'],
                                'preamp_api'            => ['label' => 'Preamp API',             'icon' => 'icon-speedometer'],
                                'preamp_ssl'            => ['label' => 'Preamp SSL',             'icon' => 'icon-speedometer'],
                                'interface_apollo'      => ['label' => 'Interface Apollo (UA)',  'icon' => 'icon-plans'],
                                'interface_focusrite'   => ['label' => 'Interface Focusrite',    'icon' => 'icon-plans'],
                                'interface_rme'         => ['label' => 'Interface RME',          'icon' => 'icon-plans'],
                                'interface_other'       => ['label' => 'Interface audio',        'icon' => 'icon-plans'],
                                // Instruments
                                'piano_grand'           => ['label' => 'Piano à queue',          'icon' => 'icon-ticket'],
                                'piano_upright'         => ['label' => 'Piano droit',            'icon' => 'icon-ticket'],
                                'clavier_midi'          => ['label' => 'Clavier MIDI',           'icon' => 'icon-ticket'],
                                'synth'                 => ['label' => 'Synthétiseur',           'icon' => 'icon-ticket'],
                                'drum_kit'              => ['label' => 'Batterie acoustique',    'icon' => 'icon-fire'],
                                'drum_electronic'       => ['label' => 'Batterie électronique',  'icon' => 'icon-fire'],
                                'guitar_electric'       => ['label' => 'Guitare électrique',     'icon' => 'icon-award'],
                                'guitar_acoustic'       => ['label' => 'Guitare acoustique',     'icon' => 'icon-award'],
                                'bass'                  => ['label' => 'Basse',                  'icon' => 'icon-award'],
                                // Consoles
                                'console_ssl'           => ['label' => 'Console SSL',            'svg' => 'sliders'],
                                'console_neve'          => ['label' => 'Console Neve',           'svg' => 'sliders'],
                                'console_api'           => ['label' => 'Console API',            'svg' => 'sliders'],
                                // DAW
                                'daw_protools'          => ['label' => 'Pro Tools',              'icon' => 'icon-plans'],
                                'daw_logic'             => ['label' => 'Logic Pro',              'icon' => 'icon-plans'],
                                'daw_ableton'           => ['label' => 'Ableton Live',           'icon' => 'icon-plans'],
                                'daw_studio_one'        => ['label' => 'Studio One',             'icon' => 'icon-plans'],
                                // Monitors
                                'monitor_genelec'       => ['label' => 'Monitors Genelec',       'svg' => 'speaker'],
                                'monitor_yamaha'        => ['label' => 'Monitors Yamaha HS',     'svg' => 'speaker'],
                                'monitor_adam'          => ['label' => 'Monitors ADAM',          'svg' => 'speaker'],
                                'monitor_focal'         => ['label' => 'Monitors Focal',         'svg' => 'speaker'],
                                'subwoofer'             => ['label' => 'Caisson de basses',      'svg' => 'speaker'],
                                // Headphones
                                'headphones_dj'         => ['label' => "Casques d'écoute",       'svg' => 'headphones'],
                                // Hardware FX
                                'compressor_hardware'   => ['label' => 'Compresseur hardware',   'icon' => 'icon-transmission'],
                                'eq_hardware'           => ['label' => 'Égaliseur hardware',     'icon' => 'icon-transmission'],
                                'reverb_hardware'       => ['label' => 'Reverb hardware',        'icon' => 'icon-transmission'],
                                'patchbay'              => ['label' => 'Patchbay',               'icon' => 'icon-nearby'],
                                // Plugins
                                'plugin_bundle'         => ['label' => 'Bundle plugins',         'icon' => 'icon-bell-ring'],
                                // Facility
                                'booth'                 => ['label' => 'Cabine vocale',          'icon' => 'icon-home'],
                                'lounge'                => ['label' => 'Salon lounge',           'icon' => 'icon-living-room'],
                                'parking'               => ['label' => 'Parking',                'icon' => 'icon-parking'],
                                'wifi'                  => ['label' => 'Wi-Fi haut débit',       'icon' => 'icon-wifi'],
                                'air_conditioning'      => ['label' => 'Climatisation',          'icon' => 'icon-day-night'],
                                'accessible'            => ['label' => 'Accessible PMR',         'icon' => 'icon-pedestrian'],
                                'kitchen'               => ['label' => 'Cuisine disponible',     'icon' => 'icon-kitchen'],
                            ];
                            $studioEquipment = $studio->equipment ?? [];
                            @endphp

                            @if(!empty($studioEquipment))
                            <h3 class="text-22 fw-500 pt-40 border-top-light">Matériel disponible</h3>
                            <div class="row x-gap-0 y-gap-15 pt-20">
                                @foreach($studioEquipment as $equipKey)
                                    @if(isset($allEquipment[$equipKey]))
                                    @php $eq = $allEquipment[$equipKey]; @endphp
                                    <div class="col-md-6 col-lg-4">
                                        <div class="d-flex items-center x-gap-10">
                                            <div class="flex-center size-30 rounded-4 bg-blue-1-05">
                                                @if(isset($eq['icon']))
                                                    <i class="{{ $eq['icon'] }} text-14 text-blue-1"></i>
                                                @elseif(isset($eq['svg']))
                                                    @php $svgType = $eq['svg']; @endphp
                                                    @if($svgType === true || $svgType === 'mic')
                                                        {{-- Microphone SVG --}}
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#3554d1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2a3 3 0 0 1 3 3v7a3 3 0 0 1-6 0V5a3 3 0 0 1 3-3z"/><path d="M19 10v2a7 7 0 0 1-14 0v-2"/><line x1="12" x2="12" y1="19" y2="22"/></svg>
                                                    @elseif($svgType === 'headphones')
                                                        {{-- Headphones SVG --}}
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#3554d1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M3 18v-6a9 9 0 0 1 18 0v6"/><path d="M21 19a2 2 0 0 1-2 2h-1a2 2 0 0 1-2-2v-3a2 2 0 0 1 2-2h3z"/><path d="M3 19a2 2 0 0 0 2 2h1a2 2 0 0 0 2-2v-3a2 2 0 0 0-2-2H3z"/></svg>
                                                    @elseif($svgType === 'speaker')
                                                        {{-- Speaker / Monitor SVG --}}
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#3554d1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="4" y="2" width="16" height="20" rx="2"/><circle cx="12" cy="14" r="4"/><line x1="12" x2="12.01" y1="6" y2="6"/></svg>
                                                    @elseif($svgType === 'sliders')
                                                        {{-- Mixing Console / Sliders SVG --}}
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#3554d1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="4" x2="4" y1="21" y2="14"/><line x1="4" x2="4" y1="10" y2="3"/><line x1="12" x2="12" y1="21" y2="12"/><line x1="12" x2="12" y1="8" y2="3"/><line x1="20" x2="20" y1="21" y2="16"/><line x1="20" x2="20" y1="12" y2="3"/><line x1="1" x2="7" y1="14" y2="14"/><line x1="9" x2="15" y1="8" y2="8"/><line x1="17" x2="23" y1="16" y2="16"/></svg>
                                                    @endif
                                                @endif
                                            </div>
                                            <div class="text-14 text-dark-1">{{ $eq['label'] }}</div>
                                        </div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            @endif

                            @if($studio->other_equipment)
                                <h3 class="text-22 fw-500 pt-40 border-top-light">Autres équipements & Fiche technique</h3>
                                <div class="text-15 text-dark-1 mt-20 lh-16" style="white-space: pre-line;">
                                    {{ $studio->other_equipment }}
                                </div>
                            @endif
                            
                            {{-- Section Avis Clients --}}
                            @if($studio->reviews_count > 0)
                                <div class="mt-40 pt-40 border-top-light">
                                    <div class="row y-gap-20 justify-between items-end">
                                        <div class="col-auto">
                                            <h3 class="text-22 fw-500">Avis clients</h3>
                                            <div class="d-flex items-center mt-5">
                                                <div class="icon-star text-10 text-yellow-1 mr-5"></div>
                                                <div class="text-15 fw-500">{{ $studio->average_rating }} / 5</div>
                                                <div class="text-14 text-light-1 ml-5">({{ $studio->reviews_count }} avis)</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row y-gap-30 pt-30">
                                        @foreach($studio->reviews as $review)
                                            <div class="col-12">
                                                <div class="row x-gap-20 y-gap-20 items-center">
                                                    <div class="col-auto">
                                                        <div class="size-60 rounded-full bg-blue-1 flex-center text-white text-18 fw-500">
                                                            {{ substr($review->user->first_name ?? $review->user->name ?? 'A', 0, 1) }}
                                                        </div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="text-15 fw-500 lh-15">{{ $review->user->first_name ?? $review->user->name ?? 'Utilisateur' }}</div>
                                                        <div class="text-14 text-light-1 lh-15">{{ \Carbon\Carbon::parse($review->updated_at)->locale('fr')->isoFormat('MMMM YYYY') }}</div>
                                                    </div>
                                                </div>
                                                <div class="d-flex x-gap-2 mt-15">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <div class="icon-star text-10 {{ $i <= $review->rating ? 'text-yellow-1' : 'text-light-3' }}"></div>
                                                    @endfor
                                                </div>
                                                @if($review->comment)
                                                    <p class="text-15 text-dark-1 mt-10">{{ $review->comment }}</p>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>

                <div class="col-xl-4">
                    <div class="ml-50 lg:ml-0">
                        <div class="px-30 py-30 border-light rounded-4 shadow-4 bg-white">
                            <!-- En-tête avec le prix total -->
                            <div class="d-flex items-center justify-between border-bottom pb-20 mb-20">
                                <div class="text-16 text-dark-1">
                                    Total pour la réservation :
                                </div>
                                <div class="text-22 fw-600 text-blue-1" data-price>
                                    {{ $studio->hourly_rate * $studio->min_hours }} €
                                </div>
                            </div>

                            <!-- Formulaire de réservation -->
                            <form action="{{ route('reservation.store') }}" method="POST" id="reservationForm" class="js-ajax-form"
                                  data-studio-id="{{ $studio->uuid }}"
                                  data-min-hours="{{ $studio->min_hours }}"
                                  data-hourly-rate="{{ $studio->hourly_rate }}">
                                @csrf
                                <input type="hidden" name="studio_id" value="{{ $studio->id }}">
                                <input type="hidden" name="number_of_hours" id="hidden_number_of_hours" value="{{ $studio->min_hours }}" required>
                                <input type="hidden" name="total_price" id="total_price" value="">

                                <!-- Section Date -->
                                    <label for="date" class="d-flex items-center text-15 fw-500 mb-10 text-dark-1">
                                        <div class="flex-center size-32 rounded-4 bg-blue-1 mr-10">
                                            <i class="icon-calendar text-14 text-white"></i>
                                        </div>
                                        Date de réservation
                                    </label>
                                    <div class="relative">
                                        <input type="date" id="date" name="date"
                                               class="form-control h-50 px-20 border-light rounded-4 focus:border-blue-1"
                                               required
                                               min="{{ date('Y-m-d') }}">
                                    </div>

                                <!-- Section Nombre d'heures -->
                                    <div class="searchMenu-guests px-20 py-15 border-light rounded-4 js-form-dd js-form-counters bg-white shadow-sm hover:shadow-md transition-shadow">
                                        <div data-x-dd-click="searchMenu-guests" class="cursor-pointer">
                                            <div class="d-flex items-center mb-5">
                                                <div class="flex-center size-32 rounded-4 bg-blue-1 mr-10">
                                                    <i class="icon-clock text-14 text-white"></i>
                                                </div>
                                                <h4 class="text-15 fw-500 ls-2 lh-16 text-dark-1">
                                                    Nombre d'heures (minimum {{ $studio->min_hours }}h)
                                                </h4>
                                            </div>
                                            <div class="text-15 text-dark-1 ls-2 lh-16 flex items-center mt-5">
                                                <span class="js-count-adult fw-600">{{ $studio->min_hours }}</span>
                                                <span class="ml-5">Heures</span> <!-- Petit espace de 5px -->
                                            </div>
                                        </div>

                                        <div class="searchMenu-guests__field" data-x-dd="searchMenu-guests" data-x-dd-toggle="-is-active">
                                            <div class="bg-white px-20 py-20 rounded-4 border-light border-1 mt-10">
                                                <div class="row y-gap-10 justify-between items-center">
                                                    <div class="col-auto">
                                                        <div class="text-15 fw-500 text-dark-1">Durée de réservation</div>
                                                    </div>
                                                    <div class="col-auto">
                                                        <div class="d-flex items-center js-counter gap-8">
                                                            <button class="button -outline-blue-1 text-blue-1 size-38 rounded-4 js-down hover:bg-blue-1 hover:text-white transition mr-10"
                                                                    type="button"
                                                                    aria-label="Réduire le nombre d'heures">
                                                                <i class="icon-minus text-12"></i>
                                                            </button>

                                                            <span class="text-16 fw-600 js-count-adult mx-15 min-w-20 text-center mr-10">{{ $studio->min_hours }}</span>

                                                            <button class="button -outline-blue-1 text-blue-1 size-38 rounded-4 js-up hover:bg-blue-1 hover:text-white transition"
                                                                    type="button"
                                                                    aria-label="Augmenter le nombre d'heures">
                                                                <i class="icon-plus text-12"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="text-12 text-light-1 mt-10 text-center">
                                                    Minimum {{ $studio->min_hours }} heures requises
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Section Créneaux horaires -->
                                <div class="form-group mb-30">
                                    <label class="d-flex items-center text-15 fw-500 mb-10 text-dark-1">
                                        <div class="flex-center size-32 rounded-4 bg-blue-1 mr-10">
                                            <i class="icon-time text-14 text-white"></i>
                                        </div>
                                        Créneau horaire :
                                    </label>
                                    <div class="relative">
                                        <select name="time_slot" id="time_slot"
                                                class="form-control h-50 px-20 border-light rounded-4 focus:border-blue-1 appearance-none"
                                                required>
                                            @if(!empty($timeSlots) && is_array($timeSlots))
                                                @foreach($timeSlots as $slot)
                                                    <option value="{{ $slot }}">{{ $slot }}</option>
                                                @endforeach
                                            @else
                                                <option disabled selected>Aucun créneau disponible</option>
                                            @endif
                                        </select>
                                        <i class="icon-arrow-down text-14 absolute right-20 top-15 text-light-1"></i>
                                    </div>
                                </div>

                                <!-- Messages d'erreur/succès -->
                                @if($errors->any())
                                    <div class="alert bg-red-1 text-white p-15 rounded-4 mb-20">
                                        <ul class="list-disc pl-20">
                                            @foreach($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                @if(session('error'))
                                    <div class="alert bg-red-1 text-white p-15 rounded-4 mb-20">
                                        {{ session('error') }}
                                    </div>
                                @endif

                                @if(session('success'))
                                    <div class="alert bg-green-1 text-white p-15 rounded-4 mb-20">
                                        {{ session('success') }}
                                    </div>
                                @endif
                                @php
                                    $owner = $studio->proprietaire;
                                    $stripeReady = !empty($owner->stripe_account_id);
                                    $isStudio = auth()->check() && auth()->user()->profile === 'studio';
                                @endphp

                                @if(!$stripeReady)
                                    <div class="bg-yellow-1-05 border-yellow-1 rounded-4 p-20 mb-10">
                                        <div class="d-flex x-gap-15 y-gap-10 items-center">
                                            <div class="flex-center size-40 rounded-full bg-yellow-1">
                                                <i class="icon-notification text-16 text-white"></i>
                                            </div>
                                            <div class="text-14 fw-500 text-yellow-2">
                                                Ce studio finalise sa configuration bancaire. Les réservations seront bientôt disponibles.
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="button px-35 h-60 col-12 bg-light-2 text-light-1 cursor-not-allowed" style="border-radius: 8px;" disabled>
                                        <span>Bientôt disponible</span>
                                        <i class="icon-lock text-16 ml-10"></i>
                                    </button>
                                @else
                                    <!-- Bouton de réservation -->
                                    <button type="submit" id="reserveButton"
                                            class="button px-35 h-60 col-12 transition-all fw-500 flex items-center justify-center
                                            {{ $isStudio ? 'bg-gray-800 text-gray-900 cursor-not-allowed' : 'bg-blue-1 text-white hover:bg-blue-2' }}"
                                            style="margin-top: 10px; border-radius: 8px;"
                                            {{ $isStudio ? 'disabled' : '' }}
                                            @if($isStudio) data-tooltip="Vous ne pouvez pas réserver connecté en tant que studio" @endif>
                                        <span>Réserver maintenant</span>
                                        <i class="icon-arrow-right text-16 ml-10"></i>
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@push('scripts')
<script>
(function () {
  'use strict';
  document.addEventListener('DOMContentLoaded', function () {
    console.log("=== LOGIQUE RESERVATION COMPLETE START ===");
    
    var container = document.getElementById('reservationForm');
    if (!container) return;

    var config = {
      studioId: container.getAttribute('data-studio-id'),
      minHours: parseInt(container.getAttribute('data-min-hours')),
      hourlyRate: parseFloat(container.getAttribute('data-hourly-rate'))
    };

    var decreaseBtn = container.querySelector('.js-down');
    var increaseBtn = container.querySelector('.js-up');
    var hourDisplays = container.querySelectorAll('.js-count-adult');
    var dateInput = document.getElementById('date');
    var hoursInput = document.getElementById('hidden_number_of_hours');
    var totalPriceInput = document.getElementById('total_price');
    var priceDisplay = document.querySelector('[data-price]');
    var timeSlotSelect = document.getElementById('time_slot');
    var selectedHours = config.minHours;

    var updateDisplay = function () {
      hourDisplays.forEach(function (d) { d.textContent = selectedHours; });
      if (hoursInput) hoursInput.value = selectedHours;
      var total = selectedHours * config.hourlyRate;
      if (totalPriceInput) totalPriceInput.value = total.toFixed(2);
      if (priceDisplay) priceDisplay.textContent = total.toFixed(2) + '€';
      if (decreaseBtn) decreaseBtn.disabled = selectedHours <= config.minHours;
    };

    var handleDateChange = function () {
      if (!dateInput) return;
      var date = dateInput.value;
      if (!date) return;

      if (timeSlotSelect) {
        timeSlotSelect.innerHTML = '<option disabled selected>Chargement...</option>';
        fetch("/studios/" + config.studioId + "/creneaux?date=" + date)
          .then(function (res) { return res.json(); })
          .then(function (slots) {
            timeSlotSelect.innerHTML = '';
            if (slots && slots.length > 0) {
              slots.forEach(function (s) {
                var opt = document.createElement('option');
                opt.value = s; opt.textContent = s;
                timeSlotSelect.appendChild(opt);
              });
            } else {
              timeSlotSelect.innerHTML = '<option disabled selected>Aucun créneau disponible</option>';
            }
          });
      }
    };

    if (dateInput) {
      dateInput.addEventListener('change', handleDateChange);
      if (dateInput.value) {
        handleDateChange();
      } else {
        var today = new Date().toISOString().split('T')[0];
        dateInput.value = today;
        handleDateChange();
      }
    }

    if (decreaseBtn) {
      decreaseBtn.addEventListener('click', function () {
        if (selectedHours > config.minHours) { selectedHours--; updateDisplay(); }
      });
    }
    if (increaseBtn) {
      increaseBtn.addEventListener('click', function () {
        selectedHours++; updateDisplay();
      });
    }

    container.addEventListener('submit', function() {
        console.log("Envoi du formulaire avec time_slot:", timeSlotSelect.value);
    });

    updateDisplay();
  });
})();
</script>
@endpush
@endsection
