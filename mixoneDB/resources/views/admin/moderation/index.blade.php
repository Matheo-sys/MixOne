@extends('layouts.admin')

@section('title', 'Modération des Images')

@section('content')
<div class="row y-gap-20 justify-between items-end pb-30">
    <div class="col-auto">
        <h1 class="text-30 lh-14 fw-600">Modération des Images</h1>
        <div class="text-15 text-light-1">Approuvez ou refusez les changements d'images des studios.</div>
    </div>
</div>

<div class="row y-gap-30">
    @forelse($requests as $request)
        <div class="col-12">
            <div class="py-30 px-30 rounded-4 bg-white shadow-3">
                <div class="row y-gap-20 justify-between items-center border-bottom-light pb-20 mb-20">
                    <div class="col-auto">
                        <h3 class="text-18 fw-500">Studio : {{ $request->studio->name }}</h3>
                        <div class="text-14 text-light-1">Propriétaire : {{ $request->studio->proprietaire->first_name }} {{ $request->studio->proprietaire->last_name }} ({{ $request->studio->proprietaire->email }})</div>
                    </div>
                    <div class="col-auto">
                        <div class="d-flex x-gap-10">
                            <form action="{{ route('admin.moderation.approve', $request) }}" method="POST">
                                @csrf
                                <button type="submit" class="button -md h-40 bg-blue-1 text-white px-20 rounded-4">Approuver tout</button>
                            </form>
                            <button type="button" class="button -md h-40 bg-red-1 text-white px-20 rounded-4" onclick="document.getElementById('reject-form-{{ $request->id }}').style.display = 'block'">Refuser</button>
                        </div>
                    </div>
                </div>

                <div class="row x-gap-20 y-gap-20">
                    @foreach(['image1', 'image2', 'image3', 'image4', 'image5'] as $imgKey)
                        @if($request->$imgKey)
                            <div class="col-xl-2 col-lg-3 col-md-4 col-6">
                                <div class="text-14 fw-500 mb-5">Nouvelle {{ ucfirst($imgKey) }}</div>
                                <div class="ratio ratio-1:1">
                                    <img src="{{ storage_url($request->$imgKey) }}" alt="Nouvelle image" class="img-ratio rounded-4 border-light">
                                </div>
                                <div class="mt-10 text-center">
                                    <div class="text-12 text-light-1">Actuelle :</div>
                                    <div class="ratio ratio-1:1 mt-5" style="max-width: 60px; margin: 0 auto;">
                                        <img src="{{ $request->studio->$imgKey ? storage_url($request->studio->$imgKey) : asset('media/img/misc/avatar-default.png') }}" class="img-ratio rounded-4">
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>

                <div id="reject-form-{{ $request->id }}" class="mt-30 pt-20 border-top-light" style="display: none;">
                    <form action="{{ route('admin.moderation.reject', $request) }}" method="POST">
                        @csrf
                        <div class="form-input">
                            <textarea name="admin_comment" rows="3" placeholder="Motif du refus (sera visible par le studio)" required></textarea>
                            <label class="lh-1 text-14 text-light-1">Motif du refus</label>
                        </div>
                        <div class="d-flex x-gap-10 mt-15">
                            <button type="submit" class="button -sm bg-red-1 text-white px-20 py-10 rounded-4">Confirmer le refus</button>
                            <button type="button" class="button -sm bg-light-2 text-dark-1 px-20 py-10 rounded-4" onclick="document.getElementById('reject-form-{{ $request->id }}').style.display = 'none'">Annuler</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="py-50 px-30 rounded-4 bg-white shadow-3 text-center">
                <i class="icon-check text-40 text-blue-1 mb-20"></i>
                <h3 class="text-20 fw-500">Toutes les images sont à jour !</h3>
                <p class="text-light-1 mt-10">Aucune demande de modération en attente.</p>
            </div>
        </div>
    @endforelse
</div>
@endsection

<style>
    .img-ratio {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
