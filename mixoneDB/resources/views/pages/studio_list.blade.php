@extends('layouts.backend')

@section('title', 'Liste des Studios de Musique | MixOne')
@section('meta_description', 'Explorez notre sélection de studios de musique professionnels. Filtrez par équipement, prix et localisation pour trouver l\'espace de création parfait.')

@section('structured_data')
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "ItemList",
  "name": "Studios de musique sur MixOne",
  "description": "Liste des studios de musique professionnels disponibles à la réservation sur MixOne.",
  "numberOfItems": {{ $studios->total() ?? 0 }},
  "itemListElement": [
    @foreach($studios->take(10) as $index => $studio)
    {
      "@type": "ListItem",
      "position": {{ $index + 1 }},
      "url": "{{ route('studios.show', $studio->uuid) }}",
      "name": "{{ e($studio->name) }}"
    }@if(!$loop->last),@endif
    @endforeach
  ]
}
</script>
@endsection

@section('content')

    @include('pages.studio_list.ourStudios')

    @include('pages.studio_list.map')

    @include('pages.home.newsletter')

@endsection
