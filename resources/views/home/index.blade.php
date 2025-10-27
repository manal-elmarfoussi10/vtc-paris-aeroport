@extends('layouts.app')

{{--
    File: resources/views/home/index.blade.php
    Description: MODERN, HUMANIZED HOME PAGE WITH STORYTELLING AND EMOTIONAL CONNECTION
--}}

@section('title', "VTC Paris Aéroport - Service Chauffeur Privé Premium | Transferts Aéroports")
@section('description', "Votre partenaire de confiance pour les transferts aéroport Paris. Service VTC premium avec chauffeurs professionnels, véhicules de luxe et tarifs transparents.")

@section('head')
<style>
/* Custom styles for home page transparent header */
.home-header {
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(10px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.home-header.scrolled {
    background: rgba(30, 58, 138, 0.95);
    backdrop-filter: blur(20px);
    border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
}

.home-header .nav-link {
    color: #ffffff !important;
    font-weight: 500;
}

.home-header .nav-link:hover {
    color: #ffffff !important;
    background-color: rgba(255, 255, 255, 0.1);
}

.home-header .booking-btn {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    color: white !important;
    border: 1px solid rgba(255, 255, 255, 0.2);
    font-weight: 600;
    box-shadow: 0 4px 15px rgba(255, 255, 255, 0.1);
    transition: all 0.3s ease;
}

.home-header .booking-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.4);
    color: white !important;
    transform: translateY(-1px);
    box-shadow: 0 6px 20px rgba(255, 255, 255, 0.2);
}

.home-header .dropdown-btn {
    background: rgba(255, 255, 255, 0.1);
    backdrop-filter: blur(10px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    color: #ffffff;
}

.home-header .dropdown-btn:hover {
    background: rgba(255, 255, 255, 0.2);
    border-color: rgba(255, 255, 255, 0.4);
}

.home-header .dropdown-link {
    color: #ffffff !important;
}

.home-header .dropdown-link:hover {
    color: #ffffff !important;
    background-color: rgba(255, 255, 255, 0.1);
}

@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes gradientX {
    0%, 100% {
        background-size: 200% 200%;
        background-position: left center;
    }
    50% {
        background-size: 200% 200%;
        background-position: right center;
    }
}

@keyframes dash {
    to {
        stroke-dashoffset: 0;
    }
}

.animate-dash {
    stroke-dasharray: 10;
    stroke-dashoffset: 10;
    animation: dash 2s ease-in-out forwards;
}

@keyframes pulseGlow {
    0%, 100% {
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
    }
    50% {
        box-shadow: 0 0 30px rgba(255, 255, 255, 0.3);
    }
}

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out forwards;
    opacity: 0;
}

.animate-slide-in-left {
    animation: slideInLeft 1s ease-out forwards;
    opacity: 0;
}

.animate-slide-in-right {
    animation: slideInRight 1s ease-out forwards;
    opacity: 0;
}

.animate-gradient-x {
    animation: gradientX 3s ease infinite;
}

.animate-pulse-glow {
    animation: pulseGlow 2s ease-in-out infinite;
}

/* Intersection Observer for scroll animations */
.animate-on-scroll {
    opacity: 0;
    transform: translateY(50px);
    transition: all 0.8s ease-out;
}

.animate-on-scroll.animate {
    opacity: 1;
    transform: translateY(0);
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, observerOptions);

    // Observe all elements with animate-on-scroll class
    document.querySelectorAll('.animate-on-scroll').forEach(el => {
        observer.observe(el);
    });

    // Add staggered animations to service sections
    const serviceSections = document.querySelectorAll('.animate-on-scroll');
    serviceSections.forEach((section, index) => {
        section.style.transitionDelay = `${index * 0.2}s`;
    });

    // Header scroll effect
    const header = document.querySelector('.home-header');
    let lastScrollY = window.scrollY;

    window.addEventListener('scroll', () => {
        const currentScrollY = window.scrollY;

        if (currentScrollY > 50) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }

        lastScrollY = currentScrollY;
    });
});
</script>
@endsection

@section('navigation')
{{-- Top Announcement Bar --}}
<div class="bg-white text-blue-900 text-center py-2 text-sm font-medium border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4">
        <span class="inline-flex items-center">
            <svg class="w-4 h-4 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
            </svg>
            Service Premium VTC - Réservations 24h/24 • Transferts Aéroport Paris
        </span>
    </div>
</div>

{{-- Custom Transparent Header for Home Page --}}
@php
    $is_home = true;
    $nav_bg_class = 'home-header absolute top-8 left-0 w-full z-50';
    $nav_text_class = 'text-white text-lg font-medium';
    $logo_is_dark = true;
@endphp

<nav x-data="{ open: false }" class="{{ $nav_bg_class }} transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-20">
            <div class="flex-shrink-0">
                @include('components.application-logo', ['is_dark' => $logo_is_dark, 'class' => 'h-24 w-auto'])
            </div>

            <div class="flex-1 flex justify-center">
                <div class="hidden space-x-8 sm:flex {{ $nav_text_class }}">
                    <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')" class="nav-link text-white hover:text-white transition-colors duration-200 font-medium text-lg px-3 py-2 rounded-lg hover:bg-white/10">
                        {{ __('Accueil') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('booking') }}" :active="request()->routeIs('booking*')" class="nav-link text-white hover:text-white transition-colors duration-200 font-medium text-lg px-3 py-2 rounded-lg hover:bg-white/10">
                        {{ __('Réserver') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('services.index') }}" :active="request()->routeIs('services.index')" class="nav-link text-white hover:text-white transition-colors duration-200 font-medium text-lg px-3 py-2 rounded-lg hover:bg-white/10">
                        {{ __('Services') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('airports.index') }}" :active="request()->routeIs('airports*')" class="nav-link text-white hover:text-white transition-colors duration-200 font-medium text-lg px-3 py-2 rounded-lg hover:bg-white/10">
                        {{ __('Aéroports') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('faq') }}" :active="request()->routeIs('faq')" class="nav-link text-white hover:text-white transition-colors duration-200 font-medium text-lg px-3 py-2 rounded-lg hover:bg-white/10">
                        {{ __('FAQ') }}
                    </x-nav-link>

                    <x-nav-link href="{{ route('contact') }}" :active="request()->routeIs('contact')" class="nav-link text-white hover:text-white transition-colors duration-200 font-medium text-lg px-3 py-2 rounded-lg hover:bg-white/10">
                        {{ __('Contact') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ml-6">
                <a href="{{ route('booking') }}" class="booking-btn px-8 py-3 text-base font-semibold rounded-full mr-6 transition-all duration-300 text-white">
                    Calculer mon tarif
                </a>

                <div class="relative">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="dropdown-btn inline-flex items-center px-6 py-3 border text-base leading-4 font-medium rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-primary focus:border-transparent transition-all duration-200 text-white">
                                <div>@auth {{ Auth::user()->name }} @else Connexion / Compte @endauth</div>
                                <div class="ml-2">
                                    <svg class="fill-current h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @auth
                                <x-dropdown-link :href="route('customer.dashboard')">
                                    {{ __('Tableau de bord') }}
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('customer.profile.edit')">
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
                <button @click="open = ! open" class="inline-flex items-center justify-center p-3 rounded-lg text-gray-600 hover:text-blue-primary hover:bg-blue-50 focus:outline-none focus:bg-blue-50 focus:text-blue-primary transition-all duration-200 border border-gray-200">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-white/95 backdrop-blur-md shadow-2xl border-t border-gray-200 absolute w-full pb-4">
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

        <div class="pt-4 pb-3 border-t border-gray-200 bg-gray-50/80">
            @auth
                <div class="px-4 py-3">
                    <div class="font-semibold text-base text-gray-800">{{ Auth::user()->name }}</div>
                    <div class="font-medium text-sm text-gray-600">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-2 space-y-1 px-4">
                    <x-responsive-nav-link :href="route('customer.dashboard')" class="text-gray-700 hover:text-blue-primary hover:bg-blue-50 transition-colors duration-200">
                        {{ __('Tableau de bord') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('customer.profile.edit')" class="text-gray-700 hover:text-blue-primary hover:bg-blue-50 transition-colors duration-200">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                                onclick="event.preventDefault();
                                            this.closest('form').submit();"
                                class="text-red-600 hover:text-red-700 hover:bg-red-50 transition-colors duration-200">
                            {{ __('Déconnexion') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            @else
                <div class="mt-2 space-y-1 px-4">
                    <x-responsive-nav-link :href="route('login')" class="text-gray-700 hover:text-blue-primary hover:bg-blue-50 transition-colors duration-200">
                        {{ __('Connexion') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" class="text-gray-700 hover:text-blue-primary hover:bg-blue-50 transition-colors duration-200">
                        {{ __('Inscription') }}
                    </x-responsive-nav-link>
                </div>
            @endauth
        </div>
    </div>
</nav>
@endsection

@section('content')

    {{-- Hero Section with Emotional Storytelling - Full Screen --}}
    <section class="relative min-h-screen flex items-center justify-center overflow-hidden bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800" style="padding-top: 2rem;">
        {{-- Animated Background Elements --}}
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-20 left-10 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl animate-pulse"></div>
            <div class="absolute top-40 right-10 w-72 h-72 bg-purple-400 rounded-full mix-blend-multiply filter blur-xl animate-pulse" style="animation-delay: 2s;"></div>
            <div class="absolute -bottom-8 left-20 w-72 h-72 bg-pink-400 rounded-full mix-blend-multiply filter blur-xl animate-pulse" style="animation-delay: 4s;"></div>
            <div class="absolute bottom-20 right-20 w-96 h-96 bg-indigo-400 rounded-full mix-blend-multiply filter blur-xl animate-pulse" style="animation-delay: 6s;"></div>
        </div>

        {{-- Floating Particles --}}
        <div class="absolute inset-0 overflow-hidden">
            <div class="absolute top-1/4 left-1/4 w-2 h-2 bg-white rounded-full opacity-20 animate-bounce" style="animation-delay: 1s; animation-duration: 3s;"></div>
            <div class="absolute top-1/3 right-1/3 w-1 h-1 bg-blue-300 rounded-full opacity-30 animate-bounce" style="animation-delay: 2s; animation-duration: 4s;"></div>
            <div class="absolute bottom-1/4 left-1/3 w-3 h-3 bg-purple-300 rounded-full opacity-20 animate-bounce" style="animation-delay: 3s; animation-duration: 5s;"></div>
            <div class="absolute top-1/2 right-1/4 w-1 h-1 bg-pink-300 rounded-full opacity-25 animate-bounce" style="animation-delay: 4s; animation-duration: 3.5s;"></div>
            <div class="absolute bottom-1/3 right-1/2 w-2 h-2 bg-indigo-300 rounded-full opacity-20 animate-bounce" style="animation-delay: 5s; animation-duration: 4.5s;"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <div class="max-w-4xl mx-auto">
                {{-- Emotional Hook --}}
                <div class="mb-8">
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-blue-500/20 text-blue-200 border border-blue-400/30">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Service certifié et assuré
                    </span>
                </div>

                {{-- Main Headline with Human Touch --}}
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-white leading-tight mb-6 animate-fade-in-up">
                    Votre <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-purple-400 animate-gradient-x">Voyage Commence</span> Ici
                </h1>

                <p class="text-xl sm:text-2xl text-gray-300 leading-relaxed mb-8 max-w-3xl mx-auto">
                    Imaginez : vous arrivez à l'aéroport, stressé par les bagages et les horaires.
                    Votre chauffeur vous attend avec un sourire, votre nom sur une pancarte élégante.
                    <strong class="text-white">Pas de course contre la montre, juste un trajet paisible vers votre destination.</strong>
                </p>

                {{-- Social Proof Elements --}}
                <div class="flex flex-col sm:flex-row items-center justify-center gap-6 mb-10 text-gray-400">
                    <div class="flex items-center">
                        <div class="flex -space-x-2">
                            <img class="w-8 h-8 rounded-full border-2 border-white" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=32&h=32&fit=crop&crop=face" alt="Client satisfait">
                            <img class="w-8 h-8 rounded-full border-2 border-white" src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=32&h=32&fit=crop&crop=face" alt="Cliente satisfaite">
                            <img class="w-8 h-8 rounded-full border-2 border-white" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=32&h=32&fit=crop&crop=face" alt="Client satisfait">
                        </div>
                        <span class="ml-3 text-sm">Recommandé par <strong class="text-white">500+ voyageurs</strong></span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-yellow-400 fill-current" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                        <span class="ml-1 text-sm"><strong class="text-white">4.9/5</strong> sur Trustpilot</span>
                    </div>
                </div>

                {{-- Enhanced CTA Section --}}
                <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                    <a href="{{ route('booking') }}" class="group inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white text-lg font-semibold rounded-full shadow-2xl hover:shadow-blue-500/25 transition-all duration-300 transform hover:scale-105 hover:-translate-y-1">
                        <svg class="w-5 h-5 mr-3 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                        Réserver Mon Transfert
                    </a>
                    <a href="tel:+33123456789" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white/30 text-white text-lg font-medium rounded-full hover:bg-white/10 hover:border-white/50 transition-all duration-300 backdrop-blur-sm">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        01 23 45 67 89
                    </a>
                </div>

                <p class="mt-6 text-sm text-gray-400">
                    Réservation instantanée • Paiement sécurisé • Annulation gratuite 24h avant
                </p>
            </div>
        </div>

        {{-- Scroll Indicator --}}
        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
            <div class="w-12 h-12 bg-white/10 backdrop-blur-sm rounded-full flex items-center justify-center border border-white/20">
                <svg class="w-6 h-6 text-white/80" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                </svg>
            </div>
        </div>
    </section>

    <main>
        
        {{-- Key Differentiators Section --}}
        <section class="bg-gradient-to-r from-slate-900 to-slate-800 -mt-20 relative z-20 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-12">
                    <h2 class="text-3xl font-bold text-white mb-4">L'Excellence en Chaque Détail</h2>
                    <p class="text-gray-300 text-lg">Ce qui fait la différence VTC Paris Aéroport</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:bg-white/10 transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-br from-green-400 to-green-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Prix Transparents</h3>
                        <p class="text-gray-300 leading-relaxed">Tarifs fixes garantis, sans surprise. Le prix affiché est le prix payé, point final.</p>
                    </div>

                    <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:bg-white/10 transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Service 24h/24</h3>
                        <p class="text-gray-300 leading-relaxed">Suivi de vol en temps réel et adaptation immédiate. Votre sérénité, notre priorité.</p>
                    </div>

                    <div class="bg-white/5 backdrop-blur-sm rounded-2xl p-8 border border-white/10 hover:bg-white/10 transition-all duration-300 group">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-400 to-purple-600 rounded-2xl flex items-center justify-center mb-6 group-hover:scale-110 transition-transform duration-300">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-white mb-3">Accueil VIP</h3>
                        <p class="text-gray-300 leading-relaxed">Votre nom sur une pancarte élégante. Un chauffeur professionnel vous attend à la sortie.</p>
                    </div>
                </div>
            </div>
        </section>

        {{-- Notre Flotte (fixed aspect ratio + clean cards) --}}
<section class="py-20 sm:py-28 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="text-center mb-14 sm:mb-16">
        <h2 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">
          Notre flotte exclusive
        </h2>
        <p class="mt-4 text-lg sm:text-xl text-gray-600 max-w-3xl mx-auto">
          Voyagez en toute discrétion et confort. Des véhicules récents, entretenus, et parfaitement équipés pour votre sérénité.
        </p>
      </div>
  
      <div class="space-y-16 sm:space-y-20">
  
        {{-- 1) Berline Affaires --}}
        <article class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
          {{-- image (16:9) --}}
          <figure class="order-2 lg:order-1">
            <div class="relative w-full overflow-hidden rounded-2xl shadow-md bg-gray-50">
              <img
                src="{{ asset('images/vtc9.jpg') }}"
                alt="Berline Affaires (Mercedes Classe E, BMW Série 5 ou équivalent)"
                class="block w-full h-auto object-cover"
                style="aspect-ratio: 16/9;"
              >
            </div>
          </figure>
  
          {{-- text --}}
          <div class="order-1 lg:order-2">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
              Service Premium
            </span>
            <h3 class="mt-4 text-2xl sm:text-3xl font-bold text-gray-900">Berline Affaires</h3>
            <p class="mt-4 text-gray-600 leading-relaxed">
              Mercedes Classe E, BMW Série 5 ou équivalent. Idéal pour vos déplacements professionnels ou personnels.
              Confort optimal, espace généreux et discrétion assurée pour 1 à 3 passagers.
            </p>
            <ul class="mt-6 space-y-3">
              <li class="flex items-start gap-3 text-gray-700">
                <svg class="w-5 h-5 text-emerald-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                Climatisation automatique
              </li>
              <li class="flex items-start gap-3 text-gray-700">
                <svg class="w-5 h-5 text-emerald-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                Sièges en cuir premium
              </li>
              <li class="flex items-start gap-3 text-gray-700">
                <svg class="w-5 h-5 text-emerald-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                Espace bagages généreux
              </li>
            </ul>
            <p class="mt-5 text-sm text-gray-500">
              Parfait pour : transferts aéroports, rendez-vous d’affaires, événements.
            </p>
          </div>
        </article>
  
        {{-- 2) Van Familial / VIP --}}
        <article class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
          {{-- text first on desktop --}}
          <div class="order-1">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
              Service Familial
            </span>
            <h3 class="mt-4 text-2xl sm:text-3xl font-bold text-gray-900">Van Familial / VIP</h3>
            <p class="mt-4 text-gray-600">
              Mercedes Classe V ou équivalent. L’espace idéal pour les familles nombreuses ou les groupes.
              Jusqu’à 7 passagers confortablement installés avec tous leurs bagages.
            </p>
            <ul class="mt-6 space-y-3">
              <li class="flex items-start gap-3 text-gray-700">
                <svg class="w-5 h-5 text-emerald-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                7 places assises confortables
              </li>
              <li class="flex items-start gap-3 text-gray-700">
                <svg class="w-5 h-5 text-emerald-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                Espace bagages modulable
              </li>
              <li class="flex items-start gap-3 text-gray-700">
                <svg class="w-5 h-5 text-emerald-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                Divans et fauteuils premium
              </li>
            </ul>
            <p class="mt-5 text-sm text-gray-500">Parfait pour : familles, groupes, événements, transferts VIP.</p>
          </div>

          {{-- image (16:9) --}}
          <figure class="order-2">
            <div class="relative w-full overflow-hidden rounded-2xl shadow-md bg-gray-50">
              <img
                src="{{ asset('images/vtc8.png') }}"
                alt="Van Familial / VIP"
                class="block w-full h-auto object-cover"
                style="aspect-ratio: 16/9;"
              >
            </div>
          </figure>
        </article>
  
        {{-- 3) Berline Luxe --}}
        <article class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12 items-center">
          {{-- image (16:9) --}}
          <figure class="order-2 lg:order-1">
            <div class="relative w-full overflow-hidden rounded-2xl shadow-md bg-gray-50">
              <img
                src="{{ asset('images/vtc4.jpg') }}"
                alt="Berline Luxe (Mercedes Classe S ou équivalent)"
                class="block w-full h-auto object-cover"
                style="aspect-ratio: 16/9;"
              >
            </div>
          </figure>
  
          {{-- text --}}
          <div class="order-1 lg:order-2">
            <span class="inline-flex items-center gap-2 px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
              <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
              Service VIP
            </span>
            <h3 class="mt-4 text-2xl sm:text-3xl font-bold text-gray-900">Berline Luxe</h3>
            <p class="mt-4 text-gray-600">
              Mercedes Classe S ou équivalent. L’excellence absolue pour vos déplacements les plus prestigieux :
              le summum du confort, de l’élégance et du service personnalisé.
            </p>
            <ul class="mt-6 space-y-3">
              <li class="flex items-start gap-3 text-gray-700">
                <svg class="w-5 h-5 text-emerald-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                Confort ultime et insonorisation
              </li>
              <li class="flex items-start gap-3 text-gray-700">
                <svg class="w-5 h-5 text-emerald-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                Équipements high-tech
              </li>
              <li class="flex items-start gap-3 text-gray-700">
                <svg class="w-5 h-5 text-emerald-500 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                Service majordome personnalisé
              </li>
            </ul>
            <p class="mt-5 text-sm text-gray-500">Parfait pour : voyages d’affaires, événements prestigieux, VIP.</p>
          </div>
        </article>
  
      </div>
    </div>
  </section>

  
        {{-- Why Choose Us: Emotional Benefits --}}
        <section class="py-20 sm:py-32 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 sm:text-5xl mb-4">
                        Pourquoi Nous Choisir ?
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Au-delà du transport, nous créons des expériences mémorables qui rendent vos voyages plus agréables
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center group">
                        <div class="relative mb-6">
                            <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto shadow-lg group-hover:shadow-xl transition-all duration-300 transform group-hover:scale-110">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V9m0 3v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Tarif Transparent</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Pas de surprise à l'arrivée. Le prix affiché est le prix payé, sans frais cachés.
                        </p>
                    </div>

                    <div class="text-center group">
                        <div class="relative mb-6">
                            <div class="w-20 h-20 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto shadow-lg group-hover:shadow-xl transition-all duration-300 transform group-hover:scale-110">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20h-5v-2a3 3 0 00-5.356-1.857M17 20v-2c0-.523-.13-1.033-.356-1.543m0 0a3.022 3.022 0 010-4.045M19 8a2 2 0 11-4 0 2 2 0 014 0zM7 12a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                </svg>
                            </div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Chauffeurs d'Exception</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Professionnels expérimentés, courtois et attentifs à votre confort personnel.
                        </p>
                    </div>

                    <div class="text-center group">
                        <div class="relative mb-6">
                            <div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto shadow-lg group-hover:shadow-xl transition-all duration-300 transform group-hover:scale-110">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Suivi de Vol</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Nous surveillons votre vol en temps réel pour adapter notre prise en charge.
                        </p>
                    </div>

                    <div class="text-center group">
                        <div class="relative mb-6">
                            <div class="w-20 h-20 bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl flex items-center justify-center mx-auto shadow-lg group-hover:shadow-xl transition-all duration-300 transform group-hover:scale-110">
                                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div class="absolute -top-2 -right-2 w-6 h-6 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </div>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3">Service 24h/24</h3>
                        <p class="text-gray-600 leading-relaxed">
                            Disponibles à toute heure, même pour les vols retardés ou annulés.
                        </p>
                    </div>
                </div>

                {{-- Airport Coverage - Interactive Map Style --}}
                <div class="mt-20 animate-on-scroll">
                    <div class="text-center mb-16">
                        <h3 class="text-4xl font-bold text-gray-900 mb-6 animate-fade-in-up">Couverture Aéroportuaire Complète</h3>
                        <p class="text-xl text-gray-600 max-w-2xl mx-auto animate-fade-in-up" style="animation-delay: 0.2s;">Transferts vers tous les principaux aéroports de Paris avec service premium</p>
                    </div>

                    {{-- Interactive Airport Map --}}
                    <div class="relative bg-gradient-to-br from-gray-50 to-blue-50 rounded-3xl p-12 mb-12 overflow-hidden">
                        {{-- Background Pattern --}}
                        <div class="absolute inset-0 opacity-5">
                            <div class="absolute top-10 left-10 w-32 h-32 bg-blue-400 rounded-full"></div>
                            <div class="absolute bottom-10 right-10 w-24 h-24 bg-green-400 rounded-full"></div>
                            <div class="absolute top-1/2 left-1/2 w-40 h-40 bg-purple-400 rounded-full -translate-x-1/2 -translate-y-1/2"></div>
                        </div>

                        {{-- Airport Connections --}}
                        <div class="relative z-10">
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                                {{-- Central Paris Hub --}}
                                <div class="lg:col-start-2 flex justify-center">
                                    <div class="bg-white rounded-2xl p-6 shadow-xl border-2 border-blue-200 animate-pulse-glow">
                                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl flex items-center justify-center mx-auto mb-4">
                                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            </svg>
                                        </div>
                                        <h4 class="text-lg font-bold text-gray-900 text-center">Paris Centre</h4>
                                        <p class="text-sm text-gray-600 text-center">Point de départ</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Connection Lines --}}
                            <svg class="absolute inset-0 w-full h-full" viewBox="0 0 800 400" style="z-index: 1;">
                                <defs>
                                    <marker id="arrowhead" markerWidth="10" markerHeight="7" refX="9" refY="3.5" orient="auto">
                                        <polygon points="0 0, 10 3.5, 0 7" fill="#3B82F6" />
                                    </marker>
                                </defs>
                                {{-- Lines from center to airports --}}
                                <line x1="400" y1="200" x2="150" y2="150" stroke="#3B82F6" stroke-width="2" marker-end="url(#arrowhead)" class="animate-dash"></line>
                                <line x1="400" y1="200" x2="650" y2="150" stroke="#10B981" stroke-width="2" marker-end="url(#arrowhead)" class="animate-dash" style="animation-delay: 0.5s;"></line>
                                <line x1="400" y1="200" x2="400" y2="350" stroke="#8B5CF6" stroke-width="2" marker-end="url(#arrowhead)" class="animate-dash" style="animation-delay: 1s;"></line>
                            </svg>
                        </div>
                    </div>

                    {{-- Airport Cards --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                        <div class="group bg-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 border border-gray-200 hover:border-blue-300 transform hover:-translate-y-2 animate-on-scroll">
                            <div class="flex items-center justify-between mb-6">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-blue-600">CDG</div>
                                    <div class="text-sm text-gray-500">Roissy</div>
                                </div>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-3">Paris Charles de Gaulle</h4>
                            <p class="text-gray-600 mb-4">Terminal 1, 2 & 3 - Vols internationaux et domestiques</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">À partir de 45€</span>
                                <a href="{{ route('airports.show', ['slug' => 'cdg']) }}" class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-600 font-semibold rounded-lg hover:bg-blue-100 transition-colors duration-200">
                                    Voir les tarifs <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>

                        <div class="group bg-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 border border-gray-200 hover:border-green-300 transform hover:-translate-y-2 animate-on-scroll" style="animation-delay: 0.2s;">
                            <div class="flex items-center justify-between mb-6">
                                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-green-600">ORY</div>
                                    <div class="text-sm text-gray-500">Orly</div>
                                </div>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-3">Orly Sud & Ouest</h4>
                            <p class="text-gray-600 mb-4">Accès rapide au sud de Paris - Vols européens</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">À partir de 35€</span>
                                <a href="{{ route('airports.show', ['slug' => 'orly']) }}" class="inline-flex items-center px-4 py-2 bg-green-50 text-green-600 font-semibold rounded-lg hover:bg-green-100 transition-colors duration-200">
                                    Voir les tarifs <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>

                        <div class="group bg-white rounded-2xl p-8 hover:shadow-2xl transition-all duration-500 border border-gray-200 hover:border-purple-300 transform hover:-translate-y-2 animate-on-scroll" style="animation-delay: 0.4s;">
                            <div class="flex items-center justify-between mb-6">
                                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                    </svg>
                                </div>
                                <div class="text-right">
                                    <div class="text-2xl font-bold text-purple-600">BVA</div>
                                    <div class="text-sm text-gray-500">Beauvais</div>
                                </div>
                            </div>
                            <h4 class="text-xl font-bold text-gray-900 mb-3">Beauvais-Tillé</h4>
                            <p class="text-gray-600 mb-4">Service dédié aux compagnies low-cost</p>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-500">À partir de 65€</span>
                                <a href="{{ route('airports.show', ['slug' => 'beauvais']) }}" class="inline-flex items-center px-4 py-2 bg-purple-50 text-purple-600 font-semibold rounded-lg hover:bg-purple-100 transition-colors duration-200">
                                    Voir les tarifs <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Service Guarantees --}}
                    <div class="mt-12 bg-white rounded-2xl p-8 shadow-lg animate-on-scroll" style="animation-delay: 0.6s;">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-center">
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-1">Ponctualité Garantie</h4>
                                <p class="text-sm text-gray-600">Suivi de vol en temps réel</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-1">Paiement Sécurisé</h4>
                                <p class="text-sm text-gray-600">SSL chiffré</p>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="w-12 h-12 bg-purple-100 rounded-full flex items-center justify-center mb-3">
                                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <h4 class="font-semibold text-gray-900 mb-1">Support 24/7</h4>
                                <p class="text-sm text-gray-600">Assistance téléphonique</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Customer Stories & Testimonials --}}
        <section class="py-20 sm:py-32 bg-gradient-to-br from-gray-50 to-blue-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-gray-900 sm:text-5xl mb-4">
                        Ils Nous Font Confiance
                    </h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                        Découvrez les expériences de nos voyageurs et pourquoi ils choisissent VTC Paris Aéroport
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
                    <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                        </div>
                        <blockquote class="text-gray-700 mb-4 italic">
                            "Service impeccable ! Mon chauffeur était à l'heure, le véhicule confortable et le trajet s'est déroulé dans les meilleures conditions. Je recommande vivement."
                        </blockquote>
                        <div class="flex items-center">
                            <img class="w-10 h-10 rounded-full mr-3" src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=40&h=40&fit=crop&crop=face" alt="Marie Dubois">
                            <div>
                                <div class="font-semibold text-gray-900">Marie Dubois</div>
                                <div class="text-sm text-gray-600">CEO, Tech Startup</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                        </div>
                        <blockquote class="text-gray-700 mb-4 italic">
                            "Parfait pour les voyages d'affaires. Ponctualité exemplaire et chauffeur très professionnel. Le véhicule était impeccable."
                        </blockquote>
                        <div class="flex items-center">
                            <img class="w-10 h-10 rounded-full mr-3" src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=40&h=40&fit=crop&crop=face" alt="Jean Martin">
                            <div>
                                <div class="font-semibold text-gray-900">Jean Martin</div>
                                <div class="text-sm text-gray-600">Directeur Commercial</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-2xl p-8 shadow-lg border border-gray-100">
                        <div class="flex items-center mb-4">
                            <div class="flex text-yellow-400">
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            </div>
                        </div>
                        <blockquote class="text-gray-700 mb-4 italic">
                            "Excellent service avec ma famille de 6 personnes. Le van était spacieux et confortable. Service impeccable du début à la fin."
                        </blockquote>
                        <div class="flex items-center">
                            <img class="w-10 h-10 rounded-full mr-3" src="https://images.unsplash.com/photo-1494790108755-2616b612b786?w=40&h=40&fit=crop&crop=face" alt="Sophie Laurent" loading="lazy">
                            <div>
                                <div class="font-semibold text-gray-900">Sophie Laurent</div>
                                <div class="text-sm text-gray-600">Famille de 6</div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Trust Indicators --}}
                <div class="text-center">
                    <div class="inline-flex items-center space-x-8 bg-white rounded-2xl px-8 py-6 shadow-lg border border-gray-100">
                        <div class="text-center">
                            <div class="text-2xl font-bold text-blue-600">500+</div>
                            <div class="text-sm text-gray-600">Voyageurs satisfaits</div>
                        </div>
                        <div class="w-px h-12 bg-gray-200"></div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-green-600">4.9/5</div>
                            <div class="text-sm text-gray-600">Note moyenne</div>
                        </div>
                        <div class="w-px h-12 bg-gray-200"></div>
                        <div class="text-center">
                            <div class="text-2xl font-bold text-purple-600">24/7</div>
                            <div class="text-sm text-gray-600">Service disponible</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


                {{-- Enhanced CTA Section --}}
                <section class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 relative overflow-hidden">
                    {{-- Background Pattern --}}
                    <div class="absolute inset-0 opacity-10">
                        <div class="absolute top-0 left-0 w-full h-full bg-white opacity-5 transform rotate-12 scale-150 animate-pulse" style="animation-duration: 8s;"></div>
                        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full opacity-5 -translate-y-48 translate-x-48 animate-pulse" style="animation-duration: 10s; animation-delay: 2s;"></div>
                        <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-blue-300 rounded-full opacity-5 -translate-x-1/2 -translate-y-1/2 animate-pulse" style="animation-duration: 12s; animation-delay: 4s;"></div>
                    </div>

                    {{-- Floating Elements --}}
                    <div class="absolute inset-0 overflow-hidden">
                        <div class="absolute top-20 left-20 w-4 h-4 bg-white rounded-full opacity-20 animate-bounce" style="animation-delay: 1s; animation-duration: 4s;"></div>
                        <div class="absolute top-40 right-40 w-3 h-3 bg-blue-200 rounded-full opacity-15 animate-bounce" style="animation-delay: 3s; animation-duration: 5s;"></div>
                        <div class="absolute bottom-32 left-32 w-2 h-2 bg-white rounded-full opacity-25 animate-bounce" style="animation-delay: 2s; animation-duration: 3.5s;"></div>
                        <div class="absolute bottom-20 right-20 w-5 h-5 bg-blue-100 rounded-full opacity-10 animate-bounce" style="animation-delay: 4s; animation-duration: 6s;"></div>
                    </div>

            <div class="relative max-w-7xl mx-auto py-20 px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <div class="mb-8">
                        <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-white/20 text-blue-100 border border-blue-300/30 backdrop-blur-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Réservation Express
                        </span>
                    </div>

                    <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight animate-fade-in-up" style="animation-delay: 0.5s;">
                        Prêt à <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-orange-300 animate-gradient-x">Réserver</span> ?
                    </h2>

                    <p class="text-xl sm:text-2xl text-blue-100 mb-12 max-w-3xl mx-auto leading-relaxed">
                        Calculez votre tarif fixe en 30 secondes. Réservation instantanée, paiement sécurisé,
                        et chauffeur professionnel à votre service.
                    </p>

                    {{-- Feature Highlights --}}
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mb-12 max-w-4xl mx-auto">
                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-3 backdrop-blur-sm">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V9m0 3v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h4 class="text-white font-semibold mb-1">Prix Fixe</h4>
                            <p class="text-blue-200 text-sm">Pas de surprise</p>
                        </div>

                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-3 backdrop-blur-sm">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h4 class="text-white font-semibold mb-1">Paiement Sécurisé</h4>
                            <p class="text-blue-200 text-sm">SSL chiffré</p>
                        </div>

                        <div class="flex flex-col items-center">
                            <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-3 backdrop-blur-sm">
                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <h4 class="text-white font-semibold mb-1">Confirmation Immédiate</h4>
                            <p class="text-blue-200 text-sm">Par email & SMS</p>
                        </div>
                    </div>

                    {{-- CTA Buttons --}}
                    <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in-up" style="animation-delay: 1s;">
                        <a href="{{ route('booking') }}" class="group inline-flex items-center justify-center px-8 py-4 bg-white text-blue-600 text-lg font-bold rounded-full shadow-2xl hover:shadow-white/25 transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 animate-pulse-glow">
                            <svg class="w-5 h-5 mr-3 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                            Réserver Mon Transfert
                        </a>
                        <a href="tel:+33123456789" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white/30 text-white text-lg font-medium rounded-full hover:bg-white/10 hover:border-white/50 transition-all duration-300 backdrop-blur-sm hover:animate-pulse">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            01 23 45 67 89
                        </a>
                    </div>

                    <p class="mt-8 text-sm text-blue-200">
                        Service disponible 24h/24 • Véhicules premium • 4.9/5 de satisfaction
                    </p>
                </div>
            </div>
        </section>

    </main>
@endsection