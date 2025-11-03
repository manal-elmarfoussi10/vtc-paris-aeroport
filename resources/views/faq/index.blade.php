@extends('layouts.app')

@section('title', 'FAQ - Questions fréquentes VTC Paris Aéroport')
@section('description', 'Réponses aux questions les plus fréquentes sur nos services VTC, réservations, tarifs, et transferts aéroports.')

@section('head')
<style>
/* Custom styles for FAQ page */
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

/* FAQ card hover effects */
.faq-card {
    transition: all 0.3s ease;
    transform: translateY(0);
}

.faq-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

/* Custom gradient backgrounds */
.cta-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

/* Accordion styles */
.accordion-button {
    transition: all 0.3s ease;
}

.accordion-button:hover {
    background-color: rgba(59, 130, 246, 0.05);
}

.accordion-content {
    transition: all 0.3s ease;
    max-height: 0;
    overflow: hidden;
}

.accordion-content.open {
    max-height: 1000px;
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

    // Add staggered animations to FAQ sections
    const faqSections = document.querySelectorAll('.animate-on-scroll');
    faqSections.forEach((section, index) => {
        section.style.transitionDelay = `${index * 0.2}s`;
    });

    // Accordion functionality
    document.querySelectorAll('.accordion-button').forEach(button => {
        button.addEventListener('click', function() {
            const content = this.nextElementSibling;
            const isOpen = content.classList.contains('open');

            // Close all accordions
            document.querySelectorAll('.accordion-content').forEach(c => c.classList.remove('open'));
            document.querySelectorAll('.accordion-button svg').forEach(svg => svg.classList.remove('rotate-180'));

            // Open clicked accordion if it wasn't open
            if (!isOpen) {
                content.classList.add('open');
                this.querySelector('svg').classList.add('rotate-180');
            }
        });
    });

    // Auto-open first FAQ
    const firstButton = document.querySelector('.accordion-button');
    if (firstButton) {
        firstButton.click();
    }
});
</script>
@endsection

@section('content')

{{-- Proposition Header --}}
<section class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 text-white pt-40 py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <br><br>
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6">
            Questions <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-orange-300 animate-gradient-x">Fréquentes</span>
        </h1>
        <p class="text-xl sm:text-2xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
            Toutes les réponses à vos interrogations sur nos services de transport privé.
            Réservations, tarifs, transferts aéroports : trouvez toutes les informations dont vous avez besoin.
        </p>
    </div>
</section>

{{-- Title Section --}}
<section class="mt-1 py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
            Vos Questions, Nos Réponses
        </h2>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
            Nous avons rassemblé les questions les plus courantes de nos clients pour vous apporter
            des réponses claires et précises. Découvrez comment fonctionne notre service de transport privé.
        </p>
    </div>
</section>

{{-- FAQ 1: Réservations - Icon Left, Text Right --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <div class="text-center">
                    <div class="mx-auto h-32 w-32 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                        <svg class="h-16 w-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="animate-on-scroll">
                <h3 class="text-3xl font-bold text-gray-900 mb-6">Réservations Simples & Rapides</h3>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Réservez votre transfert en quelques clics depuis notre site web ou notre application mobile.
                    Recevez une confirmation instantanée par email et SMS, avec tous les détails de votre trajet.
                </p>
                <div class="space-y-4">
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-2">Comment réserver ?</h4>
                        <p class="text-gray-600 text-sm">Sélectionnez votre trajet, choisissez votre véhicule, et payez en ligne. C'est aussi simple que ça !</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-2">Modification ou annulation ?</h4>
                        <p class="text-gray-600 text-sm">Modifiez gratuitement jusqu'à 24h avant. Annulation possible avec remboursement selon nos conditions.</p>
                    </div>
                </div>
                <x-button href="{{ route('booking') }}" variant="primary" class="mt-6">
                    Réserver maintenant
                </x-button>
            </div>
        </div>
    </div>
</section>

{{-- FAQ 2: Tarifs - Icon Right, Text Left --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <h3 class="text-3xl font-bold text-gray-900 mb-6">Tarifs Transparents & Fixes</h3>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Fini les mauvaises surprises ! Nos prix sont affichés clairement dès la réservation
                    et incluent tous les frais. Pas de majoration pour les bagages, les heures supplémentaires ou les péages.
                </p>
                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-900 mb-2">Prix fixe garanti</h4>
                        <p class="text-gray-600 text-sm">Le tarif affiché est le tarif payé. Aucun frais caché.</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-900 mb-2">Paiement sécurisé</h4>
                        <p class="text-gray-600 text-sm">Carte bancaire, PayPal ou virement bancaire accepté.</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-900 mb-2">Facture détaillée</h4>
                        <p class="text-gray-600 text-sm">Recevez votre facture par email après le trajet.</p>
                    </div>
                </div>
                <x-button href="{{ route('booking') }}" variant="primary" class="mt-6">
                    Calculer mon tarif
                </x-button>
            </div>
            <div class="animate-on-scroll">
                <div class="text-center">
                    <div class="mx-auto h-32 w-32 bg-gradient-to-r from-green-500 to-blue-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                        <svg class="h-16 w-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V9m0 3v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- FAQ 3: Services Aéroport - Icon Left, Text Right --}}
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
                <h3 class="text-3xl font-bold text-gray-900 mb-6">Transferts Aéroport Premium</h3>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Service spécialisé pour vos déplacements vers CDG, Orly et Beauvais. Suivi de vol en temps réel,
                    accueil personnalisé avec pancarte à votre nom, et ponctualité garantie.
                </p>
                <div class="space-y-4">
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-2">Suivi de vol</h4>
                        <p class="text-gray-600 text-sm">Adaptation automatique aux retards de vol.</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-2">Accueil VIP</h4>
                        <p class="text-gray-600 text-sm">Votre chauffeur vous attend avec une pancarte personnalisée.</p>
                    </div>
                    <div class="bg-white p-4 rounded-lg shadow-sm">
                        <h4 class="font-semibold text-gray-900 mb-2">Ponctualité</h4>
                        <p class="text-gray-600 text-sm">Arrivée 10 minutes avant l'heure prévue.</p>
                    </div>
                </div>
                <x-button href="{{ route('airports.index') }}" variant="primary" class="mt-6">
                    Découvrir nos aéroports
                </x-button>
            </div>
        </div>
    </div>
</section>

{{-- FAQ 4: Service Client - Icon Right, Text Left --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <h3 class="text-3xl font-bold text-gray-900 mb-6">Service Client 24/7</h3>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Notre équipe est disponible 24h/24 et 7j/7 pour répondre à vos questions et vous accompagner
                    dans vos réservations. Support multilingue pour une expérience internationale.
                </p>
                <div class="space-y-4">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-900 mb-2">Support téléphonique</h4>
                        <p class="text-gray-600 text-sm">Disponible 24h/24 pour urgences et modifications.</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-900 mb-2">Chat en ligne</h4>
                        <p class="text-gray-600 text-sm">Réponses instantanées sur notre site web.</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h4 class="font-semibold text-gray-900 mb-2">Email dédié</h4>
                        <p class="text-gray-600 text-sm">Réponse garantie sous 2h ouvrées.</p>
                    </div>
                </div>
                <x-button href="{{ route('contact') }}" variant="primary" class="mt-6">
                    Nous contacter
                </x-button>
            </div>
            <div class="animate-on-scroll">
                <div class="text-center">
                    <div class="mx-auto h-32 w-32 bg-gradient-to-r from-orange-500 to-red-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                        <svg class="h-16 w-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Complete FAQ Accordion Section --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl font-bold text-gray-900 mb-4">Toutes nos FAQ</h2>
            <p class="text-lg text-gray-600">Parcourez notre liste complète de questions fréquentes</p>
        </div>

        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="divide-y divide-gray-200">
                @foreach($faqs as $index => $faq)
                    <div class="faq-card">
                        <button class="accordion-button w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 focus:outline-none focus:bg-gray-50">
                            <span class="text-lg font-medium text-gray-900">{{ $faq['question'] }}</span>
                            <svg class="h-5 w-5 text-gray-500 transform transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="accordion-content">
                            <div class="px-6 pb-4">
                                <p class="text-gray-600 leading-relaxed">{{ $faq['answer'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
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
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Support 24/7
                </span>
            </div>

            <h2 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight animate-fade-in-up" style="animation-delay: 0.5s;">
                Encore des <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-orange-300 animate-gradient-x">Questions</span> ?
            </h2>

            <p class="text-xl sm:text-2xl text-blue-100 mb-12 max-w-3xl mx-auto leading-relaxed">
                Notre équipe d'experts est là pour vous accompagner. Contactez-nous pour toute question
                supplémentaire ou pour réserver votre prochain transfert.
            </p>

            {{-- Feature Highlights --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mb-12 max-w-4xl mx-auto">
                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-3 backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                    </div>
                    <h4 class="text-white font-semibold mb-1">Téléphone</h4>
                    <p class="text-blue-200 text-sm">24h/24 - 7j/7</p>
                </div>

                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-3 backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                    </div>
                    <h4 class="text-white font-semibold mb-1">Chat en ligne</h4>
                    <p class="text-blue-200 text-sm">Réponse instantanée</p>
                </div>

                <div class="flex flex-col items-center">
                    <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mb-3 backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h4 class="text-white font-semibold mb-1">Email</h4>
                    <p class="text-blue-200 text-sm">Sous 2h</p>
                </div>
            </div>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center animate-fade-in-up" style="animation-delay: 1s;">
                <a href="{{ route('contact') }}" class="group inline-flex items-center justify-center px-8 py-4 bg-white text-blue-600 text-lg font-bold rounded-full shadow-2xl hover:shadow-white/25 transition-all duration-300 transform hover:scale-105 hover:-translate-y-1 animate-pulse-glow">
                    <svg class="w-5 h-5 mr-3 group-hover:animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                    </svg>
                    Nous contacter
                </a>
                <a href="tel:+33123456789" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white/30 text-white text-lg font-medium rounded-full hover:bg-white/10 hover:border-white/50 transition-all duration-300 backdrop-blur-sm hover:animate-pulse">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    01 23 45 67 89
                </a>
            </div>

            <p class="mt-8 text-sm text-blue-200">
                Service disponible 24h/24 • Réponse garantie • Support multilingue
            </p>
        </div>
    </div>
</section>

@endsection
