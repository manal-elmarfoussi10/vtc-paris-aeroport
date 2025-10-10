@extends('layouts.app')

{{--
    File: resources/views/home/index.blade.php
    Description: Home page for VTC Paris Aéroport. Modern, responsive design with
                 Hero, Value Propositions, Services, Airport Links, Reviews, and CTA.
    Tech: Laravel Blade + Tailwind CSS CDN.
--}}

@section('title', "Réservation VTC Paris | Transfert Aéroports CDG, Orly, Beauvais")
@section('description', "Réservez votre VTC à Paris et vers les aéroports (CDG, Orly, Beauvais) avec un service premium. Chauffeurs professionnels, tarifs fixes, disponibilité 24/7.")

@section('content')

    <header class="relative bg-dark-navy overflow-hidden pt-16 sm:pt-24 lg:pt-32">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover opacity-20" src="https://images.unsplash.com/photo-1549903072-5b7269fe2550?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Voiture VTC de nuit à Paris avec la Tour Eiffel en fond">
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24 lg:py-32 text-white">
            <div class="lg:w-2/3">
                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight">
                    Votre VTC Premium à Paris et vers les Aéroports
                </h1>
                <p class="mt-6 text-xl text-gray-200 leading-relaxed">
                    Transferts **CDG, Orly, Beauvais** sans surprise. Chauffeurs professionnels, tarifs fixes garantis, et service sur mesure 24h/24.
                </p>
                <div class="mt-10 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('booking') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-base font-medium rounded-xl shadow-lg text-white bg-blue-primary hover:bg-blue-700 transition duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-primary focus:ring-offset-dark-navy" aria-label="Réserver un VTC maintenant">
                        Réserver Maintenant
                    </a>
                    <a href="{{ route('services') }}" class="inline-flex items-center justify-center px-8 py-4 border border-gray-400 text-base font-medium rounded-xl text-gray-200 hover:text-white hover:border-white transition duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-400 focus:ring-offset-dark-navy">
                        Découvrir nos Services
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main>

        <section id="avantages" class="py-16 sm:py-24 bg-light-grey">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-dark-navy sm:text-4xl">
                        Pourquoi choisir VTC Paris Aéroport ?
                    </h2>
                    <p class="mt-4 text-lg text-gray-600">
                        La garantie d'un voyage serein, de la réservation à l'arrivée.
                    </p>
                </div>
                <div class="mt-12 grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-4">

                    <div class="text-center bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                        <div class="flex items-center justify-center h-12 w-12 rounded-full bg-blue-primary text-white mx-auto">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V9m0 3v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold text-dark-navy">Tarifs Fixes et Sans Surprise</h3>
                        <p class="mt-2 text-gray-600">Le prix annoncé lors de la réservation est le prix final. Pas de frais cachés, même en cas de retard d'avion.</p>
                    </div>

                    <div class="text-center bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                        <div class="flex items-center justify-center h-12 w-12 rounded-full bg-blue-primary text-white mx-auto">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20h-5v-2a3 3 0 00-5.356-1.857M17 20v-2c0-.523-.13-1.033-.356-1.543m0 0a3.022 3.022 0 010-4.045M19 8a2 2 0 11-4 0 2 2 0 014 0zM7 12a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold text-dark-navy">Chauffeurs VTC Locaux Agréés</h3>
                        <p class="mt-2 text-gray-600">Des professionnels expérimentés, courtois et connaissant parfaitement Paris et ses accès aéroportuaires.</p>
                    </div>

                    <div class="text-center bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                        <div class="flex items-center justify-center h-12 w-12 rounded-full bg-blue-primary text-white mx-auto">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold text-dark-navy">Suivi des Vols en Temps Réel</h3>
                        <p class="mt-2 text-gray-600">Nous ajustons l'heure de prise en charge en cas de retard ou d'avance de votre vol. Un service sans stress.</p>
                    </div>

                    <div class="text-center bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition duration-300">
                        <div class="flex items-center justify-center h-12 w-12 rounded-full bg-blue-primary text-white mx-auto">
                            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                        </div>
                        <h3 class="mt-4 text-xl font-semibold text-dark-navy">Réservation en 3 Clics</h3>
                        <p class="mt-2 text-gray-600">Notre plateforme est optimisée pour une réservation rapide sur mobile ou ordinateur, sans création de compte obligatoire.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="services-airports" class="py-16 sm:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-2 gap-12">

                    <div class="bg-white p-8 rounded-xl shadow-xl">
                        <h2 class="text-3xl font-extrabold text-dark-navy sm:text-4xl">
                            Transferts Aéroports Simplifiés
                        </h2>
                        <p class="mt-4 text-lg text-gray-600">
                            Un service porte-à-porte premium pour tous les grands aéroports parisiens.
                        </p>
                        <ul class="mt-8 space-y-4">
                            <li class="flex items-start">
                                <span class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-blue-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </span>
                                <a href="{{ route('airports.show', ['slug' => 'cdg']) }}" class="ml-3 text-lg font-medium text-dark-navy hover:text-blue-primary transition duration-150">
                                    VTC Paris - Aéroport Charles de Gaulle (CDG)
                                </a>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-blue-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </span>
                                <a href="{{ route('airports.show', ['slug' => 'orly']) }}" class="ml-3 text-lg font-medium text-dark-navy hover:text-blue-primary transition duration-150">
                                    VTC Paris - Aéroport de Paris-Orly (ORY)
                                </a>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0">
                                    <svg class="h-6 w-6 text-blue-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                </span>
                                <a href="{{ route('airports.show', ['slug' => 'beauvais']) }}" class="ml-3 text-lg font-medium text-dark-navy hover:text-blue-primary transition duration-150">
                                    VTC Paris - Aéroport de Beauvais-Tillé (BVA)
                                </a>
                            </li>
                        </ul>
                        <div class="mt-8">
                            <a href="{{ route('airports') }}" class="text-blue-primary font-semibold hover:text-blue-700 transition duration-150 inline-flex items-center">
                                Voir tous les aéroports et gares
                                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                            </a>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-xl shadow-xl">
                        <h2 class="text-3xl font-extrabold text-dark-navy sm:text-4xl">
                            Plus que de simples transferts
                        </h2>
                        <p class="mt-4 text-lg text-gray-600">
                            Notre flotte est à votre disposition pour tous vos besoins professionnels et privés.
                        </p>
                        <ul class="mt-8 space-y-4">
                            <li class="flex items-start">
                                <span class="flex-shrink-0"><svg class="h-6 w-6 text-blue-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.593 23.593 0 0112 15c-1.854 0-3.649-.12-5.385-.345m18.77-5.91A14.996 14.996 0 0012 5.093c-2.457 0-4.823.33-7.054.965M4.5 19.5h15" /></svg></span>
                                <p class="ml-3 text-lg font-medium text-dark-navy">Transferts Business & Événements</p>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0"><svg class="h-6 w-6 text-blue-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg></span>
                                <p class="ml-3 text-lg font-medium text-dark-navy">Mise à Disposition (heure, demi-journée, journée)</p>
                            </li>
                            <li class="flex items-start">
                                <span class="flex-shrink-0"><svg class="h-6 w-6 text-blue-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z" /></svg></span>
                                <p class="ml-3 text-lg font-medium text-dark-navy">Trajets Longues Distances & Gares TGV</p>
                            </li>
                        </ul>
                        <div class="mt-8">
                            <a href="{{ route('services') }}" class="text-blue-primary font-semibold hover:text-blue-700 transition duration-150 inline-flex items-center">
                                Découvrez tous nos services VTC
                                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="cta-booking" class="bg-blue-primary">
            <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8 lg:flex lg:items-center lg:justify-between">
                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                    <span class="block">Prêt à voyager sans stress ?</span>
                    <span class="block text-indigo-200 mt-1">Obtenez votre devis en 30 secondes.</span>
                </h2>
                <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                    <div class="inline-flex rounded-xl shadow-lg">
                        <a href="{{ route('booking') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-lg font-medium rounded-xl text-blue-primary bg-white hover:bg-gray-100 transition duration-300 transform hover:scale-[1.05] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-blue-primary focus:ring-white" aria-label="Accéder au formulaire de réservation">
                            Calculer mon Tarif Fixe
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section id="reviews" class="py-16 sm:py-24 bg-light-grey">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-dark-navy sm:text-4xl">
                        Nos clients sont nos meilleurs ambassadeurs
                    </h2>
                    <p class="mt-4 text-lg text-gray-600">
                        Plus de 5000 trajets réussis entre Paris et ses aéroports.
                    </p>
                </div>
                <div class="mt-12 grid grid-cols-1 gap-8 md:grid-cols-3">
                    
                    <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-blue-primary">
                        <p class="text-xl italic text-gray-700">"Ponctualité impeccable et voiture très confortable pour mon transfert Orly. C'est mon nouveau service VTC de référence à Paris."</p>
                        <div class="mt-4 font-semibold text-dark-navy">
                            Marie L. - Business Traveler
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-blue-primary">
                        <p class="text-xl italic text-gray-700">"Le suivi de vol est rassurant. Le chauffeur m'attendait à CDG avec une pancarte. Service Premium qui justifie le prix fixe."</p>
                        <div class="mt-4 font-semibold text-dark-navy">
                            Thomas D. - Famille
                        </div>
                    </div>

                    <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-blue-primary">
                        <p class="text-xl italic text-gray-700">"J'ai apprécié la simplicité de la réservation et la courtoisie du chauffeur. Idéal pour un départ matinal vers Beauvais."</p>
                        <div class="mt-4 font-semibold text-dark-navy">
                            Sophie G. - Particulière
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="faq-teaser" class="py-16 sm:py-24">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center">
                    <h2 class="text-3xl font-extrabold text-dark-navy sm:text-4xl">
                        Des questions ? Nous avons les réponses.
                    </h2>
                </div>
                <div class="mt-12 space-y-4 max-w-3xl mx-auto">
                    <details class="bg-white p-4 rounded-xl shadow-md cursor-pointer group">
                        <summary class="flex justify-between items-center font-medium text-dark-navy focus:outline-none">
                            Quel est le temps d'attente inclus dans le tarif ?
                            <span class="ml-6 transition group-open:rotate-180">
                                <svg class="h-5 w-5 text-blue-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </span>
                        </summary>
                        <p class="mt-2 text-gray-600">
                            Pour un transfert aéroport, le temps d'attente est inclus après l'atterrissage : **60 minutes offertes** à CDG/Orly/Beauvais. Pour les adresses, **15 minutes** sont incluses. Cela vous laisse largement le temps de récupérer vos bagages.
                        </p>
                    </details>
                    
                    <details class="bg-white p-4 rounded-xl shadow-md cursor-pointer group">
                        <summary class="flex justify-between items-center font-medium text-dark-navy focus:outline-none">
                            Puis-je modifier ou annuler ma réservation ?
                            <span class="ml-6 transition group-open:rotate-180">
                                <svg class="h-5 w-5 text-blue-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </span>
                        </summary>
                        <p class="mt-2 text-gray-600">
                            Oui, vous pouvez annuler votre VTC gratuitement jusqu'à 2 heures avant l'heure de prise en charge prévue (48 heures pour les Vans). Toutes les modifications peuvent être demandées via votre Espace Client.
                        </p>
                    </details>

                </div>
                <div class="mt-10 text-center">
                    <a href="{{ route('faq') }}" class="text-lg font-semibold text-blue-primary hover:text-blue-700 transition duration-150 inline-flex items-center">
                        Consulter la FAQ complète
                        <svg class="ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" /></svg>
                    </a>
                </div>
            </div>
        </section>

    </main>

    {{-- The footer will be included by the 'layouts.app' file --}}

@endsection

@once
    {{-- This section is only for the CDN setup, placed typically in layouts/app.blade.php's <head> --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'blue-primary': '#1D4ED8', // Primary Blue
                        'dark-navy': '#0F172A', // Dark Navy
                        'light-grey': '#F8FAFC', // Light Grey (Tailwind slate-50)
                    }
                }
            }
        }
    </script>
@endonce