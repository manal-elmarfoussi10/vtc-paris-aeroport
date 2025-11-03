@extends('layouts.app')

@section('title', 'Nos Services VTC - Transferts Aéroports Paris | Service Premium')
@section('description', 'Découvrez nos services de transport privé : transferts aéroports, mise à disposition, business et événements. Service premium 24h/24 avec chauffeurs professionnels.')

@section('head')
<style>
/* Custom styles for services page */
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

.animate-fade-in-up {
    animation: fadeInUp 0.8s ease-out forwards;
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

/* Service card hover effects */
.service-card {
    transition: all 0.3s ease;
    transform: translateY(0);
}

.service-card:hover {
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

    // Add staggered animations to service sections
    const serviceSections = document.querySelectorAll('.animate-on-scroll');
    serviceSections.forEach((section, index) => {
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
            Nos Services <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-orange-300 animate-gradient-x">Premium</span>
        </h1>
        <p class="text-xl sm:text-2xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
            Service de transport privé de qualité supérieure adapté à tous vos besoins.
            De l'aéroport aux événements spéciaux, nous vous accompagnons partout à Paris.
        </p>
    </div>
</section>

{{-- Title Section --}}
<section class="mt-1 py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
            Découvrez Nos Services de Transport Privé
        </h2>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
            Que vous ayez besoin d'un transfert aéroport, d'une mise à disposition pour vos déplacements professionnels,
            ou d'un service pour vos événements spéciaux, nous proposons des solutions sur mesure avec le plus haut niveau d'excellence.
        </p>
    </div>
</section>

{{-- Service 1: Image Left, Text Right --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <img src="/images/vtc9.jpg" alt="Confort et Élégance" class="w-full h-96 object-cover rounded-2xl shadow-lg">
            </div>
            <div class="animate-on-scroll">
                <h3 class="text-3xl font-bold text-gray-900 mb-6">Confort & Élégance</h3>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Voyagez dans des véhicules haut de gamme parfaitement entretenus. Nos berlines et vans spacieux
                    offrent un confort optimal pour tous vos déplacements, avec climatisation, sièges en cuir premium
                    et espace généreux pour vos bagages.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Véhicules récents et entretenus
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Climatisation automatique
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Sièges en cuir premium
                    </li>
                </ul>
                <x-button href="{{ route('booking') }}" variant="primary">
                    Réserver maintenant
                </x-button>
            </div>
        </div>
    </div>
</section>

{{-- Service 2: Image Right, Text Left --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <h3 class="text-3xl font-bold text-gray-900 mb-6">Sécurité & Fiabilité</h3>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Votre sécurité est notre priorité absolue. Tous nos chauffeurs sont professionnels expérimentés,
                    nos véhicules sont régulièrement contrôlés, et nous assurons un suivi GPS en temps réel
                    pour une tranquillité d'esprit totale.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Chauffeurs certifiés et expérimentés
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Suivi GPS en temps réel
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Assurance complète
                    </li>
                </ul>
                <x-button href="{{ route('booking') }}" variant="primary">
                    Réserver maintenant
                </x-button>
            </div>
            <div class="animate-on-scroll">
                <img src="/images/vtc8.png" alt="Sécurité et Fiabilité" class="w-full h-96 object-cover rounded-2xl shadow-lg">
            </div>
        </div>
    </div>
</section>

{{-- Service 3: Image Left, Text Right --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <img src="/images/vtc10.jpg" alt="Service Professionnel" class="w-full h-96 object-cover rounded-2xl shadow-lg">
            </div>
            <div class="animate-on-scroll">
                <h3 class="text-3xl font-bold text-gray-900 mb-6">Service Professionnel</h3>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Nos chauffeurs professionnels vous accueillent avec élégance et discrétion. Formés aux standards
                    les plus élevés, ils assurent un service impeccable du début à la fin de votre trajet,
                    avec une attention particulière à votre confort personnel.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Accueil personnalisé à l'aéroport
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Discrétion et professionnalisme
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Assistance pour vos bagages
                    </li>
                </ul>
                <x-button href="{{ route('booking') }}" variant="primary">
                    Réserver maintenant
                </x-button>
            </div>
        </div>
    </div>
</section>

{{-- Service 4: Image Right, Text Left --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <h3 class="text-3xl font-bold text-gray-900 mb-6">Prix Transparents</h3>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Fini les mauvaises surprises ! Nos tarifs sont fixes et transparents dès la réservation.
                    Pas de frais cachés, pas de majoration pour les bagages ou les heures supplémentaires.
                    Le prix affiché est le prix payé.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Tarifs fixes garantis
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Paiement sécurisé en ligne
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Facture détaillée fournie
                    </li>
                </ul>
                <x-button href="{{ route('booking') }}" variant="primary">
                    Réserver maintenant
                </x-button>
            </div>
            <div class="animate-on-scroll">
                <img src="/images/vtc4.jpg" alt="Prix Transparents" class="w-full h-96 object-cover rounded-2xl shadow-lg">
            </div>
        </div>
    </div>
</section>

{{-- Service 5: Image Left, Text Right --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <img src="/images/vtc11.png" alt="Sièges Enfants" class="w-full h-96 object-cover rounded-2xl shadow-lg">
            </div>
            <div class="animate-on-scroll">
                <h3 class="text-3xl font-bold text-gray-900 mb-6">Sièges Enfants & Familles</h3>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Voyagez en famille en toute sécurité. Nous proposons des sièges enfants homologués,
                    des rehausseurs et des vans spacieux pour accueillir jusqu'à 7 personnes confortablement.
                    Vos enfants voyageront en toute sécurité et sérénité.
                </p>
                <ul class="space-y-3 mb-8">
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Sièges enfants homologués
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Vans familiaux spacieux
                    </li>
                    <li class="flex items-center text-gray-700">
                        <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Chauffeurs attentionnés
                    </li>
                </ul>
                <x-button href="{{ route('booking') }}" variant="primary">
                    Réserver maintenant
                </x-button>
            </div>
        </div>
    </div>
</section>

{{-- Enhanced CTA Section (Same as Home Page) --}}
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

@endsection
