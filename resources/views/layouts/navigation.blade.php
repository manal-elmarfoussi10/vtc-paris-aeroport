{{-- File: resources/views/layouts/navigation.blade.php --}}

@php
    // Check if the current route is the home page
    $is_home = Route::currentRouteName() === 'home';
    
    // Set classes based on whether it's the home page
    $nav_bg_class = $is_home ? 'bg-transparent absolute top-0 left-0 w-full z-30' : 'bg-dark-navy shadow fixed top-0 left-0 w-full z-30';
    $nav_text_class = $is_home ? 'text-white' : 'text-gray-200';
    $logo_is_dark = $is_home; // Use light logo version on dark/video background
@endphp

<nav x-data="{ open: false }" class="{{ $nav_bg_class }} transition duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    {{-- Passing is_dark and class props --}}
                    @include('components.application-logo', ['is_dark' => $logo_is_dark, 'class' => 'h-12 w-auto']) 
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex {{ $nav_text_class }}">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Accueil') }}
                    </x-nav-link>
                    <x-nav-link :href="route('booking')" :active="request()->routeIs('booking')">
                        {{ __('Réserver') }}
                    </x-nav-link>
                    <x-nav-link :href="route('services.index')" :active="request()->routeIs('services.index')">
                        {{ __('Services') }}
                    </x-nav-link>
                    <x-nav-link :href="route('airports.index')" :active="request()->routeIs('airports.index')">
                        {{ __('Aéroports') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                        {{ __('Contact') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                {{-- Booking Button (Always prominent) --}}
                <a href="{{ route('booking') }}" class="px-5 py-2 border border-blue-primary text-sm font-medium rounded-full text-white bg-blue-primary hover:bg-blue-700 transition duration-300 mr-4">
                    Calculer mon tarif
                </a>
                
                <div class="relative">
                    <x-dropdown align="right" width="48">
                        {{-- Dropdown Trigger (Authentication Links) --}}
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md {{ $nav_text_class }} bg-transparent hover:text-gray-300 focus:outline-none transition ease-in-out duration-150">
                                <div>@auth {{ Auth::user()->name }} @else Connexion / Compte @endauth</div>
                                <div class="ml-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        {{-- Dropdown Content --}}
                        <x-slot name="content">
                            @auth
                                {{-- Customer Dashboard Link (using defined route name) --}}
                                <x-dropdown-link :href="route('customer.dashboard')">
                                    {{ __('Tableau de bord') }}
                                </x-dropdown-link>

                                {{-- Profile Link (using defined route name) --}}
                                <x-dropdown-link :href="route('profile.edit')">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Déconnexion') }}
                                    </x-dropdown-link>
                                </form>
                            @else
                                {{-- Guest Links --}}
                                <x-dropdown-link :href="route('login')">
                                    {{ __('Connexion') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('register')">
                                    {{ __('Inscription') }}
                                </x-dropdown-link>
                            @endauth
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-dark-navy/95 backdrop-blur-sm shadow-xl absolute w-full pb-3">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Accueil') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('booking')" :active="request()->routeIs('booking')">
                {{ __('Réserver') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('services.index')" :active="request()->routeIs('services.index')">
                {{ __('Services') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('airports.index')" :active="request()->routeIs('airports.index')">
                {{ __('Aéroports') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                {{ __('Contact') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-200">
            @auth
                <div class="px-4">
                    <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    {{-- Customer Dashboard Link --}}
                    <x-responsive-nav-link :href="route('customer.dashboard')">
                        {{ __('Tableau de bord') }}
                    </x-responsive-nav-link>

                    {{-- Profile Link --}}
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('login')">
                        {{ __('Connexion') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')">
                        {{ __('Inscription') }}
                    </x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>