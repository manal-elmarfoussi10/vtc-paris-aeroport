@extends('layouts.app')

@section('title', 'Détails réservation #' . $booking->id . ' - VTC Paris Aéroport')
@section('description', 'Consultez les détails complets de votre réservation VTC.')

@section('content')
<div class="min-h-screen bg-light-grey py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Réservation #{{ $booking->id }}</h1>
                    <p class="mt-2 text-gray-600">Détails complets de votre trajet</p>
                </div>
                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                    @if($booking->status === 'confirmed') bg-green-100 text-green-800
                    @elseif($booking->status === 'completed') bg-blue-100 text-blue-800
                    @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                    @else bg-yellow-100 text-yellow-800 @endif">
                    {{ ucfirst($booking->status) }}
                </span>
            </div>
        </div>

        {{-- Booking Details --}}
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-50">
                <h2 class="text-lg font-medium text-gray-900">Informations du trajet</h2>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    {{-- Pickup --}}
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Départ</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-900 font-medium">{{ $booking->pickup_datetime->format('l d F Y') }}</p>
                            <p class="text-sm text-gray-900">{{ $booking->pickup_datetime->format('H:i') }}</p>
                            <p class="text-sm text-gray-600 mt-1">{{ $booking->pickup_address }}</p>
                        </div>
                    </div>

                    {{-- Dropoff --}}
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Destination</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-900">{{ $booking->dropoff_address }}</p>
                        </div>
                    </div>

                    {{-- Passengers --}}
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Passagers</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-900">{{ $booking->pax }} personne{{ $booking->pax > 1 ? 's' : '' }}</p>
                        </div>
                    </div>

                    {{-- Luggage --}}
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Bagages</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-900">{{ $booking->luggage }}</p>
                        </div>
                    </div>

                    {{-- Vehicle --}}
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Véhicule</h3>
                        <div class="mt-2">
                            <p class="text-sm text-gray-900">{{ ucfirst($booking->vehicle_class) }}</p>
                            @if($booking->vehicle)
                                <p class="text-xs text-gray-600">{{ $booking->vehicle->name }}</p>
                            @endif
                        </div>
                    </div>

                    {{-- Price --}}
                    <div>
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide">Prix</h3>
                        <div class="mt-2">
                            <p class="text-lg font-bold text-gray-900">
                                {{ $booking->price_estimate ? number_format($booking->price_estimate, 2, ',', ' ') . '€' : 'À confirmer' }}
                            </p>
                            @if($booking->extras)
                                <p class="text-xs text-gray-600">Inclut services supplémentaires</p>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Extras --}}
                @if($booking->extras)
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-3">Services supplémentaires</h3>
                        <div class="flex flex-wrap gap-2">
                            @if(in_array('child_seat', $booking->extras))
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Siège enfant (+15€)
                                </span>
                            @endif
                            @if(in_array('meet_greet', $booking->extras))
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Accueil personnalisé (+10€)
                                </span>
                            @endif
                        </div>
                    </div>
                @endif

                {{-- Notes --}}
                @if($booking->notes)
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Commentaires</h3>
                        <p class="text-sm text-gray-900">{{ $booking->notes }}</p>
                    </div>
                @endif
            </div>
        </div>

        {{-- Actions --}}
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-lg font-medium text-gray-900 mb-4">Actions</h2>
            <div class="flex flex-wrap gap-4">
                <x-button href="{{ route('customer.bookings') }}" variant="outline">
                    ← Retour à mes réservations
                </x-button>

                @if($booking->status === 'new' || $booking->status === 'confirmed')
                    @if($booking->pickup_datetime > now()->addHours(2))
                        <form method="POST" action="{{ route('customer.bookings.cancel', $booking->id) }}"
                              onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ? Cette action est irréversible.')"
                              class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition duration-200">
                                Annuler la réservation
                            </button>
                        </form>
                    @endif
                @endif

                @if($booking->status === 'completed')
                    <x-button href="#" onclick="window.print()" variant="outline">
                        🖨️ Imprimer la facture
                    </x-button>
                @endif
            </div>
        </div>

        {{-- Contact Support --}}
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636l-3.536 3.536m0 5.656l3.536 3.536M9.172 9.172L5.636 5.636m3.536 9.192L5.636 18.364M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-900">
                        Besoin d'aide ?
                    </h3>
                    <div class="mt-2 text-sm text-blue-800">
                        <p>
                            Contactez notre service client pour toute question ou modification :
                            <strong>{{ setting('company_phone', '+33 1 23 45 67 89') }}</strong>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
