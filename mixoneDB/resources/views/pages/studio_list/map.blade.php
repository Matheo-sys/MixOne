{{-- ============================================================
     CARTE INTERACTIVE — Leaflet.js + OpenStreetMap (100% gratuit)
     ============================================================ --}}

@php
$studioBaseUrl = url('/studios');
$studiosForMap = isset($map_studios) ? $map_studios : $studios;
$studioMapData = $studiosForMap->map(function($s) use ($studioBaseUrl) {
    return [
        'id'        => $s->id,
        'name'      => $s->name,
        'city'      => $s->city,
        'address'   => $s->address,
        'price'     => (float) $s->hourly_rate,
        'lat'       => (float) $s->latitude,
        'lng'       => (float) $s->longitude,
        'image'     => $s->image1 ? \Illuminate\Support\Facades\Storage::url($s->image1) : asset('media/img/backgrounds/11.jpg'),
        'url'       => route('studios.show', $s->slug),
        'equipment' => $s->equipment ?? [],
    ];
});
@endphp

{{-- Modal plein écran --}}
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.css" />
<link rel="stylesheet" href="https://unpkg.com/leaflet.markercluster@1.5.3/dist/MarkerCluster.Default.css" />

<div id="mapFilter"
     style="
        position: fixed;
        top: 0; left: 0;
        width: 100%; height: 100%;
        z-index: 9000;
        display: none;
        align-items: center;
        justify-content: center;
     ">

    {{-- Fond flou — clic pour fermer --}}
    <div id="mapOverlay"
         style="
            position: absolute; inset: 0;
            background: rgba(5,16,54,.55);
            backdrop-filter: blur(3px);
         ">
    </div>

    {{-- Panneau carte --}}
    <div style="
            position: relative;
            width: min(96vw, 1380px);
            height: min(92vh, 860px);
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 32px 80px rgba(0,0,0,.5);
            display: flex;
            flex-direction: column;
         ">

        {{-- En-tête --}}
        <div style="
                background: #fff;
                padding: 14px 22px;
                display: flex;
                align-items: center;
                justify-content: space-between;
                border-bottom: 1px solid #e5e7eb;
                flex-shrink: 0;
             ">
            <div style="display:flex; align-items:center; gap:12px;">
                <span style="font-size:20px;">🗺️</span>
                <span style="font-size:17px; font-weight:600; color:#051036;">Studios sur la carte</span>
                <span style="
                        background: #eef2ff;
                        color: #3554d1;
                        font-size: 13px;
                        font-weight: 600;
                        padding: 3px 10px;
                        border-radius: 20px;
                    ">{{ count($studiosForMap) }}</span>
            </div>
            <button id="closeMapBtn" type="button"
                    style="
                        width:36px; height:36px;
                        border-radius:50%;
                        border:1px solid #e5e7eb;
                        background:#fff;
                        cursor:pointer;
                        font-size:16px;
                        color:#555;
                        display:flex; align-items:center; justify-content:center;
                    ">✕</button>
        </div>

        {{-- Carte Leaflet --}}
        <div id="studios-map" 
             data-studios="{{ json_encode($studioMapData) }}"
             data-default-img="{{ asset('media/img/backgrounds/11.jpg') }}"
             style="flex:1; width:100%; z-index:1;"></div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('js/pages/studio_list/map.js') }}"></script>

<style>
.studio-popup .leaflet-popup-content-wrapper { padding:0; border-radius:10px; overflow:hidden; box-shadow:0 8px 32px rgba(0,0,0,.18); }
.studio-popup .leaflet-popup-content { margin:0; width:auto !important; }
.studio-popup .leaflet-popup-tip { background:#fff; }
</style>
@endpush
