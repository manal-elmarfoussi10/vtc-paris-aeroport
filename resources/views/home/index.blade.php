@extends('layouts.app')

{{--
    File: resources/views/home/index.blade.php
    Description: FULL SCREEN VIDEO BACKGROUND + LINGUANA STYLE CONTENT SECTIONS
--}}

@section('title', "Réservation VTC Paris | Transfert Aéroports CDG, Orly, Beauvais")
@section('description', "Service VTC premium à Paris et vers les aéroports. Chauffeurs professionnels, tarifs fixes garantis, et service sur mesure 24h/24.")

@section('content')

    <header class="relative w-full h-screen overflow-hidden bg-dark-navy"> {{-- h-screen ensures full viewport height --}}
        
        {{-- Video Background Container --}}
        <div class="absolute inset-0 z-0">
            <video autoplay loop muted playsinline class="w-full h-full object-cover">
                <source src="{{ asset('video_bg.mp4') }}" type="video/mp4">
                {{-- Fallback image for older browsers or if video doesn't load --}}
                <img src="https://images.unsplash.com/photo-1596707323116-24e5a95400d7?q=80&w=2070&auto=format&fit=crop" 
                     alt="Luxury VTC sedan in Paris at night" 
                     class="w-full h-full object-cover">
                Your browser does not support the video tag.
            </video>
        </div>

        {{-- Dark Overlay for Readability (Crucial) --}}
        <div class="absolute inset-0 bg-dark-navy/60 z-10"></div>
        
        {{-- Content Container (Z-20 must be higher than overlay) --}}
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-full flex items-center pt-20 z-20 text-white">
            <div class="lg:w-2/3">
                <h1 class="text-5xl sm:text-7xl lg:text-8xl font-extrabold tracking-tight">
                    <span class="text-blue-primary">Service VTC</span> <br>Premium à Paris.
                </h1>
                <p class="mt-6 text-xl text-gray-200 leading-relaxed max-w-xl">
                    Transferts **CDG, Orly, Beauvais** sans surprise. L'élégance, la ponctualité, et le professionnalisme.
                </p>
                
                {{-- Booking CTA --}}
                <div class="mt-12 flex flex-col sm:flex-row gap-4">
                    <a href="{{ route('booking') }}" class="inline-flex items-center justify-center px-10 py-4 border border-transparent text-lg font-bold rounded-full shadow-2xl text-white bg-blue-primary hover:bg-blue-700 transition duration-300 transform hover:scale-105 animate-pulse-once" aria-label="Réserver un VTC maintenant">
                        Calculer mon Tarif Fixe
                    </a>
                    <a href="{{ route('services') }}" class="inline-flex items-center justify-center px-10 py-4 border border-white text-lg font-medium rounded-full text-white hover:bg-white hover:text-dark-navy transition duration-300 transform hover:scale-105">
                        Découvrir la Flotte
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main>
        
        <section class="bg-dark-navy -mt-20 relative z-20"> {{-- Negative margin pulls it up over the video section --}}
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="bg-white/10 backdrop-blur-sm p-6 rounded-t-2xl shadow-2xl grid grid-cols-1 sm:grid-cols-3 divide-y sm:divide-y-0 sm:divide-x divide-white/20">
                    <div class="flex flex-col items-center py-4 text-gray-200">
                        <svg class="h-8 w-8 text-blue-primary mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V9m0 3v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span class="font-bold text-lg">Tarif Fixe</span>
                    </div>
                    <div class="flex flex-col items-center py-4 text-gray-200">
                        <svg class="h-8 w-8 text-blue-primary mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        <span class="font-bold text-lg">24/7 & Suivi Vol</span>
                    </div>
                    <div class="flex flex-col items-center py-4 text-gray-200">
                        <svg class="h-8 w-8 text-blue-primary mb-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m0 0l2.67-2.67M17 9L7 19m10-10L7 19" /></svg>
                        <span class="font-bold text-lg">Accueil Personnalisé</span>
                    </div>
                </div>
            </div>
        </section>

        <section id="vehicle-showcase" class="py-20 sm:py-32 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-extrabold text-dark-navy sm:text-5xl">
                        Notre Flotte Exclusive
                    </h2>
                    <p class="mt-4 text-xl text-gray-600 max-w-3xl mx-auto">
                        Voyagez en toute discrétion et confort. Tous nos véhicules sont récents et équipés pour votre sérénité.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">

                    {{-- Vehicle 1: Sedan (Business Class) --}}
                    <div class="group overflow-hidden rounded-2xl shadow-3xl transition duration-500 transform hover:scale-[1.03] border border-gray-100">
                        <img class="w-full h-64 object-cover object-center transition duration-500 group-hover:opacity-85" 
                             src="https://images.unsplash.com/photo-1583091000639-68892d242250?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                             alt="Luxury Sedan VTC">
                        <div class="p-6 bg-white">
                            <h3 class="text-2xl font-bold text-dark-navy">Berline Affaires</h3>
                            <p class="mt-2 text-gray-600">Mercedes Classe E, BMW Série 5 ou équivalent. Idéal pour 1 à 3 passagers.</p>
                            <span class="mt-3 inline-block text-sm font-semibold text-blue-primary">
                                Transferts Aéroports / Gares
                            </span>
                        </div>
                    </div>

                    {{-- Vehicle 2: Van (Group/Family Class) --}}
                    <div class="group overflow-hidden rounded-2xl shadow-3xl transition duration-500 transform hover:scale-[1.03] border border-gray-100">
                        <img class="w-full h-64 object-cover object-center transition duration-500 group-hover:opacity-85" 
                             src="https://images.unsplash.com/photo-1628107567706-e7e0e7a2b91d?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                             alt="Luxury VTC Van">
                        <div class="p-6 bg-white">
                            <h3 class="text-2xl font-bold text-dark-navy">Van Familial / VIP</h3>
                            <p class="mt-2 text-gray-600">Mercedes Classe V ou équivalent. Jusqu'à 7 passagers et leurs bagages.</p>
                            <span class="mt-3 inline-block text-sm font-semibold text-blue-primary">
                                Événementiel / Mise à Disposition
                            </span>
                        </div>
                    </div>
                    
                    {{-- Vehicle 3: S-Class (VIP/Luxe Class) --}}
                    <div class="group overflow-hidden rounded-2xl shadow-3xl transition duration-500 transform hover:scale-[1.03] border border-gray-100">
                        <img class="w-full h-64 object-cover object-center transition duration-500 group-hover:opacity-85" 
                             src="https://images.unsplash.com/photo-1563276632-4e0055278065?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                             alt="Luxury S-Class VTC">
                        <div class="p-6 bg-white">
                            <h3 class="text-2xl font-bold text-dark-navy">Berline Luxe</h3>
                            <p class="mt-2 text-gray-600">Mercedes Classe S ou équivalent. Le summum du confort et du prestige.</p>
                            <span class="mt-3 inline-block text-sm font-semibold text-blue-primary">
                                Voyage d'Affaires / VIP
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="services-cards" class="py-20 sm:py-32 bg-light-grey">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-extrabold text-dark-navy sm:text-5xl">
                        Nos Zones d'Intervention
                    </h2>
                    <p class="mt-4 text-xl text-gray-600">
                        Service de navette VTC vers les principaux aéroports de Paris et la Région Île-de-France.
                    </p>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">

                    {{-- Card 1: CDG Airport --}}
                    <div class="group relative overflow-hidden rounded-xl shadow-2xl transition duration-500 transform hover:scale-[1.03] hover:ring-4 hover:ring-blue-primary">
                        <img class="w-full h-80 object-cover brightness-75 transition duration-500 group-hover:brightness-90" 
                             src="https://images.unsplash.com/photo-1579737678571-700995c61304?q=80&w=1964&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                             alt="Aéroport Charles de Gaulle (CDG)">
                        <div class="absolute inset-0 bg-dark-navy/60 group-hover:bg-dark-navy/40 transition duration-500"></div>
                        <div class="absolute bottom-0 p-8 text-white">
                            <h3 class="text-3xl font-extrabold">Aéroport CDG</h3>
                            <p class="mt-2 text-gray-200">Paris Charles de Gaulle. Navette VTC directe et rapide.</p>
                            <a href="{{ route('airports.show', ['slug' => 'cdg']) }}" class="mt-4 inline-flex items-center text-blue-primary font-bold hover:text-blue-300 transition duration-300">
                                Voir Tarifs &rarr;
                            </a>
                        </div>
                    </div>

                    {{-- Card 2: Orly Airport --}}
                    <div class="group relative overflow-hidden rounded-xl shadow-2xl transition duration-500 transform hover:scale-[1.03] hover:ring-4 hover:ring-blue-primary">
                        <img class="w-full h-80 object-cover brightness-75 transition duration-500 group-hover:brightness-90" 
                             src="https://images.unsplash.com/photo-1544643729-39722b5123d2?q=80&w=1974&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                             alt="Aéroport de Paris Orly (ORY)">
                        <div class="absolute inset-0 bg-dark-navy/60 group-hover:bg-dark-navy/40 transition duration-500"></div>
                        <div class="absolute bottom-0 p-8 text-white">
                            <h3 class="text-3xl font-extrabold">Aéroport Orly (ORY)</h3>
                            <p class="mt-2 text-gray-200">Accès au sud de Paris. Votre chauffeur vous attendra à la sortie.</p>
                            <a href="{{ route('airports.show', ['slug' => 'orly']) }}" class="mt-4 inline-flex items-center text-blue-primary font-bold hover:text-blue-300 transition duration-300">
                                Voir Tarifs &rarr;
                            </a>
                        </div>
                    </div>

                    {{-- Card 3: Beauvais-Tillé Airport --}}
                    <div class="group relative overflow-hidden rounded-xl shadow-2xl transition duration-500 transform hover:scale-[1.03] hover:ring-4 hover:ring-blue-primary">
                        <img class="w-full h-80 object-cover brightness-75 transition duration-500 group-hover:brightness-90" 
                             src="https://images.unsplash.com/photo-1549477017-d7756f7e1b9b?q=80&w=2070&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" 
                             alt="Aéroport de Beauvais-Tillé (BVA)">
                        <div class="absolute inset-0 bg-dark-navy/60 group-hover:bg-dark-navy/40 transition duration-500"></div>
                        <div class="absolute bottom-0 p-8 text-white">
                            <h3 class="text-3xl font-extrabold">Beauvais-Tillé (BVA)</h3>
                            <p class="mt-2 text-gray-200">Service de transfert dédié aux vols Low-Cost. Confort garanti.</p>
                            <a href="{{ route('airports.show', ['slug' => 'beauvais']) }}" class="mt-4 inline-flex items-center text-blue-primary font-bold hover:text-blue-300 transition duration-300">
                                Voir Tarifs &rarr;
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="avantages" class="py-20 sm:py-32 bg-dark-navy">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-extrabold text-white sm:text-5xl">
                        Pourquoi Choisir VTC Paris Aéroport ?
                    </h2>
                    <p class="mt-4 text-xl text-gray-400">
                        La différence VTC Paris : l'attention au détail et la sérénité.
                    </p>
                </div>
                <div class="mt-12 grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-4">

                    <div class="text-center p-6 rounded-xl border border-blue-primary/50 bg-dark-navy/50 transition duration-300 hover:bg-dark-navy/80 hover:shadow-2xl hover:shadow-blue-primary/20">
                        <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-primary text-white mx-auto shadow-lg">
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8V9m0 3v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-white">Tarif Fixe Garanti</h3>
                        <p class="mt-2 text-gray-400">Pas de compteur, pas de surprise. Le prix affiché est le prix payé.</p>
                    </div>

                    <div class="text-center p-6 rounded-xl border border-blue-primary/50 bg-dark-navy/50 transition duration-300 hover:bg-dark-navy/80 hover:shadow-2xl hover:shadow-blue-primary/20">
                        <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-primary text-white mx-auto shadow-lg">
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20h-5v-2a3 3 0 00-5.356-1.857M17 20v-2c0-.523-.13-1.033-.356-1.543m0 0a3.022 3.022 0 010-4.045M19 8a2 2 0 11-4 0 2 2 0 014 0zM7 12a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-white">Chauffeurs Certifiés</h3>
                        <p class="mt-2 text-gray-400">Professionnels, discrets, élégants, et toujours à l'heure pour votre prise en charge.</p>
                    </div>

                    <div class="text-center p-6 rounded-xl border border-blue-primary/50 bg-dark-navy/50 transition duration-300 hover:bg-dark-navy/80 hover:shadow-2xl hover:shadow-blue-primary/20">
                        <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-primary text-white mx-auto shadow-lg">
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1v-2zM4 10h16M7 7h10M7 17h10" /></svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-white">Véhicules de Luxe</h3>
                        <p class="mt-2 text-gray-400">Flotte haut de gamme, entretenue, et offrant un confort maximal pour tous vos trajets.</p>
                    </div>

                    <div class="text-center p-6 rounded-xl border border-blue-primary/50 bg-dark-navy/50 transition duration-300 hover:bg-dark-navy/80 hover:shadow-2xl hover:shadow-blue-primary/20">
                        <div class="flex items-center justify-center h-16 w-16 rounded-full bg-blue-primary text-white mx-auto shadow-lg">
                            <svg class="h-8 w-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="mt-6 text-xl font-bold text-white">Disponible 24h/24</h3>
                        <p class="mt-2 text-gray-400">Un service client réactif pour vos réservations ou modifications, de jour comme de nuit.</p>
                    </div>
                </div>
            </div>
        </section>


        <section id="cta-booking" class="bg-blue-primary">
            <div class="max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8 lg:flex lg:items-center lg:justify-between">
                <h2 class="text-3xl font-extrabold tracking-tight text-white sm:text-4xl">
                    <span class="block">Calculez votre prix fixe en 30 secondes.</span>
                    <span class="block text-blue-200 mt-1">Réservez en ligne et gagnez du temps.</span>
                </h2>
                <div class="mt-8 flex lg:mt-0 lg:flex-shrink-0">
                    <div class="inline-flex rounded-full shadow-2xl">
                        <a href="{{ route('booking') }}" class="inline-flex items-center justify-center px-8 py-4 border border-transparent text-lg font-bold rounded-full text-blue-primary bg-white hover:bg-gray-100 transition duration-300 focus:outline-none focus:ring-4 focus:ring-white/50" aria-label="Accéder au formulaire de réservation">
                            Je Réserve Mon VTC
                        </a>
                    </div>
                </div>
            </div>
        </section>

    </main>
@endsection