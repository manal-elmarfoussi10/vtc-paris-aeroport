@extends('layouts.app')

@section('title', 'Aéroports Paris - Transferts VTC CDG, Orly, Beauvais')
@section('description', 'Découvrez les principaux aéroports parisiens et nos services de transfert premium. Réservation en ligne, tarifs fixes, service professionnel.')

@section('head')
<style>
/* Custom styles for airports page */
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

@keyframes pulseGlow {
    0%, 100% {
        box-shadow: 0 0 20px rgba(255, 255, 255, 0.1);
    }
    50% {
        box-shadow: 0 0 30px rgba(255, 255, 255, 0.3);
    }
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

/* Airport card hover effects */
.airport-card {
    transition: all 0.3s ease;
    transform: translateY(0);
}

.airport-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

/* Custom gradient backgrounds */
.cta-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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

    // Add staggered animations to airport sections
    const airportSections = document.querySelectorAll('.animate-on-scroll');
    airportSections.forEach((section, index) => {
        section.style.transitionDelay = `${index * 0.2}s`;
    });
});
</script>
@endsection

@section('content')

{{-- Proposition Header --}}
<section class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 text-white pt-40 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <br><br>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6">
            Aéroports de <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-orange-300 animate-gradient-x">Paris</span>
        </h1>
        <p class="text-xl sm:text-2xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
            Découvrez les principaux hubs aériens parisiens et profitez de nos transferts premium vers CDG, Orly et Beauvais.
            Service professionnel et ponctuel pour tous vos voyages.
        </p>
    </div>
</section>

{{-- Title Section --}}
<section class="mt-1 py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
            Explorez les Aéroports Iconiques de Paris
        </h2>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
            De Charles de Gaulle, le plus grand aéroport européen, à Orly, le hub d'affaires privilégié, en passant par Beauvais,
            la porte d'entrée low-cost, chaque aéroport raconte une histoire unique de connectivité et d'innovation.
        </p>
    </div>
</section>

{{-- Airport 1: Charles de Gaulle (CDG) - Icon Left, Text Right --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <div class="text-center">
                    <div class="mx-auto h-32 w-32 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                        <svg class="h-16 w-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="animate-on-scroll">
                <h3 class="text-3xl font-bold text-gray-900 mb-6">Charles de Gaulle (CDG) - Le Géant Européen</h3>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Premier aéroport européen par le trafic passagers, Roissy-Charles de Gaulle est une merveille architecturale
                    avec ses terminaux innovants et ses connexions mondiales. Hub principal d'Air France, il relie Paris
                    à plus de 100 destinations internationales avec une efficacité remarquable.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Plus de 70 millions de passagers annuels
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        3 terminaux modernes et connectés
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Transfert rapide vers Paris (45 min)
                    </li>
                </ul>
                <x-button href="{{ route('booking') }}" variant="primary">
                    Réserver Transfert CDG
                </x-button>
            </div>
        </div>
    </div>
</section>

{{-- Airport 2: Orly (ORY) - Icon Right, Text Left --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <h3 class="text-3xl font-bold text-gray-900 mb-6">Orly (ORY) - L'Efficacité Métropolitaine</h3>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Situé au sud de Paris, Orly est le deuxième aéroport français et un hub privilégié pour les vols européens
                    et domestiques. Avec ses terminaux compacts et modernes, il offre une expérience de voyage fluide
                    et rapide, idéal pour les déplacements d'affaires et les courts séjours.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Proximité urbaine exceptionnelle
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Vols européens et domestiques
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Transfert express vers Paris (30 min)
                    </li>
                </ul>
                <x-button href="{{ route('booking') }}" variant="primary">
                    Réserver Transfert Orly
                </x-button>
            </div>
            <div class="animate-on-scroll">
                <div class="text-center">
                    <div class="mx-auto h-32 w-32 bg-gradient-to-r from-green-500 to-blue-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                        <svg class="h-16 w-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Airport 3: Beauvais (BVA) - Icon Left, Text Right --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <div class="text-center">
                    <div class="mx-auto h-32 w-32 bg-gradient-to-r from-purple-500 to-pink-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                        <svg class="h-16 w-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="animate-on-scroll">
                <h3 class="text-3xl font-bold text-gray-900 mb-6">Beauvais (BVA) - L'Alternative Accessible</h3>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    À seulement 85 km au nord de Paris, Beauvais-Tillé est la base des compagnies low-cost européennes.
                    Moderne et fonctionnel, cet aéroport offre des tarifs attractifs pour voyager vers l'Europe entière,
                    avec des transferts terrestres rapides et confortables vers la capitale.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Tarifs low-cost attractifs
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Plus de 40 destinations européennes
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Transfert confortable (1h15)
                    </li>
                </ul>
                <x-button href="{{ route('booking') }}" variant="primary">
                    Réserver Transfert Beauvais
                </x-button>
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
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                    Réservation Express
                </span>
            </div>

            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight animate-fade-in-up" style="animation-delay: 0.5s;">
                Prêt à <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-orange-300 animate-gradient-x">Voyager</span> ?
            </h2>

            <p class="text-xl sm:text-2xl text-blue-100 mb-12 max-w-3xl mx-auto leading-relaxed">
                Calculez votre tarif fixe en 30 secondes. Réservation instantanée, paiement sécurisé,
                et chauffeur professionnel à votre arrivée à l'aéroport.
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
                    <h4 class="text-white font-semibold mb-1">Suivi de Vol</h4>
                    <p class="text-blue-200 text-sm">Adaptation temps réel</p>
                </div>

                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-3 backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h4 class="text-white font-semibold mb-1">Ponctualité</h4>
                    <p class="text-blue-200 text-sm">Arrivée 10 min avant</p>
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

@endsection
