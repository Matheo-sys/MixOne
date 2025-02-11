@extends('layouts.backend')

@section('content')
    @include('about.aboutBanner')

    @include('about.aboutInfos')

    @include('about.aboutText')

    @include('about.aboutStats')

    @include('about.aboutOurTeam')

    @include('about.aboutNotice')

    @include('home.newsletter')
@endsection
