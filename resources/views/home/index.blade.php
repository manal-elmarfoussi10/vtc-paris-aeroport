@extends('layouts.app')

{{--
    File: resources/views/home/index.blade.php
    Description: VISUAL OVERHAUL - Modern, engaging, and responsive home page.
                 Includes high-contrast sections, cards, and dynamic imagery.
--}}

@section('title', "Réservation VTC Paris | Transfert Aéroports CDG, Orly, Beauvais")
@section('description', "Réservez votre VTC à Paris et vers les aéroports (CDG, Orly, Beauvais) avec un service premium. Chauffeurs professionnels, tarifs fixes, disponibilité 24/7.")

@section('content')

    <header class="relative bg-dark-navy overflow-hidden">
        {{-- High-quality, subtle background image --}}
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover opacity-10" 
                 src="https://images.unsplash.com/photo-1549903072-5b7269fe2550?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                 alt="Voiture VTC de nuit à Paris avec la Tour Eiffel en fond">
        </div>
        
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24 sm:py-32 lg:py-40 text-white">
            <div class="lg:w-2/3">
                <h1 class="text-4xl sm:text-5xl lg:text-7xl font-extrabold tracking-tight">
                    <span class="text-blue-primary">L'Excellence</span> du VTC à Paris.
                </h1>
                <p class="mt-6 text-xl text-gray-200 leading-relaxed">
                    Transferts **CDG, Orly, Beauvais** sans surprise. Chauffeurs professionnels, tarifs fixes garantis, et service sur mesure 24h/24.
                </p>
                
                {{-- Booking CTA - More Prominent --}}
                <div class="mt-12 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('booking') }}" class="inline-flex items-center justify-center px-10 py-4 border border-transparent text-lg font-bold rounded-xl shadow-2xl text-white bg-blue-primary hover:bg-blue-700 transition duration-500 transform hover:scale-[1.05] focus:outline-none focus:ring-4 focus:ring-blue-primary/50" aria-label="Réserver un VTC maintenant">
                        Calculer mon Tarif Fixe
                    </a>
                    <a href="{{ route('services') }}" class="inline-flex items-center justify-center px-10 py-4 border border-white text-lg font-medium rounded-xl text-white hover:bg-white hover:text-dark-navy transition duration-500 transform hover:scale-[1.05] focus:outline-none focus:ring-4 focus:ring-white/50">
                        Découvrir nos Services
                    </a>
                </div>

                {{-- Feature Bar below Hero --}}
                <div class="mt-16 bg-white/10 backdrop-blur-sm p-6 rounded-xl shadow-2xl grid grid-cols-1 sm:grid-cols-3 gap-6">
                    <div class="flex items-center text-gray-200">
                        <svg class="h-6 w-6 text-blue-primary mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V9m0 3v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="font-medium">Tarif Fixe Garanti</span>
                    </div>
                    <div class="flex items-center text-gray-200">
                        <svg class="h-6 w-6 text-blue-primary mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        <span class="font-medium">Suivi de Vol 24/7</span>
                    </div>
                    <div class="flex items-center text-gray-200">
                        <svg class="h-6 w-6 text-blue-primary mr-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m0 0l2.67-2.67M17 9L7 19m10-10L7 19" /></svg>
                        <span class="font-medium">Accueil Personnalisé</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>

        <section id="services-cards" class="py-20 sm:py-32 bg-light-grey">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-extrabold text-dark-navy sm:text-5xl">
                        Nos Destinations Populaires
                    </h2>
                    <p class="mt-4 text-xl text-gray-600">
                        Transferts rapides et confortables vers et depuis les principaux pôles de Paris.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    {{-- Card 1: CDG Airport --}}
                    <div class="group relative overflow-hidden rounded-xl shadow-2xl transition duration-500 transform hover:scale-[1.03]">
                        <img class="w-full h-80 object-cover brightness-75 transition duration-500 group-hover:brightness-90" 
                             src="https://images.unsplash.com/photo-1579737678571-700995c61304?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                             alt="Aéroport Charles de Gaulle (CDG)">
                        <div class="absolute inset-0 bg-dark-navy/60 group-hover:bg-dark-navy/40 transition duration-500"></div>
                        <div class="absolute bottom-0 p-8 text-white">
                            <h3 class="text-3xl font-extrabold">Aéroport CDG</h3>
                            <p class="mt-2 text-gray-200">Le plus grand hub parisien. Transfert premium garanti en moins d'une heure.</p>
                            <a href="{{ route('airports.show', ['slug' => 'cdg']) }}" class="mt-4 inline-flex items-center text-blue-primary font-bold hover:text-blue-300 transition duration-300">
                                Réserver CDG &rarr;
                            </a>
                        </div>
                    </div>

                    {{-- Card 2: Orly Airport --}}
                    <div class="group relative overflow-hidden rounded-xl shadow-2xl transition duration-500 transform hover:scale-[1.03]">
                        <img class="w-full h-80 object-cover brightness-75 transition duration-500 group-hover:brightness-90" 
                             src="https://images.unsplash.com/photo-1544643729-39722b5123d2?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                             alt="Aéroport de Paris Orly (ORY)">
                        <div class="absolute inset-0 bg-dark-navy/60 group-hover:bg-dark-navy/40 transition duration-500"></div>
                        <div class="absolute bottom-0 p-8 text-white">
                            <h3 class="text-3xl font-extrabold">Aéroport Orly (ORY)</h3>
                            <p class="mt-2 text-gray-200">Accès rapide au sud de Paris. Parfait pour vos voyages d'affaires ou personnels.</p>
                            <a href="{{ route('airports.show', ['slug' => 'orly']) }}" class="mt-4 inline-flex items-center text-blue-primary font-bold hover:text-blue-300 transition duration-300">
                                Réserver Orly &rarr;
                            </a>
                        </div>
                    </div>

                    {{-- Card 3: Paris City/Gares --}}
                    <div class="group relative overflow-hidden rounded-xl shadow-2xl transition duration-500 transform hover:scale-[1.03]">
                        <img class="w-full h-80 object-cover brightness-75 transition duration-500 group-hover:brightness-90" 
                             src="https://images.unsplash.com/photo-1511739001486-6e20f4c089f2?q=80&w=1932&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                             alt="Gares et centre ville de Paris">
                        <div class="absolute inset-0 bg-dark-navy/60 group-hover:bg-dark-navy/40 transition duration-500"></div>
                        <div class="absolute bottom-0 p-8 text-white">
                            <h3 class="text-3xl font-extrabold">Paris Centre & Gares</h3>
                            <p class="mt-2 text-gray-200">Liaisons avec toutes les gares TGV (Nord, Lyon, Est...) et adresses intra-muros.</p>
                            <a href="{{ route('services') }}" class="mt-4 inline-flex items-center text-blue-primary font-bold hover:text-blue-300 transition duration-300">
                                Voir Services &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="cta-booking" class="bg-blue-primary">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 lg:flex lg:items-center lg:justify-between">
                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                    <span class="block">Prêt à un voyage premium ?</span>
                    <span class="block text-blue-200 mt-1">Réservez votre VTC sans attente ni surprise.</span>
                </h2>
                <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                    <div class="inline-flex rounded-xl shadow-2xl">
                        <a href="{{ route('booking') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-lg font-bold rounded-xl text-blue-primary bg-white hover:bg-gray-100 transition duration-300 focus:outline-none focus:ring-4 focus:ring-white/50" aria-label="Accéder au formulaire de réservation">
                            Calculer mon Tarif Fixe
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <section id="avantages" class="py-20 sm:py-32 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-extrabold text-dark-navy sm:text-5xl">
                        Notre Promesse Client
                    </h2>
                    <p class="mt-4 text-xl text-gray-600">
                        La différence VTC Paris : l'attention au détail et la sérénité.
                    </p>
                </div>
                <div class="mt-12 grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-4">

                    <div class="text-center p-6 rounded-xl transition duration-300 hover:bg-light-grey">
                        <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-primary text-white mx-auto shadow-lg">
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V9m0 3v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-dark-navy">Transparence Tarifaire</h3>
                        <p class="mt-2 text-gray-600">Le prix est fixé à la réservation, jamais de surprise, même en cas de trafic ou de détour.</p>
                    </div>

                    <div class="text-center p-6 rounded-xl transition duration-300 hover:bg-light-grey">
                        <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-primary text-white mx-auto shadow-lg">
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20h-5v-2a3 3 0 00-5.356-1.857M17 20v-2c0-.523-.13-1.033-.356-1.543m0 0a3.022 3.022 0 010-4.045M19 8a2 2 0 11-4 0 2 2 0 014 0zM7 12a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-dark-navy">Expertise Locale</h3>
                        <p class="mt-2 text-gray-600">Chauffeurs agréés VTC, professionnels, discrets et connaissant les itinéraires optimaux.</p>
                    </div>

                    <div class="text-center p-6 rounded-xl transition duration-300 hover:bg-light-grey">
                        <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-primary text-white mx-auto shadow-lg">
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-dark-navy">Flexibilité Totale</h3>
                        <p class="mt-2 text-gray-600">Le chauffeur ajuste son heure d'arrivée grâce au suivi de vol en direct. 60 min d'attente offertes.</p>
                    </div>

                    <div class="text-center p-6 rounded-xl transition duration-300 hover:bg-light-grey">
                        <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-primary text-white mx-auto shadow-lg">
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zM4 10h16M7 7h10M7 17h10" /></svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-dark-navy">Flotte de Luxe</h3>
                        <p class="mt-2 text-gray-600">Voyagez dans des berlines ou vans récents, confortables, et toujours d'une propreté impeccable.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="reviews" class="py-20 sm:py-32 bg-dark-navy">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-extrabold text-white sm:text-5xl">
                        Ce que disent nos clients
                    </h2>
                    <p class="mt-4 text-xl text-gray-400">
                        La meilleure preuve de notre qualité de service.
                    </p>
                </div>
                <div class="grid grid-cols-1 gap-8 md:grid-cols-3">
                    
                    {{-- Review 1 (Modern Card) --}}
                    <div class="bg-white p-8 rounded-2xl shadow-xl transition duration-500 hover:shadow-3xl hover:border-b-4 hover:border-blue-primary">
                        <svg class="h-8 w-8 text-blue-primary mb-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M9.2 19.4c0 1.2-.6 2.2-1.6 3-.7.5-1.5.8-2.5.8-1.7 0-3.3-1.1-4.2-2.7C.3 18.8 0 17.5 0 16.2c0-3.8 3.1-6.9 6.9-6.9 1.5 0 2.9.5 4 1.3V1.6c0-.9.7-1.6 1.6-1.6h.4c.9 0 1.6.7 1.6 1.6v9.4c0 .8-.5 1.5-1.2 1.9C11 13.9 9.8 14.5 9.2 15.6V19.4zm12 0c0 1.2-.6 2.2-1.6 3-.7.5-1.5.8-2.5.8-1.7 0-3.3-1.1-4.2-2.7-.9-1.5-1.2-2.8-1.2-4.1 0-3.8 3.1-6.9 6.9-6.9 1.5 0 2.9.5 4 1.3V1.6c0-.9.7-1.6 1.6-1.6h.4c.9 0 1.6.7 1.6 1.6v9.4c0 .8-.5 1.5-1.2 1.9C23 13.9 21.8 14.5 21.2 15.6V19.4z"/></svg>
                        <p class="text-lg italic text-gray-700">"La tranquillité d'esprit pour mes voyages d'affaires. Chauffeur à l'heure, voiture impeccable, et le tarif fixe est respecté. Service de qualité supérieure."</p>
                        <div class="mt-4 font-bold text-dark-navy">
                            Julie R. <span class="text-gray-500 font-normal">| Business Traveller</span>
                        </div>
                    </div>

                    {{-- Review 2 --}}
                    <div class="bg-white p-8 rounded-2xl shadow-xl transition duration-500 hover:shadow-3xl hover:border-b-4 hover:border-blue-primary">
                        <svg class="h-8 w-8 text-blue-primary mb-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M9.2 19.4c0 1.2-.6 2.2-1.6 3-.7.5-1.5.8-2.5.8-1.7 0-3.3-1.1-4.2-2.7C.3 18.8 0 17.5 0 16.2c0-3.8 3.1-6.9 6.9-6.9 1.5 0 2.9.5 4 1.3V1.6c0-.9.7-1.6 1.6-1.6h.4c.9 0 1.6.7 1.6 1.6v9.4c0 .8-.5 1.5-1.2 1.9C11 13.9 9.8 14.5 9.2 15.6V19.4zm12 0c0 1.2-.6 2.2-1.6 3-.7.5-1.5.8-2.5.8-1.7 0-3.3-1.1-4.2-2.7-.9-1.5-1.2-2.8-1.2-4.1 0-3.8 3.1-6.9 6.9-6.9 1.5 0 2.9.5 4 1.3V1.6c0-.9.7-1.6 1.6-1.6h.4c.9 0 1.6.7 1.6 1.6v9.4c0 .8-.5 1.5-1.2 1.9C23 13.9 21.8 14.5 21.2 15.6V19.4z"/></svg>
                        <p class="text-lg italic text-gray-700">"Le suivi de notre vol de New York était parfait. Notre chauffeur nous attendait avec une pancarte. Une expérience sans stress à l'arrivée à CDG."</p>
                        <div class="mt-4 font-bold text-dark-navy">
                            Thomas D. <span class="text-gray-500 font-normal">| Famille en Vacances</span>
                        </div>
                    </div>

                    {{-- Review 3 --}}
                    <div class="bg-white p-8 rounded-2xl shadow-xl transition duration-500 hover:shadow-3xl hover:border-b-4 hover:border-blue-primary">
                        <svg class="h-8 w-8 text-blue-primary mb-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24"><path d="M9.2 19.4c0 1.2-.6 2.2-1.6 3-.7.5-1.5.8-2.5.8-1.7 0-3.3-1.1-4.2-2.7C.3 18.8 0 17.5 0 16.2c0-3.8 3.1-6.9 6.9-6.9 1.5 0 2.9.5 4 1.3V1.6c0-.9.7-1.6 1.6-1.6h.4c.9 0 1.6.7 1.6 1.6v9.4c0 .8-.5 1.5-1.2 1.9C11 13.9 9.8 14.5 9.2 15.6V19.4zm12 0c0 1.2-.6 2.2-1.6 3-.7.5-1.5.8-2.5.8-1.7 0-3.3-1.1-4.2-2.7-.9-1.5-1.2-2.8-1.2-4.1 0-3.8 3.1-6.9 6.9-6.9 1.5 0 2.9.5 4 1.3V1.6c0-.9.7-1.6 1.6-1.6h.4c.9 0 1.6.7 1.6 1.6v9.4c0 .8-.5 1.5-1.2 1.9C23 13.9 21.8 14.5 21.2 15.6V19.4z"/></svg>
                        <p class="text-lg italic text-gray-700">"J'utilise leur service régulièrement pour mes clients VIP. La discrétion et le professionnalisme sont toujours au rendez-vous. Fortement recommandé."</p>
                        <div class="mt-4 font-bold text-dark-navy">
                            Marc L. <span class="text-gray-500 font-normal">| Conciergerie de Luxe</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        </main>

@endsection