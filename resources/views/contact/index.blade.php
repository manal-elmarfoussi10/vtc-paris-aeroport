@extends('layouts.app')

@section('title', 'Contact - VTC Paris Aéroport')
@section('description', 'Contactez notre service client VTC. Réservations, questions, support 24h/24. Réponse sous 2h.')

@section('head')
<style>
/* Custom styles for contact page */
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

@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
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

/* Contact card hover effects */
.contact-card {
    transition: all 0.3s ease;
    transform: translateY(0);
}

.contact-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

/* Form animations */
.form-group {
    opacity: 0;
    transform: translateY(20px);
    transition: all 0.5s ease-out;
}

.form-group.animate {
    opacity: 1;
    transform: translateY(0);
}

/* Custom gradient backgrounds */
.cta-gradient {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}

/* Floating elements */
.floating-element {
    animation: float 6s ease-in-out infinite;
}

/* Interactive form focus */
.form-input:focus {
    transform: scale(1.02);
    box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
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

    // Add staggered animations to form groups
    const formGroups = document.querySelectorAll('.form-group');
    formGroups.forEach((group, index) => {
        setTimeout(() => {
            group.classList.add('animate');
        }, index * 100);
    });

    // Add staggered animations to contact sections
    const contactSections = document.querySelectorAll('.animate-on-scroll');
    contactSections.forEach((section, index) => {
        section.style.transitionDelay = `${index * 0.2}s`;
    });

    // Form input animations
    document.querySelectorAll('.form-input').forEach(input => {
        input.addEventListener('focus', function() {
            this.classList.add('focused');
        });
        input.addEventListener('blur', function() {
            this.classList.remove('focused');
        });
    });
});
</script>
@endsection

@section('content')

{{-- Proposition Header --}}
<section class="bg-gradient-to-r from-blue-600 via-blue-700 to-blue-800 text-white pt-40 py-20 relative overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full bg-white opacity-5 transform rotate-12 scale-150 animate-pulse" style="animation-duration: 8s;"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-white rounded-full opacity-5 -translate-y-48 translate-x-48 animate-pulse" style="animation-duration: 10s; animation-delay: 2s;"></div>
        <div class="absolute top-1/2 left-1/2 w-64 h-64 bg-blue-300 rounded-full opacity-5 -translate-x-1/2 -translate-y-1/2 animate-pulse" style="animation-duration: 12s; animation-delay: 4s;"></div>
    </div>

    {{-- Floating Elements --}}
    <div class="absolute inset-0 overflow-hidden">
        <div class="absolute top-20 left-20 w-4 h-4 bg-white rounded-full opacity-20 floating-element" style="animation-delay: 1s;"></div>
        <div class="absolute top-40 right-40 w-3 h-3 bg-blue-200 rounded-full opacity-15 floating-element" style="animation-delay: 3s;"></div>
        <div class="absolute bottom-32 left-32 w-2 h-2 bg-white rounded-full opacity-25 floating-element" style="animation-delay: 2s;"></div>
        <div class="absolute bottom-20 right-20 w-5 h-5 bg-blue-100 rounded-full opacity-10 floating-element" style="animation-delay: 4s;"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold mb-6">
            Contactez-<span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-orange-300 animate-gradient-x">nous</span>
        </h1>
        <p class="text-xl sm:text-2xl text-blue-100 max-w-3xl mx-auto leading-relaxed">
            Notre équipe d'experts est là pour vous accompagner. Questions, réservations, support technique :
            nous répondons à toutes vos demandes avec professionnalisme et rapidité.
        </p>
    </div>
</section>

{{-- Title Section --}}
<section class="mt-1 py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-6">
            Plusieurs Façons de Nous Joindre
        </h2>
        <p class="text-lg text-gray-600 max-w-3xl mx-auto leading-relaxed">
            Choisissez le canal qui vous convient le mieux. Notre équipe multilingue est disponible
            24h/24 pour vous offrir la meilleure expérience client possible.
        </p>
    </div>
</section>

{{-- Contact Methods Section --}}
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mb-16">
            {{-- Phone Contact --}}
            <div class="contact-card bg-white rounded-2xl shadow-lg p-8 text-center animate-on-scroll">
                <div class="mx-auto h-20 w-20 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">Téléphone</h3>
                <p class="text-gray-600 mb-6">Réponse immédiate pour vos urgences et réservations</p>
                <div class="space-y-3">
                    <p class="text-2xl font-bold text-blue-600">+33 1 23 45 67 89</p>
                    <p class="text-sm text-gray-500">Disponible 24h/24 - 7j/7</p>
                </div>
                <a href="tel:+33123456789" class="inline-flex items-center justify-center w-full mt-6 px-6 py-3 bg-blue-600 text-white font-medium rounded-full hover:bg-blue-700 transition duration-300">
                    Appeler maintenant
                </a>
            </div>

            {{-- WhatsApp Contact --}}
            <div class="contact-card bg-white rounded-2xl shadow-lg p-8 text-center animate-on-scroll">
                <div class="mx-auto h-20 w-20 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                    <svg class="h-10 w-10 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">WhatsApp</h3>
                <p class="text-gray-600 mb-6">Communication instantanée avec nos experts</p>
                <div class="space-y-3">
                    <p class="text-2xl font-bold text-green-600">WhatsApp Business</p>
                    <p class="text-sm text-gray-500">Réponse sous 5 minutes</p>
                </div>
                <a href="https://wa.me/33123456789" target="_blank" class="inline-flex items-center justify-center w-full mt-6 px-6 py-3 bg-green-600 text-white font-medium rounded-full hover:bg-green-700 transition duration-300">
                    Écrire sur WhatsApp
                </a>
            </div>

            {{-- Email Contact --}}
            <div class="contact-card bg-white rounded-2xl shadow-lg p-8 text-center animate-on-scroll">
                <div class="mx-auto h-20 w-20 bg-gradient-to-r from-purple-500 to-pink-600 rounded-full flex items-center justify-center mb-6 shadow-lg">
                    <svg class="h-10 w-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-4">E-mail</h3>
                <p class="text-gray-600 mb-6">Pour les demandes détaillées et les devis</p>
                <div class="space-y-3">
                    <p class="text-lg font-bold text-purple-600">contact@vtc-paris-aeroport.fr</p>
                    <p class="text-sm text-gray-500">Réponse sous 2h ouvrées</p>
                </div>
                <a href="mailto:contact@vtc-paris-aeroport.fr" class="inline-flex items-center justify-center w-full mt-6 px-6 py-3 bg-purple-600 text-white font-medium rounded-full hover:bg-purple-700 transition duration-300">
                    Envoyer un e-mail
                </a>
            </div>
        </div>

        {{-- Contact Form Section --}}
        <div class="bg-white rounded-2xl shadow-xl p-8 lg:p-12">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Formulaire de Contact</h2>
                <p class="text-lg text-gray-600">Remplissez ce formulaire et nous vous répondrons dans les plus brefs délais</p>
            </div>

            <form method="POST" action="{{ route('contact.send') }}" class="max-w-4xl mx-auto">
                @csrf

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                    {{-- Name --}}
                    <div class="form-group">
                        <x-input-label for="name" value="Nom complet *" />
                        <x-text-input id="name" name="name" type="text"
                            class="form-input mt-1 block w-full transition-all duration-300"
                            :value="old('name')"
                            required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <x-input-label for="email" value="Adresse e-mail *" />
                        <x-text-input id="email" name="email" type="email"
                            class="form-input mt-1 block w-full transition-all duration-300"
                            :value="old('email')"
                            required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Phone --}}
                    <div class="form-group">
                        <x-input-label for="phone" value="Téléphone" />
                        <x-text-input id="phone" name="phone" type="tel"
                            class="form-input mt-1 block w-full transition-all duration-300"
                            :value="old('phone')"
                            placeholder="+33 6 XX XX XX XX" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    {{-- Subject --}}
                    <div class="form-group">
                        <x-input-label for="subject" value="Sujet *" />
                        <x-select id="subject" name="subject" class="form-input mt-1 block w-full transition-all duration-300" required>
                            <option value="">Sélectionner un sujet</option>
                            <option value="booking" {{ old('subject') == 'booking' ? 'selected' : '' }}>Réservation</option>
                            <option value="pricing" {{ old('subject') == 'pricing' ? 'selected' : '' }}>Tarifs et devis</option>
                            <option value="modification" {{ old('subject') == 'modification' ? 'selected' : '' }}>Modification de réservation</option>
                            <option value="complaint" {{ old('subject') == 'complaint' ? 'selected' : '' }}>Réclamation</option>
                            <option value="partnership" {{ old('subject') == 'partnership' ? 'selected' : '' }}>Partenariat</option>
                            <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Autre</option>
                        </x-select>
                        <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                    </div>
                </div>

                {{-- Message --}}
                <div class="form-group mb-8">
                    <x-input-label for="message" value="Message *" />
                    <textarea id="message" name="message" rows="6"
                        class="form-input mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm transition-all duration-300"
                        placeholder="Décrivez votre demande en détail..."
                        required>{{ old('message') }}</textarea>
                    <x-input-error :messages="$errors->get('message')" class="mt-2" />
                </div>

                {{-- Submit --}}
                <div class="text-center">
                    <x-primary-button class="px-12 py-4 text-lg font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300">
                        Envoyer le message
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</section>

{{-- Response Time & Features Section --}}
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="animate-on-scroll">
                <h3 class="text-3xl font-bold text-gray-900 mb-6">Service Client d'Exception</h3>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    Notre engagement qualité se traduit par des délais de réponse records et un accompagnement
                    personnalisé à chaque étape de votre expérience avec nous.
                </p>

                <div class="space-y-6">
                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center">
                            <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">Réponse garantie</h4>
                            <p class="text-gray-600">Sous 2h pour les e-mails, immédiate pour le téléphone</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center">
                            <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
                            <h4 class="text-lg font-semibold text-gray-900">Support multilingue</h4>
                            <p class="text-gray-600">Français, Anglais, Espagnol, Italien, Allemand</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex-shrink-0 h-12 w-12 bg-purple-100 rounded-lg flex items-center justify-center">
                            <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="ml-4">
