@extends('layouts.admin')

@section('title', 'Détails de la Réservation #' . $booking->id . ' - Admin')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                        <h1 class="ml-2 text-2xl font-medium text-gray-900">
                            Réservation #{{ $booking->id }}
                        </h1>
                    </div>
                    <div class="flex space-x-2">
                        <a href="{{ route('admin.bookings.edit', $booking) }}" class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-200">
                            Modifier
                        </a>
                        <a href="{{ route('admin.bookings.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 transition duration-200">
                            Retour à la liste
                        </a>
                    </div>
                </div>

                <p class="mt-6 text-gray-500 leading-relaxed">
                    Détails complets de la réservation créée le {{ $booking->created_at->format('d/m/Y à H:i') }}
                </p>
            </div>

            {{-- Success Message --}}
            @if(session('success'))
                <div class="m-6 mb-0 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="p-6 lg:p-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    {{-- Customer Information --}}
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Informations Client</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Nom</label>
                                    <p class="text-sm text-gray-900">{{ $booking->customer_name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Email</label>
                                    <p class="text-sm text-gray-900">{{ $booking->customer_email }}</p>
                                </div>
                                @if($booking->customer_phone)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Téléphone</label>
                                    <p class="text-sm text-gray-900">{{ $booking->customer_phone }}</p>
                                </div>
                                @endif
                                @if($booking->user)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Compte utilisateur</label>
                                    <p class="text-sm text-gray-900">{{ $booking->user->name }} ({{ $booking->user->email }})</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Booking Details --}}
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Détails de la Réservation</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Statut</label>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                        @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                        @elseif($booking->status === 'new') bg-blue-100 text-blue-800
                                        @elseif($booking->status === 'completed') bg-gray-100 text-gray-800
                                        @else bg-red-100 text-red-800 @endif">
                                        {{ $booking->status_label }}
                                    </span>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Date et heure</label>
                                    <p class="text-sm text-gray-900">{{ $booking->pickup_time->format('d/m/Y H:i') }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Passagers</label>
                                    <p class="text-sm text-gray-900">{{ $booking->pax }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Bagages</label>
                                    <p class="text-sm text-gray-900">{{ $booking->luggage }}</p>
                                </div>
                                @if($booking->child_seat_count > 0)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Sièges enfant</label>
                                    <p class="text-sm text-gray-900">{{ $booking->child_seat_count }}</p>
                                </div>
                                @endif
                                @if($booking->flight_number)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Numéro de vol</label>
                                    <p class="text-sm text-gray-900">{{ $booking->flight_number }}</p>
                                </div>
                                @endif
                                @if($booking->meet_greet)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Accueil à l'aéroport</label>
                                    <p class="text-sm text-gray-900">Oui</p>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- Route Information --}}
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Trajet</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Adresse de prise en charge</label>
                                    <p class="text-sm text-gray-900">{{ $booking->pickup_address }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Adresse de destination</label>
                                    <p class="text-sm text-gray-900">{{ $booking->dropoff_address }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Vehicle Information --}}
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Véhicule</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if($booking->vehicle)
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Modèle</label>
                                    <p class="text-sm text-gray-900">{{ $booking->vehicle->name }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Classe</label>
                                    <p class="text-sm text-gray-900">{{ $booking->vehicle->class_label }}</p>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Capacité</label>
                                    <p class="text-sm text-gray-900">{{ $booking->vehicle->pax }} passagers</p>
                                </div>
                            </div>
                            @else
                            <p class="text-sm text-gray-500">Véhicule non spécifié</p>
                            @endif
                        </div>
                    </div>

                    {{-- Pricing Information --}}
                    <div>
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Tarification</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            @if($booking->price)
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700">Prix</label>
                                    <p class="text-sm text-gray-900">{{ number_format($booking->price, 2, ',', ' ') }} €</p>
                                </div>
                            </div>
                            @else
                            <p class="text-sm text-gray-500">Prix à confirmer</p>
                            @endif
                        </div>
                    </div>

                    {{-- Notes --}}
                    @if($booking->notes)
                    <div class="md:col-span-2">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Notes</h3>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <p class="text-sm text-gray-900 whitespace-pre-wrap">{{ $booking->notes }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
