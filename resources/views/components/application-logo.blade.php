{{--
    File: resources/views/components/application-logo.blade.php
    Description: VTC Paris Aéroport Logo component. Switches between dark and light versions
                 of the logo image based on the background context.
    File convention: 'logo-dark.png' for light backgrounds, 'logo-light.png' for dark backgrounds.
--}}
@props(['is_dark' => false])

@php
    // If $is_dark is true (dark background, like the navigation bar), use the light-colored logo
    $logoPath = $is_dark ? 'images/logo-light.png' : 'images/logo-dark.png';
    $altText = "Logo Réservation VTC Paris Aéroport - Chauffeur Privé";
@endphp

<a href="{{ route('home') }}" class="flex items-center" aria-label="Retour à l'accueil du site VTC Paris">
    <img src="{{ asset($logoPath) }}" 
         alt="{{ $altText }}" 
         class="h-10 w-auto" 
         loading="lazy">
</a>