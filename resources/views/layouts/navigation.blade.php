{{--
    File: resources/views/layouts/navigation.blade.php
    Description: Modern, responsive navigation bar (Desktop & Mobile) for VTC Paris Aéroport.
                 Handles public links, Customer Portal, and Admin access using Laravel Auth.
    FIXES: Corrected 'Attempt to read property "name" on null' using @auth/@guest.
           Corrected route('profile.edit') to route('customer.profile.edit').
--}}
<nav x-data="{ open: false }" class="bg-dark-navy border-b border-gray-700 shadow-xl fixed w-full z-30 top-0">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <div class="flex-shrink-0 flex items-center">
                    {{-- Passing 'is_dark' prop for the light logo version on dark background --}}
                    @include('components.application-logo', ['is_dark' => true])
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex items-center">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-white hover:text-blue-primary transition duration-150">
                        {{ __('Accueil') }}
                    </x-nav-link>
                    <x-nav-link :href="route('booking')" :active="request()->routeIs('booking')" class="text-white hover:text-blue-primary transition duration-150">
                        {{ __('Réserver') }}
                    </x-nav-link>
                    <x-nav-link :href="route('services')" :active="request()->routeIs('services')" class="text-white hover:text-blue-primary transition duration-150">
                        {{ __('Services') }}
                    </x-nav-link>
                    <x-nav-link :href="route('airports')" :active="request()->routeIs('airports')" class="text-white hover:text-blue-primary transition duration-150">
                        {{ __('Aéroports') }}
                    </x-nav-link>
                    <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="text-white hover:text-blue-primary transition duration-150">
                        {{ __('Contact') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                
                {{-- CTA Button for Booking (High visibility) --}}
                <div class="mr-4">
                    <a href="{{ route('booking') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-xl text-white bg-blue-primary hover:bg-blue-700 transition duration-150 shadow-lg" aria-label="Bouton de réservation">
                        Calculer mon tarif
                    </a>
                </div>

                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center text-sm font-medium text-white hover:text-blue-primary focus:outline-none transition duration-150 ease-in-out" aria-label="Menu du compte utilisateur">
                            {{-- FIX: Conditional rendering for user name --}}
                            @auth
                                <div>{{ Auth::user()->name ?? 'Mon Compte' }}</div>
                            @else
                                <div>Connexion / Compte</div>
                            @endauth

                            <div class="ml-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        {{-- Logged In Links --}}
                        @auth
                            {{-- User Info (Header) --}}
                            <div class="px-4 py-3 border-b border-gray-100">
                                <div class="font-medium text-sm text-dark-navy">{{ Auth::user()->name ?? 'Utilisateur' }}</div>
                                <div class="font-medium text-xs text-gray-500">{{ Auth::user()->email }}</div>
                            </div>
                            
                            {{-- Admin Dashboard Link (Assuming 'is_admin' property exists on User model) --}}
                            @if(Auth::user()->is_admin)
                                <x-dropdown-link :href="route('admin.dashboard')" class="text-red-600 hover:bg-red-50 font-bold">
                                    {{ __('Admin Dashboard') }}
                                </x-dropdown-link>
                            @endif

                            {{-- Customer Portal Links --}}
                            <x-dropdown-link :href="route('customer.dashboard')">
                                {{ __('Tableau de Bord Client') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('customer.bookings')">
                                {{ __('Mes Réservations') }}
                            </x-dropdown-link>
                            {{-- FIX: Used fully qualified route name --}}
                            <x-dropdown-link :href="route('customer.profile.edit')">
                                {{ __('Modifier Profil') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}" class="border-t mt-1 pt-1">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                    {{ __('Déconnexion') }}
                                </x-dropdown-link>
                            </form>
                        @endauth
                        
                        {{-- Guest Links --}}
                        @guest
                            <x-dropdown-link :href="route('login')">
                                {{ __('Connexion') }}
                            </x-dropdown-link>
                            <x-dropdown-link :href="route('register')">
                                {{ __('Créer un Compte') }}
                            </x-dropdown-link>
                        @endguest
                    </x-slot>
                </x-dropdown>
            </div>

            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white transition duration-150 ease-in-out" aria-label="Menu mobile">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-dark-navy pb-3 border-t border-gray-700">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('booking')" :active="request()->routeIs('booking')" class="bg-blue-primary text-white font-bold hover:bg-blue-700">
                {{ __('Réserver Maintenant') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-gray-300 hover:text-white">
                {{ __('Accueil') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('services')" :active="request()->routeIs('services')" class="text-gray-300 hover:text-white">
                {{ __('Nos Services') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('airports')" :active="request()->routeIs('airports')" class="text-gray-300 hover:text-white">
                {{ __('Aéroports & Gares') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="text-gray-300 hover:text-white">
                {{ __('Contact') }}
            </x-responsive-nav-link>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-700">
            @auth
                {{-- FIX: Conditional rendering for user name and email --}}
                <div class="px-4">
                    <div class="font-medium text-base text-white">{{ Auth::user()->name ?? 'Utilisateur' }}</div>
                    <div class="font-medium text-sm text-gray-400">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    {{-- Admin Dashboard Link --}}
                    @if(Auth::user()->is_admin)
                        <x-responsive-nav-link :href="route('admin.dashboard')" class="text-red-400 hover:text-red-100 hover:bg-gray-700 font-bold">
                            {{ __('Admin Dashboard') }}
                        </x-responsive-nav-link>
                    @endif
                    
                    {{-- Customer Portal Links --}}
                    <x-responsive-nav-link :href="route('customer.dashboard')" class="text-gray-300 hover:text-white">
                        {{ __('Tableau de Bord') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('customer.profile.edit')" class="text-gray-300 hover:text-white">
                        {{ __('Modifier Profil') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();" class="text-gray-300 hover:text-white">
                            {{ __('Déconnexion') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @endauth
            
            @guest
                <x-responsive-nav-link :href="route('login')" class="text-gray-300 hover:text-white">
                    {{ __('Connexion') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('register')" class="text-gray-300 hover:text-white">
                    {{ __('Créer un Compte') }}
                </x-responsive-nav-link>
            @endguest
        </div>
    </div>
</nav>