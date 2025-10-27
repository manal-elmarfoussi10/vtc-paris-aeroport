@extends('layouts.app')

@section('title', 'Réservation confirmée - VTC Paris Aéroport')
@section('description', 'Votre réservation VTC a été confirmée. Détails de votre transfert vers l\'aéroport.')

@section('content')
<div class="min-h-screen bg-light-grey py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Success Header --}}
        <div class="text-center mb-8">
            <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100 mb-4">
                <svg class="h-6 w-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Réservation confirmée !</h1>
            <p class="text-lg text-gray-600">Votre réservation a été créée avec succès. Un email de confirmation vous sera envoyé sous peu.</p>
        </div>

        {{-- Booking Details --}}
        <div class="bg-white shadow-lg rounded-lg overflow-hidden mb-6">
            <div class="bg-green-50 px-6 py-4 border-b border-green-200">
                <h2 class="text-lg font-medium text-green-900">Détails de votre réservation</h2>
                <p class="text-sm text-green-700">Référence: #{{ $booking->id }}</p>
            </div>

            <div class="p-6 space-y-4">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">De</label>
                        <p class="text-sm text-gray-900">{{ $booking->pickup_address }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">À</label>
                        <p class="text-sm text-gray-900">{{ $booking->dropoff_address }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Date & heure</label>
                        <p class="text-sm text-gray-900">{{ $booking->pickup_datetime->format('d/m/Y à H:i') }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Passagers</label>
                        <p class="text-sm text-gray-900">{{ $booking->pax }} personne{{ $booking->pax > 1 ? 's' : '' }}</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Bagages</label>
                        <p class="text-sm text-gray-900">{{ $booking->luggage }}</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Véhicule</label>
                        <p class="text-sm text-gray-900">{{ ucfirst($booking->vehicle_class) }}</p>
                    </div>
                </div>

                @if($booking->extras)
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Services supplémentaires</label>
                        <div class="flex flex-wrap gap-2">
                            @if(in_array('child_seat', $booking->extras))
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Siège enfant
                                </span>
                            @endif
                            @if(in_array('meet_greet', $booking->extras))
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                    Accueil personnalisé
                                </span>
                            @endif
                        </div>
                    </div>
                @endif

                @if($booking->notes)
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Commentaires</label>
                        <p class="text-sm text-gray-900">{{ $booking->notes }}</p>
                    </div>
                @endif

                <div class="border-t pt-4">
                    <div class="flex justify-between items-center">
                        <span class="text-sm font-medium text-gray-700">Prix estimé</span>
                        <span class="text-lg font-bold text-gray-900">{{ $booking->price_estimate ? number_format($booking->price_estimate, 2, ',', ' ') . '€' : 'À confirmer' }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Next Steps --}}
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
            <h3 class="text-lg font-medium text-blue-900 mb-3">Prochaines étapes</h3>
            <ul class="space-y-2 text-sm text-blue-800">
                <li class="flex items-start">
                    <span class="flex-shrink-0 h-5 w-5 text-blue-600 mr-2">📞</span>
                    <span>Votre chauffeur vous contactera dans les 30 minutes pour confirmer les détails</span>
                </li>
                <li class="flex items-start">
                    <span class="flex-shrink-0 h-5 w-5 text-blue-600 mr-2">🚗</span>
                    <span>Le véhicule arrivera 10 minutes avant l'heure prévue</span>
                </li>
                <li class="flex items-start">
                    <span class="flex-shrink-0 h-5 w-5 text-blue-600 mr-2">💳</span>
                    <span>Paiement possible en espèces, carte bancaire ou virement</span>
                </li>
            </ul>
        </div>

        {{-- Actions --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @auth
                <x-button href="{{ route('customer.dashboard') }}" variant="primary">
                    Voir mes réservations
                </x-button>
            @else
                <x-button href="{{ route('register') }}" variant="primary">
                    Créer un compte
                </x-button>
                <x-button href="{{ route('home') }}" variant="secondary">
                    Retour à l'accueil
                </x-button>
            @endauth
        </div>

        {{-- Contact Info --}}
        <div class="mt-8 text-center text-sm text-gray-600">
            <p>Une question ? Contactez-nous au <strong>{{ setting('company_phone', '+33 1 23 45 67 89') }}</strong></p>
            <p>ou par email à <strong>{{ setting('company_email', 'contact@vtc-paris-aeroport.fr') }}</strong></p>
        </div>
    </div>
</div>
@endsection
