@extends('layouts.admin')

@section('title', 'Détails Utilisateur - ' . $user->first_name . ' ' . $user->last_name)

@section('content')
<div class="row y-gap-20 justify-between items-end pb-30">
    <div class="col-auto">
        <h1 class="text-30 lh-14 fw-600">Détails de l'utilisateur</h1>
        <div class="text-15 text-light-1">Informations complètes et actions.</div>
    </div>
    <div class="col-auto">
        <a href="{{ route('admin.users.index') }}" class="button -md -light-1 text-dark-1">Retour à la liste</a>
    </div>
</div>

<div class="row y-gap-30">
    <div class="col-xl-4 col-lg-5">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <div class="d-flex flex-column items-center text-center">
                <img src="{{ $user->avatar ? \Illuminate\Support\Facades\Storage::url($user->avatar) : asset('media/images/avatar-default.png') }}" alt="avatar" class="size-120 rounded-full object-cover mb-20">
                <h2 class="text-22 fw-500">{{ $user->first_name }} {{ $user->last_name }}</h2>
                <div class="text-15 text-light-1 mb-20">{{ $user->email }}</div>

                @if($user->profile == 'artist')
                    <span class="badge bg-blue-1-05 text-blue-1 px-15 py-5 text-14">Artiste</span>
                @else
                    <span class="badge bg-purple-1-05 text-purple-1 px-15 py-5 text-14">Studio</span>
                @endif

                <div class="mt-20 w-100">
                    @if($user->banned_at)
                        <div class="px-20 py-10 bg-red-1-05 text-red-1 rounded-4 fw-500 mb-20">
                            Banni le {{ $user->banned_at->format('d/m/Y à H:i') }}
                        </div>
                        <form action="{{ route('admin.users.unban', $user) }}" method="POST">
                            @csrf
                            <button type="submit" class="button -md -blue-1 text-white w-100">Débannir l'utilisateur</button>
                        </form>
                    @else
                        <div class="px-20 py-10 bg-green-1-05 text-green-1 rounded-4 fw-500 mb-20">
                            Compte Actif
                        </div>
                        <form action="{{ route('admin.users.ban', $user) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir bannir cet utilisateur ?');">
                            @csrf
                            <button type="submit" class="button -md -red-1 text-white w-100">Bannir l'utilisateur</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-8 col-lg-7">
        <div class="py-30 px-30 rounded-4 bg-white shadow-3">
            <h3 class="text-18 fw-500 mb-20">Informations Personnelles</h3>
            
            <div class="row y-gap-20">
                <div class="col-sm-6">
                    <div class="text-15 text-light-1">Téléphone</div>
                    <div class="text-15 fw-500">{{ $user->phone ?? 'Non renseigné' }}</div>
                </div>
                <div class="col-sm-6">
                    <div class="text-15 text-light-1">Date de naissance</div>
                    <div class="text-15 fw-500">{{ $user->birth_date ? \Carbon\Carbon::parse($user->birth_date)->format('d/m/Y') : 'Non renseignée' }}</div>
                </div>
                <div class="col-sm-6">
                    <div class="text-15 text-light-1">Date d'inscription</div>
                    <div class="text-15 fw-500">{{ $user->created_at->format('d/m/Y H:i') }}</div>
                </div>
                <div class="col-sm-6">
                    <div class="text-15 text-light-1">Email vérifié</div>
                    <div class="text-15 fw-500">
                        @if($user->email_verified_at)
                            <span class="text-green-1">Oui ({{ $user->email_verified_at->format('d/m/Y') }})</span>
                        @else
                            <span class="text-red-1">Non</span>
                        @endif
                    </div>
                </div>
                <div class="col-12">
                    <div class="text-15 text-light-1">Adresse</div>
                    <div class="text-15 fw-500">
                        {{ $user->address_line1 ?? '' }} {{ $user->address_line2 ?? '' }} <br>
                        {{ $user->zipcode ?? '' }} {{ $user->city ?? '' }}, {{ $user->state ?? '' }} <br>
                        {{ $user->country ?? 'Non renseignée' }}
                    </div>
                </div>
                <div class="col-12">
                    <div class="text-15 text-light-1">À propos</div>
                    <div class="text-15 fw-500">{{ $user->about ?? 'Non renseigné' }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
