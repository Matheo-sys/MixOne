@extends('layouts.backend')

@section('title', 'Liste des Studios de Musique | MixOne')
@section('meta_description', 'Explorez notre sélection de studios de musique professionnels. Filtrez par équipement, prix et localisation pour trouver l\'espace de création parfait.')

@section('content')

    @include('pages.studio_list.ourStudios')

    @include('pages.studio_list.map')

    @include('pages.home.newsletter')

@endsection
