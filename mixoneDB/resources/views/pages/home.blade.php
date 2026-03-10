@php
    $whiteHeader = false;
    $isHome = true;
@endphp
@extends('layouts.backend')

@section('title', 'MixOne | Trouvez et Réservez votre Studio d\'Enregistrement')
@section('meta_description', 'Découvrez les meilleurs studios de musique à Paris et partout en France. Réservez votre session d\'enregistrement, de mixage ou de mastering en quelques clics.')

@section('content')
    @include('pages.home.search')

    @include('pages.home.studios')

    @include('pages.home.infos')
    @include('pages.home.rating')
    @include('pages.home.newsletter')
@endsection
