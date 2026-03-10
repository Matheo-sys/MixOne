@php
    $whiteHeader = false;
    $isHome = true;
@endphp
@extends('layouts.backend')

@section('content')
    @include('pages.home.search')

    @include('pages.home.studios')

    @include('pages.home.infos')
    @include('pages.home.rating')
    @include('pages.home.newsletter')
@endsection
