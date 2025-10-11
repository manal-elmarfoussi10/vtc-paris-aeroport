{{-- File: resources/views/components/application-logo.blade.php --}}
@props(['is_dark' => false, 'class' => 'h-10 w-auto']) {{-- Added default class --}}

@php
    // If $is_dark is true (dark background), use the light-colored logo
    $logoPath = $is_dark ? 'images/logo-light.png' : 'images/logo-dark.png';
    $altText = "Logo Réservation VTC Paris Aéroport - Chauffeur Privé";
@endphp

<a href="{{ route('home') }}" class="flex items-center" aria-label="Retour à l'accueil du site VTC Paris">
    <img src="{{ asset($logoPath) }}" 
         alt="{{ $altText }}" 
         class="{{ $class }}" {{-- Using the passed-in class --}}
         loading="lazy">
</a>