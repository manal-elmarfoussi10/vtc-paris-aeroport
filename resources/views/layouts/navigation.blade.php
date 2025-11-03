{{-- File: resources/views/layouts/navigation.blade.php --}}

@php
    // Check if the current route is the home page
    $is_home = Route::currentRouteName() === 'home';

    if ($is_home) {
        // Home page header integrated into hero background
        $nav_bg_class = 'bg-transparent absolute top-0 left-0 w-full z-50';
        $nav_text_class = 'text-white text-lg font-medium';
        $logo_is_dark = true; // Use dark logo on dark background
    } else {
        // Other pages with white background
        $nav_bg_class = 'bg-white shadow-lg fixed top-0 left-0 w-full z-50 border-b border-gray-100';
        $nav_text_class = 'text-gray-800';
        $logo_is_dark = false; // Use light logo on white background
    }
@endphp

<nav x-data="{ open: false }" class="{{ $nav_bg_class }} transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-28">
            <div class="flex-shrink-0">
                {{-- Much larger, prominent logo --}}
                @include('components.application-logo', ['is_dark' => $logo_is_dark, 'class' => 'h-20 w-auto'])
            </div>

            <div class="flex-1 flex justify-center">
                <div class="hidden space-x-10 sm:flex {{ $nav_text_class }}">
                    {{-- Accueil --}}
                    <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')" class="text-gray-700 hover:text-blue-primary transition-colors duration-200 font-semibold text-lg px-3 py-2 rounded-lg hover:bg-blue-50">
                        {{ __('Accueil') }}
                    </x-nav-link>

                    {{-- Réserver --}}
                    <x-nav-link href="{{ route('booking') }}" :active="request()->routeIs('booking*')" class="text-gray-700 hover:text-blue-primary transition-colors duration-200 font-semibold text-lg px-3 py-2 rounded-lg hover:bg-blue-50">
                        {{ __('Réserver') }}
                    </x-nav-link>

                    {{-- Services --}}
                    <x-nav-link href="{{ route('services.index') }}" :active="request()->routeIs('services.index')" class="text-gray-700 hover:text-blue-primary transition-colors duration-200 font-semibold text-lg px-3 py-2 rounded-lg hover:bg-blue-50">
                        {{ __('Services') }}
                    </x-nav-link>

                    {{-- Aéroports --}}
                    <x-nav-link href="{{ route('airports.index') }}" :active="request()->routeIs('airports*')" class="text-gray-700 hover:text-blue-primary transition-colors duration-200 font-semibold text-lg px-3 py-2 rounded-lg hover:bg-blue-50">
                        {{ __('Aéroports') }}
                    </x-nav-link>

                    {{-- FAQ --}}
                    <x-nav-link href="{{ route('faq') }}" :active="request()->routeIs('faq')" class="text-gray-700 hover:text-blue-primary transition-colors duration-200 font-semibold text-lg px-3 py-2 rounded-lg hover:bg-blue-50">
                        {{ __('FAQ') }}
                    </x-nav-link>

                    {{-- Contact --}}
                    <x-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')" class="text-gray-700 hover:text-blue-primary transition-colors duration-200 font-semibold text-lg px-3 py-2 rounded-lg hover:bg-blue-50">
                        {{ __('Contact') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                {{-- Booking Button (Always prominent) --}}
                <a href="{{ route('booking') }}" class="px-6 py-3 border border-blue-primary text-sm font-semibold rounded-full text-white bg-blue-primary hover:bg-blue-700 hover:shadow-lg transform hover:scale-105 transition-all duration-300 mr-6 shadow-md">
                    Calculer mon tarif
                </a>

                {{-- Contact Us Button --}}
                <a href="{{ route('contact') }}" class="inline-flex items-center px-4 py-2 border border-gray-200 text-sm leading-4 font-medium rounded-lg {{ $nav_text_class }} bg-gray-50 hover:bg-gray-100 hover:border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all duration-200 shadow-sm">
                    <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    Nous contacter
                </a>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-3 rounded-lg text-gray-600 hover:text-blue-primary hover:bg-blue-50 focus:outline-none focus:bg-blue-50 focus:text-blue-primary transition-all duration-200 border border-gray-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white shadow-2xl border-t border-gray-100 absolute w-full pb-4">
        <div class="pt-4 pb-4 space-y-2 px-4">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-gray-700 hover:text-blue-primary hover:bg-blue-50 transition-colors duration-200">
                {{ __('Accueil') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('booking')" :active="request()->routeIs('booking')" class="text-gray-700 hover:text-blue-primary hover:bg-blue-50 transition-colors duration-200">
                {{ __('Réserver') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('services.index')" :active="request()->routeIs('services.index')" class="text-gray-700 hover:text-blue-primary hover:bg-blue-50 transition-colors duration-200">
                {{ __('Services') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('airports.index')" :active="request()->routeIs('airports.index')" class="text-gray-700 hover:text-blue-primary hover:bg-blue-50 transition-colors duration-200">
                {{ __('Aéroports') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('faq')" :active="request()->routeIs('faq')" class="text-gray-700 hover:text-blue-primary hover:bg-blue-50 transition-colors duration-200">
                {{ __('FAQ') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="text-gray-700 hover:text-blue-primary hover:bg-blue-50 transition-colors duration-200">
                {{ __('Contact') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-3 border-t border-gray-200 bg-gray-50">
            <div class="mt-2 space-y-1 px-4">
                <x-responsive-nav-link :href="route('contact')" class="text-gray-700 hover:text-blue-primary hover:bg-blue-50 transition-colors duration-200">
                    {{ __('Nous contacter') }}
                </x-responsive-nav-link>
            </div>
        </div>
    </div>
</nav>