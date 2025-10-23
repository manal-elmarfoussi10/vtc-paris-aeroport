@extends('layouts.app')

@section('title', 'Aéroports Paris - Transferts VTC CDG, Orly, Beauvais')
@section('description', 'Service de transfert VTC vers tous les aéroports parisiens. Réservation en ligne, tarifs fixes, service premium.')

@section('content')
<div class="min-h-screen bg-light-grey py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Transferts Aéroports</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Service de transport privé vers les principaux aéroports parisiens. Réservation en ligne, chauffeur professionnel, suivi de vol en temps réel.
            </p>
        </div>

        {{-- Airports Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
            @foreach($airports as $airport)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-8">
                        <div class="text-center mb-6">
                            <div class="mx-auto h-16 w-16 bg-blue-primary rounded-full flex items-center justify-center mb-4">
                                <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                </svg>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-1">{{ $airport->name }}</h3>
                            <p class="text-blue-primary font-medium">{{ $airport->code }}</p>
                        </div>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Transfert vers Paris:</span>
                                <span class="font-semibold text-gray-900">À partir de {{ number_format($airport->base_rate_to_paris, 0, ',', ' ') }}€</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Temps de trajet:</span>
                                <span class="font-semibold text-gray-900">{{ $airport->transfer_time_city }} min</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Temps d'attente:</span>
                                <span class="font-semibold text-gray-900">{{ $airport->transfer_time_airport }} min</span>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <x-button href="{{ route('airports.show', $airport->slug) }}" variant="outline" class="w-full">
                                En savoir plus
                            </x-button>
                            <x-button href="{{ route('booking') }}" variant="primary" class="w-full">
                                Réserver
                            </x-button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Features --}}
        <div class="bg-white rounded-lg shadow-lg p-8 mb-12">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Notre service aéroport</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div class="text-center">
                    <div class="mx-auto h-12 w-12 bg-green-100 rounded-lg flex items-center justify-center mb-3">
                        <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Suivi de vol</h3>
                    <p class="text-sm text-gray-600">Adaptation en temps réel aux retards</p>
                </div>

                <div class="text-center">
                    <div class="mx-auto h-12 w-12 bg-blue-100 rounded-lg flex items-center justify-center mb-3">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Accueil personnalisé</h3>
                    <p class="text-sm text-gray-600">Pancarte à votre nom</p>
                </div>

                <div class="text-center">
                    <div class="mx-auto h-12 w-12 bg-purple-100 rounded-lg flex items-center justify-center mb-3">
                        <svg class="h-6 w-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Ponctualité</h3>
                    <p class="text-sm text-gray-600">Arrivée 10 min avant l'heure</p>
                </div>

                <div class="text-center">
                    <div class="mx-auto h-12 w-12 bg-orange-100 rounded-lg flex items-center justify-center mb-3">
                        <svg class="h-6 w-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="font-semibold text-gray-900 mb-1">Véhicules premium</h3>
                    <p class="text-sm text-gray-600">Climatisation, WiFi, confort</p>
                </div>
            </div>
        </div>

        {{-- CTA Section --}}
        <div class="bg-blue-primary rounded-lg p-8 text-center text-white">
            <h2 class="text-3xl font-bold mb-4">Besoin d'un transfert ?</h2>
            <p class="text-xl mb-6 text-blue-100">Réservez en ligne en quelques clics</p>
            <x-button href="{{ route('booking') }}" variant="secondary" size="lg">
                Calculer mon tarif
            </x-button>
        </div>
    </div>
</div>
@endsection
