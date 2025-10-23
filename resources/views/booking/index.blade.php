@extends('layouts.app')

@section('title', 'Réserver un VTC - Transfert Paris Aéroports')
@section('description', 'Réservez votre chauffeur privé pour les aéroports CDG, Orly et Beauvais. Tarifs fixes, service premium 24h/24.')

@section('content')
<div class="min-h-screen bg-light-grey py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Réserver votre VTC</h1>
            <p class="text-lg text-gray-600">Service premium vers les aéroports parisiens</p>
        </div>

        {{-- Booking Form --}}
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <form method="POST" action="{{ route('booking.store') }}" class="p-8">
                @csrf

                {{-- Session Status --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                {{-- Pickup Address --}}
                <div class="mb-6">
                    <x-input-label for="pickup_address" value="Adresse de prise en charge *" />
                    <x-text-input id="pickup_address" name="pickup_address" type="text"
                        class="mt-1 block w-full"
                        :value="old('pickup_address')"
                        placeholder="Ex: 123 Avenue des Champs-Élysées, Paris"
                        required />
                    <x-input-error :messages="$errors->get('pickup_address')" class="mt-2" />
                </div>

                {{-- Dropoff Address --}}
                <div class="mb-6">
                    <x-input-label for="dropoff_address" value="Adresse de destination *" />
                    <x-text-input id="dropoff_address" name="dropoff_address" type="text"
                        class="mt-1 block w-full"
                        :value="old('dropoff_address')"
                        placeholder="Ex: Aéroport Charles de Gaulle, Terminal 2"
                        required />
                    <x-input-error :messages="$errors->get('dropoff_address')" class="mt-2" />
                </div>

                {{-- Date & Time --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <x-input-label for="pickup_datetime" value="Date et heure *" />
                        <x-text-input id="pickup_datetime" name="pickup_datetime" type="datetime-local"
                            class="mt-1 block w-full"
                            :value="old('pickup_datetime')"
                            min="{{ now()->addHour()->format('Y-m-d\TH:i') }}"
                            required />
                        <x-input-error :messages="$errors->get('pickup_datetime')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="pax" value="Nombre de passagers *" />
                        <x-select id="pax" name="pax" class="mt-1 block w-full" required>
                            <option value="">Sélectionner</option>
                            @for($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ old('pax') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </x-select>
                        <x-input-error :messages="$errors->get('pax')" class="mt-2" />
                    </div>
                </div>

                {{-- Luggage & Vehicle --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <x-input-label for="luggage" value="Nombre de bagages *" />
                        <x-select id="luggage" name="luggage" class="mt-1 block w-full" required>
                            <option value="">Sélectionner</option>
                            @for($i = 0; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ old('luggage') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </x-select>
                        <x-input-error :messages="$errors->get('luggage')" class="mt-2" />
                    </div>

                    <div>
                        <x-input-label for="vehicle_class" value="Catégorie de véhicule *" />
                        <x-select id="vehicle_class" name="vehicle_class" class="mt-1 block w-full" required>
                            <option value="">Sélectionner</option>
                            <option value="sedan" {{ old('vehicle_class') == 'sedan' ? 'selected' : '' }}>Berline (Sedan)</option>
                            <option value="business" {{ old('vehicle_class') == 'business' ? 'selected' : '' }}>Business</option>
                            <option value="van" {{ old('vehicle_class') == 'van' ? 'selected' : '' }}>Van</option>
                        </x-select>
                        <x-input-error :messages="$errors->get('vehicle_class')" class="mt-2" />
                    </div>
                </div>

                {{-- Extras --}}
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Services supplémentaires</label>
                    <div class="space-y-2">
                        <label class="flex items-center">
                            <input type="checkbox" name="child_seat" value="1" {{ old('child_seat') ? 'checked' : '' }}
                                class="rounded border-gray-300 text-blue-primary shadow-sm focus:border-blue-primary focus:ring-blue-primary">
                            <span class="ml-2 text-sm text-gray-700">Siège enfant (+15€)</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="meet_greet" value="1" {{ old('meet_greet') ? 'checked' : '' }}
                                class="rounded border-gray-300 text-blue-primary shadow-sm focus:border-blue-primary focus:ring-blue-primary">
                            <span class="ml-2 text-sm text-gray-700">Accueil personnalisé (+10€)</span>
                        </label>
                    </div>
                </div>

                {{-- Notes --}}
                <div class="mb-6">
                    <x-input-label for="notes" value="Commentaires (optionnel)" />
                    <textarea id="notes" name="notes" rows="3"
                        class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                        placeholder="Informations supplémentaires pour votre chauffeur...">{{ old('notes') }}</textarea>
                    <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                </div>

                {{-- Price Estimate --}}
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium text-blue-900">Estimation du prix:</span>
                        <span class="text-lg font-bold text-blue-900" id="price-estimate">À calculer</span>
                    </div>
                    <p class="text-xs text-blue-700 mt-1">Prix définitif confirmé après réservation</p>
                </div>

                {{-- Submit --}}
                <div class="flex items-center justify-end">
                    <x-primary-button>
                        Réserver maintenant
                    </x-primary-button>
                </div>
            </form>
        </div>

        {{-- Info Section --}}
        <div class="mt-8 bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Informations importantes</h3>
            <ul class="space-y-2 text-sm text-gray-600">
                <li>• Réservation confirmée sous 5 minutes</li>
                <li>• Chauffeur professionnel et véhicule climatisé</li>
                <li>• Suivi de vol en temps réel pour les aéroports</li>
                <li>• Paiement à bord ou en ligne</li>
                <li>• Annulation gratuite jusqu'à 2h avant</li>
            </ul>
        </div>
    </div>
</div>

<script>
// Simple price calculation (placeholder)
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    const priceElement = document.getElementById('price-estimate');

    function updatePrice() {
        const vehicleClass = form.vehicle_class.value;
        const pax = parseInt(form.pax.value) || 0;
        const luggage = parseInt(form.luggage.value) || 0;
        const childSeat = form.child_seat.checked;
        const meetGreet = form.meet_greet.checked;

        let basePrice = 0;
        switch(vehicleClass) {
            case 'sedan': basePrice = 65; break;
            case 'business': basePrice = 85; break;
            case 'van': basePrice = 120; break;
        }

        let extras = 0;
        if (childSeat) extras += 15;
        if (meetGreet) extras += 10;

        const total = basePrice + extras;
        priceElement.textContent = total > 0 ? `À partir de ${total}€` : 'À calculer';
    }

    form.addEventListener('change', updatePrice);
    form.addEventListener('input', updatePrice);
});
</script>
@endsection
