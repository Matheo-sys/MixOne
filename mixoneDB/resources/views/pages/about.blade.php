@extends('layouts.backend')

@section('content')
    @include('pages.about.aboutBanner')

    @include('pages.about.aboutInfos')

    @include('pages.about.aboutText')

    @include('pages.about.aboutStats')

    @include('pages.about.aboutOurTeam')

    @include('pages.about.aboutNotice')

    @include('pages.home.newsletter')
@endsection
