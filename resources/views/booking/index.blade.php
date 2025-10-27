@extends('layouts.app')

@section('title', 'Réserver un VTC - Transfert Paris Aéroports')
@section('description', 'Réservez votre chauffeur privé pour les aéroports CDG, Orly et Beauvais. Tarifs fixes, service premium 24h/24.')

@section('head')
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAo0mPC9-SNbSuZ8Z69sI0OMn7gzQ5Tx-o&libraries=places,geometry&callback=initMap"></script>
@endsection

@section('content')
<div class="min-h-screen bg-light-grey pt-24 pb-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Réserver votre VTC</h1>
            <p class="text-lg text-gray-600">Service premium vers les aéroports parisiens</p>
        </div>

        {{-- Booking Form --}}
        <div class="bg-white shadow-lg rounded-lg overflow-hidden">
            <form method="POST" action="{{ route('booking.store') }}" class="p-8" id="booking-form">
                @csrf

                {{-- Session Status --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                {{-- Map Section --}}
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Sélectionnez votre trajet</h3>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <div class="space-y-4">
                                {{-- Pickup Address --}}
                                <div>
                                    <x-input-label for="pickup_address" value="Adresse de prise en charge *" />
                                    <x-text-input id="pickup_address" name="pickup_address" type="text"
                                        class="mt-1 block w-full"
                                        :value="old('pickup_address')"
                                        placeholder="Ex: 123 Avenue des Champs-Élysées, Paris"
                                        required />
                                    <x-input-error :messages="$errors->get('pickup_address')" class="mt-2" />
                                </div>

                                {{-- Dropoff Address --}}
                                <div>
                                    <x-input-label for="dropoff_address" value="Adresse de destination *" />
                                    <x-text-input id="dropoff_address" name="dropoff_address" type="text"
                                        class="mt-1 block w-full"
                                        :value="old('dropoff_address')"
                                        placeholder="Ex: Aéroport Charles de Gaulle, Terminal 2"
                                        required />
                                    <x-input-error :messages="$errors->get('dropoff_address')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- Map --}}
                        <div>
                            <div id="map" class="w-full h-64 rounded-lg border border-gray-300"></div>
                        </div>
                    </div>
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
                            @foreach($vehicles as $vehicle)
                                <option value="{{ $vehicle->class }}" {{ old('vehicle_class') == $vehicle->class ? 'selected' : '' }}>
                                    {{ $vehicle->name }} - {{ $vehicle->class_label }}
                                </option>
                            @endforeach
                        </x-select>
                        <x-input-error :messages="$errors->get('vehicle_class')" class="mt-2" />
                    </div>
                </div>

                {{-- Customer Details --}}
                @guest
                <div class="mb-6">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Vos coordonnées</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <x-input-label for="customer_name" value="Nom complet *" />
                            <x-text-input id="customer_name" name="customer_name" type="text"
                                class="mt-1 block w-full"
                                :value="old('customer_name')"
                                required />
                            <x-input-error :messages="$errors->get('customer_name')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="customer_email" value="Email *" />
                            <x-text-input id="customer_email" name="customer_email" type="email"
                                class="mt-1 block w-full"
                                :value="old('customer_email')"
                                required />
                            <x-input-error :messages="$errors->get('customer_email')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="customer_phone" value="Téléphone *" />
                            <x-text-input id="customer_phone" name="customer_phone" type="tel"
                                class="mt-1 block w-full"
                                :value="old('customer_phone')"
                                required />
                            <x-input-error :messages="$errors->get('customer_phone')" class="mt-2" />
                        </div>
                    </div>
                </div>
                @endguest

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
let map;
let directionsService;
let directionsRenderer;
let pickupMarker;
let dropoffMarker;
let currentDistance = 0;
let currentDuration = 0;

function initMap() {
    // Initialize map
    map = new google.maps.Map(document.getElementById('map'), {
        center: { lat: 48.8566, lng: 2.3522 }, // Paris
        zoom: 10,
    });

    directionsService = new google.maps.DirectionsService();
    directionsRenderer = new google.maps.DirectionsRenderer({
        suppressMarkers: true // We'll add custom markers
    });
    directionsRenderer.setMap(map);

    // Initialize autocomplete for addresses
    const pickupInput = document.getElementById('pickup_address');
    const dropoffInput = document.getElementById('dropoff_address');

    const pickupAutocomplete = new google.maps.places.Autocomplete(pickupInput, {
        componentRestrictions: { country: 'fr' },
        fields: ['formatted_address', 'geometry', 'name']
    });

    const dropoffAutocomplete = new google.maps.places.Autocomplete(dropoffInput, {
        componentRestrictions: { country: 'fr' },
        fields: ['formatted_address', 'geometry', 'name']
    });

    pickupAutocomplete.addListener('place_changed', function() {
        const place = pickupAutocomplete.getPlace();
        if (place.geometry) {
            pickupInput.value = place.formatted_address;
            updateRoute();
        }
    });

    dropoffAutocomplete.addListener('place_changed', function() {
        const place = dropoffAutocomplete.getPlace();
        if (place.geometry) {
            dropoffInput.value = place.formatted_address;
            updateRoute();
        }
    });

    // Update route on input change (with debounce)
    let routeTimeout;
    function debouncedUpdateRoute() {
        clearTimeout(routeTimeout);
        routeTimeout = setTimeout(updateRoute, 1000);
    }

    pickupInput.addEventListener('input', debouncedUpdateRoute);
    dropoffInput.addEventListener('input', debouncedUpdateRoute);

    // Update price on form changes
    const form = document.getElementById('booking-form');
    form.addEventListener('change', updatePrice);
    form.addEventListener('input', updatePrice);
}

function updateRoute() {
    const pickupAddress = document.getElementById('pickup_address').value.trim();
    const dropoffAddress = document.getElementById('dropoff_address').value.trim();

    if (!pickupAddress || !dropoffAddress) {
        // Clear route if addresses are empty
        directionsRenderer.setDirections({ routes: [] });
        currentDistance = 0;
        currentDuration = 0;
        updatePrice();
        return;
    }

    const request = {
        origin: pickupAddress,
        destination: dropoffAddress,
        travelMode: google.maps.TravelMode.DRIVING,
        unitSystem: google.maps.UnitSystem.METRIC
    };

    directionsService.route(request, (result, status) => {
        if (status === google.maps.DirectionsStatus.OK) {
            directionsRenderer.setDirections(result);

            // Store distance and duration
            const route = result.routes[0];
            const leg = route.legs[0];
            currentDistance = leg.distance.value / 1000; // km
            currentDuration = leg.duration.value / 60; // minutes

            // Add custom markers
            if (pickupMarker) pickupMarker.setMap(null);
            if (dropoffMarker) dropoffMarker.setMap(null);

            pickupMarker = new google.maps.Marker({
                position: leg.start_location,
                map: map,
                title: 'Point de départ',
                icon: {
                    url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="10" fill="#10B981" stroke="white" stroke-width="2"/>
                            <text x="12" y="16" text-anchor="middle" fill="white" font-size="12" font-weight="bold">A</text>
                        </svg>
                    `),
                    scaledSize: new google.maps.Size(24, 24)
                }
            });

            dropoffMarker = new google.maps.Marker({
                position: leg.end_location,
                map: map,
                title: 'Destination',
                icon: {
                    url: 'data:image/svg+xml;charset=UTF-8,' + encodeURIComponent(`
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="12" cy="12" r="10" fill="#EF4444" stroke="white" stroke-width="2"/>
                            <text x="12" y="16" text-anchor="middle" fill="white" font-size="12" font-weight="bold">B</text>
                        </svg>
                    `),
                    scaledSize: new google.maps.Size(24, 24)
                }
            });

            // Fit map to route bounds
            map.fitBounds(route.bounds);

            updatePrice();
        } else {
            console.error('Directions request failed:', status);
            currentDistance = 0;
            currentDuration = 0;
            updatePrice();
        }
    });
}

function updatePrice() {
    const vehicleSelect = document.getElementById('vehicle_class');
    const vehicleClass = vehicleSelect.value;
    const childSeat = document.querySelector('input[name="child_seat"]').checked;
    const meetGreet = document.querySelector('input[name="meet_greet"]').checked;

    let basePrice = 0;
    let perKm = 0;

    // Get pricing based on selected vehicle
    if (vehicleClass) {
        // These should match your vehicle pricing from the database
        switch(vehicleClass) {
            case 'sedan':
                basePrice = 60;
                perKm = 1.50;
                break;
            case 'business':
                basePrice = 80;
                perKm = 2.00;
                break;
            case 'van':
                basePrice = 100;
                perKm = 2.50;
                break;
            default:
                basePrice = 60;
                perKm = 1.50;
        }
    }

    let total = basePrice;

    // Add distance-based pricing if we have a route
    if (currentDistance > 0) {
        total += currentDistance * perKm;
    }

    // Add extras
    if (childSeat) total += 15;
    if (meetGreet) total += 10;

    const priceElement = document.getElementById('price-estimate');
    if (total > 0) {
        priceElement.textContent = `${Math.round(total)}€`;
    } else {
        priceElement.textContent = 'À calculer';
    }
}

// Initialize map when Google Maps API loads
window.initMap = initMap;
</script>
@endsection
