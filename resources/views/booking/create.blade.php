@extends('layouts.app')

@section('title', 'Créer une réservation - Transfert Paris Aéroports')
@section('description', 'Créez votre réservation de VTC pour les aéroports parisiens.')

@section('content')
<x-auth-session-status class="mb-4" :status="session('status')" />

<div class="max-w-4xl mx-auto py-12">
    <div class="bg-white rounded-lg shadow-lg p-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6">Créer une réservation</h2>

        <form method="POST" action="{{ route('booking.store') }}" class="space-y-6">
            @csrf

            <!-- Pickup Address -->
            <div>
                <label for="pickup_address" class="block text-sm font-medium text-gray-700 mb-2">
                    Adresse de départ *
                </label>
                <input type="text" id="pickup_address" name="pickup_address"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Entrez l'adresse de départ" required value="{{ old('pickup_address') }}">
                <input type="hidden" id="pickup_lat" name="pickup_lat" value="{{ old('pickup_lat') }}">
                <input type="hidden" id="pickup_lng" name="pickup_lng" value="{{ old('pickup_lng') }}">
                @error('pickup_address')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Dropoff Address -->
            <div>
                <label for="dropoff_address" class="block text-sm font-medium text-gray-700 mb-2">
                    Adresse d'arrivée *
                </label>
                <input type="text" id="dropoff_address" name="dropoff_address"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Entrez l'adresse d'arrivée" required value="{{ old('dropoff_address') }}">
                <input type="hidden" id="dropoff_lat" name="dropoff_lat" value="{{ old('dropoff_lat') }}">
                <input type="hidden" id="dropoff_lng" name="dropoff_lng" value="{{ old('dropoff_lng') }}">
                @error('dropoff_address')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Pickup Time -->
            <div>
                <label for="pickup_time" class="block text-sm font-medium text-gray-700 mb-2">
                    Date et heure de départ *
                </label>
                <input type="datetime-local" id="pickup_time" name="pickup_time"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       required value="{{ old('pickup_time') }}">
                @error('pickup_time')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Passengers -->
            <div>
                <label for="pax" class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre de passagers *
                </label>
                <select id="pax" name="pax"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    <option value="">Sélectionnez</option>
                    @for($i = 1; $i <= 8; $i++)
                        <option value="{{ $i }}" {{ old('pax') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                @error('pax')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Luggage -->
            <div>
                <label for="luggage" class="block text-sm font-medium text-gray-700 mb-2">
                    Nombre de bagages *
                </label>
                <select id="luggage" name="luggage"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                    <option value="">Sélectionnez</option>
                    @for($i = 0; $i <= 8; $i++)
                        <option value="{{ $i }}" {{ old('luggage') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
                @error('luggage')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Vehicle Class -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Classe de véhicule *
                </label>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($vehicles as $vehicle)
                        <div class="border border-gray-200 rounded-lg p-4 hover:border-blue-500 cursor-pointer transition-colors {{ old('vehicle_class') == $vehicle->class ? 'border-blue-500 bg-blue-50' : '' }}">
                            <input type="radio" id="vehicle_{{ $vehicle->id }}" name="vehicle_class" value="{{ $vehicle->class }}"
                                   class="mr-3" required {{ old('vehicle_class') == $vehicle->class ? 'checked' : '' }}>
                            <label for="vehicle_{{ $vehicle->id }}" class="cursor-pointer flex-1">
                                <div class="font-semibold">{{ $vehicle->name }}</div>
                                <div class="text-sm text-gray-600">{{ $vehicle->getClassLabelAttribute() }}</div>
                                <div class="text-sm text-gray-500">Capacité: {{ $vehicle->capacity_pax }} passagers, {{ $vehicle->capacity_luggage }} bagages</div>
                                @if($vehicle->photo_path)
                                    <img src="{{ asset('storage/' . $vehicle->photo_path) }}" alt="{{ $vehicle->name }}" class="w-full h-32 object-cover rounded mt-2">
                                @endif
                            </label>
                        </div>
                    @endforeach
                </div>
                @error('vehicle_class')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Customer Name -->
            <div>
                <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-2">
                    Nom du client *
                </label>
                <input type="text" id="customer_name" name="customer_name"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Entrez le nom complet" required value="{{ old('customer_name') }}">
                @error('customer_name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <!-- Extras -->
            <div class="space-y-4">
                <h3 class="text-lg font-semibold text-gray-900">Options supplémentaires</h3>

                <div class="flex items-center">
                    <input type="checkbox" id="child_seat_count" name="child_seat_count" value="1"
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" {{ old('child_seat_count') ? 'checked' : '' }}>
                    <label for="child_seat_count" class="ml-2 block text-sm text-gray-900">
                        Siège enfant (+15€)
                    </label>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="meet_greet" name="meet_greet" value="1"
                           class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" {{ old('meet_greet') ? 'checked' : '' }}>
                    <label for="meet_greet" class="ml-2 block text-sm text-gray-900">
                        Accueil à l'aéroport (+10€)
                    </label>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <a href="{{ route('booking') }}" class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-3 px-8 rounded-lg transition-colors mr-4">
                    Annuler
                </a>
                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-8 rounded-lg transition-colors focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Créer la réservation
                </button>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript"
    src="https://maps.google.com/maps/api/js?key={{ env('GOOGLE_MAP_KEY') }}&libraries=places">
</script>

<script>
    $(document).ready(function () {
        // Initialize autocomplete for pickup address
        var pickupInput = document.getElementById('pickup_address');
        var pickupAutocomplete = new google.maps.places.Autocomplete(pickupInput);

        pickupAutocomplete.addListener('place_changed', function () {
            var place = pickupAutocomplete.getPlace();
            if (place.geometry) {
                $('#pickup_lat').val(place.geometry['location'].lat());
                $('#pickup_lng').val(place.geometry['location'].lng());
            }
        });

        // Initialize autocomplete for dropoff address
        var dropoffInput = document.getElementById('dropoff_address');
        var dropoffAutocomplete = new google.maps.places.Autocomplete(dropoffInput);

        dropoffAutocomplete.addListener('place_changed', function () {
            var place = dropoffAutocomplete.getPlace();
            if (place.geometry) {
                $('#dropoff_lat').val(place.geometry['location'].lat());
                $('#dropoff_lng').val(place.geometry['location'].lng());
            }
        });
    });
</script>
@endsection
