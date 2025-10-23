@extends('layouts.app')

@section('title', 'Services VTC - Transferts Aéroports Paris')
@section('description', 'Découvrez nos services de transport privé : transferts aéroports, mise à disposition, business et événements. Service premium 24h/24.')

@section('content')
<div class="min-h-screen bg-light-grey py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Nos Services</h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Service de transport privé premium adapté à tous vos besoins. De l'aéroport aux événements spéciaux, nous vous accompagnons partout à Paris.
            </p>
        </div>

        {{-- Services Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-16">
            @foreach($services as $service)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-8">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0 h-12 w-12 bg-blue-primary rounded-lg flex items-center justify-center">
                                @switch($service->icon)
                                    @case('plane')
                                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                                        </svg>
                                        @break
                                    @case('clock')
                                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        @break
                                    @case('briefcase')
                                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m8 0V8a2 2 0 01-2 2H8a2 2 0 01-2-2V6m8 0H8"></path>
                                        </svg>
                                        @break
                                    @case('calendar')
                                        <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                        @break
                                @endswitch
                            </div>
                            <div class="ml-4">
                                <h3 class="text-xl font-bold text-gray-900">{{ $service->name }}</h3>
                                @if($service->subtitle)
                                    <p class="text-sm text-blue-primary font-medium">{{ $service->subtitle }}</p>
                                @endif
                            </div>
                        </div>

                        <p class="text-gray-600 mb-6 leading-relaxed">{{ $service->description }}</p>

                        <x-button href="{{ route('booking') }}" variant="primary" class="w-full">
                            Réserver maintenant
                        </x-button>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Why Choose Us --}}
        <div class="bg-white rounded-lg shadow-lg p-8 mb-12">
            <h2 class="text-3xl font-bold text-center text-gray-900 mb-8">Pourquoi nous choisir ?</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="mx-auto h-16 w-16 bg-blue-primary rounded-full flex items-center justify-center mb-4">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Ponctualité</h3>
                    <p class="text-gray-600">Chauffeurs expérimentés, véhicules entretenus, suivi GPS en temps réel.</p>
                </div>

                <div class="text-center">
                    <div class="mx-auto h-16 w-16 bg-blue-primary rounded-full flex items-center justify-center mb-4">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Chauffeurs professionnels</h3>
                    <p class="text-gray-600">Équipe formée, discrète et à votre service 24h/24.</p>
                </div>

                <div class="text-center">
                    <div class="mx-auto h-16 w-16 bg-blue-primary rounded-full flex items-center justify-center mb-4">
                        <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">Prix transparents</h3>
                    <p class="text-gray-600">Tarifs fixes sans surprise, paiement sécurisé.</p>
                </div>
            </div>
        </div>

        {{-- CTA Section --}}
        <div class="bg-blue-primary rounded-lg p-8 text-center text-white">
            <h2 class="text-3xl font-bold mb-4">Prêt à réserver ?</h2>
            <p class="text-xl mb-6 text-blue-100">Calculez votre tarif en 30 secondes</p>
            <x-button href="{{ route('booking') }}" variant="secondary" size="lg">
                Réserver maintenant
            </x-button>
        </div>
    </div>
</div>
@endsection
