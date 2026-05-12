@extends('layouts.backend')

@section('title', 'Devenez Partenaire MixOne | Inscrivez votre Studio de Musique')
@section('meta_description', 'Inscrivez votre studio de musique sur MixOne, la première plateforme de réservation en France. Augmentez votre visibilité et simplifiez vos réservations dès aujourd\'hui.')

@section('content')
    @include('pages.becomeExpert.homeExpert')

    @include('pages.becomeExpert.infosExpert')

    @include('pages.becomeExpert.whyExpert')

    @include('pages.becomeExpert.faq')

    @include('pages.home.newsletter')
@endsection
