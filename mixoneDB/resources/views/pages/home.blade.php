@php
    $enTeteBlanc = false;
    $isHome = true;
@endphp
@extends('layouts.backend')

@section('title', 'MixOne | Trouvez et Réservez votre Studio d\'Enregistrement')
@section('meta_description', 'Découvrez les meilleurs studios de musique à Paris et partout en France. Réservez votre session d\'enregistrement, de mixage ou de mastering en quelques clics.')

@section('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "MixOne",
  "url": "https://www.mixone.fr",
  "logo": "{{ secure_asset('media/img/general/og-image-v4.png') }}",
  "description": "MixOne est la plateforme leader pour trouver et réserver des studios d'enregistrement, de mixage et de mastering en France.",
  "sameAs": [],
  "contactPoint": {
    "@type": "ContactPoint",
    "contactType": "customer service",
    "email": "contact@mixone.fr",
    "availableLanguage": "French"
  }
}
</script>
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "WebSite",
  "name": "MixOne",
  "url": "https://www.mixone.fr",
  "potentialAction": {
    "@type": "SearchAction",
    "target": {
      "@type": "EntryPoint",
      "urlTemplate": "https://www.mixone.fr/studios/rechercher?ville={search_term_string}"
    },
    "query-input": "required name=search_term_string"
  }
}
</script>
@endsection
@section('content')
    @include('pages.home.search')

    @include('pages.home.studios')

    @include('pages.home.infos')
    @include('pages.home.rating')
    @include('pages.home.newsletter')
@endsection
