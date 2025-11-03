@extends('layouts.admin')

@section('title', 'Créer une Réservation - Admin')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                <div class="flex items-center">
                    <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    <h1 class="ml-2 text-2xl font-medium text-gray-900">
                        Créer une Nouvelle Réservation
                    </h1>
                </div>

                <p class="mt-6 text-gray-500 leading-relaxed">
                    Créez une nouvelle réservation pour un client. Tous les champs marqués d'un astérisque (*) sont obligatoires.
                </p>
            </div>

            <form method="POST" action="{{ route('admin.bookings.store') }}" class="bg-white">
                @csrf

                <div class="p-6 lg:p-8">
                    {{-- Success Message --}}
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded-lg">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- General Error --}}
                    @if($errors->has('general'))
                        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-lg">
                            {{ $errors->first('general') }}
                        </div>
                    @endif

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Customer Selection --}}
                        <div>
                            <x-input-label for="user_id" value="Client existant (optionnel)" />
                            <select id="user_id" name="user_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Sélectionner un client existant</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}" {{ old('user_id') == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }} ({{ $customer->email }})
                                    </option>
                                @endforeach
                            </select>
                            <p class="mt-1 text-sm text-gray-500">Laissez vide pour créer un nouveau client</p>
                        </div>

                        {{-- Customer Name --}}
                        <div>
                            <x-input-label for="customer_name" value="Nom du client *" />
                            <x-text-input id="customer_name" name="customer_name" type="text"
                                class="mt-1 block w-full"
                                :value="old('customer_name')"
                                required />
                            <x-input-error :messages="$errors->get('customer_name')" class="mt-2" />
                        </div>

                        {{-- Customer Email --}}
                        <div>
                            <x-input-label for="customer_email" value="Email du client *" />
                            <x-text-input id="customer_email" name="customer_email" type="email"
                                class="mt-1 block w-full"
                                :value="old('customer_email')"
                                required />
                            <x-input-error :messages="$errors->get('customer_email')" class="mt-2" />
                        </div>

                        {{-- Customer Phone --}}
                        <div>
                            <x-input-label for="customer_phone" value="Téléphone du client" />
                            <x-text-input id="customer_phone" name="customer_phone" type="tel"
                                class="mt-1 block w-full"
                                :value="old('customer_phone')"
                                placeholder="+33 6 XX XX XX XX" />
                            <x-input-error :messages="$errors->get('customer_phone')" class="mt-2" />
                        </div>

                        {{-- Pickup Address --}}
                        <div>
                            <x-input-label for="pickup_address" value="Adresse de prise en charge *" />
                            <x-text-input id="pickup_address" name="pickup_address" type="text"
                                class="mt-1 block w-full"
                                :value="old('pickup_address')"
                                required />
                            <x-input-error :messages="$errors->get('pickup_address')" class="mt-2" />
                        </div>

                        {{-- Dropoff Address --}}
                        <div>
                            <x-input-label for="dropoff_address" value="Adresse de destination *" />
                            <x-text-input id="dropoff_address" name="dropoff_address" type="text"
                                class="mt-1 block w-full"
                                :value="old('dropoff_address')"
                                required />
                            <x-input-error :messages="$errors->get('dropoff_address')" class="mt-2" />
                        </div>

                        {{-- Pickup Time --}}
                        <div>
                            <x-input-label for="pickup_time" value="Date et heure de prise en charge *" />
                            <x-text-input id="pickup_time" name="pickup_time" type="datetime-local"
                                class="mt-1 block w-full"
                                :value="old('pickup_time')"
                                required />
                            <x-input-error :messages="$errors->get('pickup_time')" class="mt-2" />
                        </div>

                        {{-- Passengers --}}
                        <div>
                            <x-input-label for="pax" value="Nombre de passagers *" />
                            <x-text-input id="pax" name="pax" type="number" min="1" max="8"
                                class="mt-1 block w-full"
                                :value="old('pax', 1)"
                                required />
                            <x-input-error :messages="$errors->get('pax')" class="mt-2" />
                        </div>

                        {{-- Luggage --}}
                        <div>
                            <x-input-label for="luggage" value="Nombre de bagages *" />
                            <x-text-input id="luggage" name="luggage" type="number" min="0" max="8"
                                class="mt-1 block w-full"
                                :value="old('luggage', 0)"
                                required />
                            <x-input-error :messages="$errors->get('luggage')" class="mt-2" />
                        </div>

                        {{-- Vehicle --}}
                        <div>
                            <x-input-label for="vehicle_id" value="Véhicule *" />
                            <select id="vehicle_id" name="vehicle_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Sélectionner un véhicule</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}" {{ old('vehicle_id') == $vehicle->id ? 'selected' : '' }}>
                                        {{ $vehicle->name }} ({{ $vehicle->class_label }} - {{ $vehicle->pax }} places)
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('vehicle_id')" class="mt-2" />
                        </div>

                        {{-- Child Seats --}}
                        <div>
                            <x-input-label for="child_seat_count" value="Sièges enfant" />
                            <x-text-input id="child_seat_count" name="child_seat_count" type="number" min="0" max="4"
                                class="mt-1 block w-full"
                                :value="old('child_seat_count', 0)" />
                            <x-input-error :messages="$errors->get('child_seat_count')" class="mt-2" />
                        </div>

                        {{-- Flight Number --}}
                        <div>
                            <x-input-label for="flight_number" value="Numéro de vol" />
                            <x-text-input id="flight_number" name="flight_number" type="text"
                                class="mt-1 block w-full"
                                :value="old('flight_number')"
                                placeholder="AF 1234" />
                            <x-input-error :messages="$errors->get('flight_number')" class="mt-2" />
                        </div>

                        {{-- Price --}}
                        <div>
                            <x-input-label for="price" value="Prix (€)" />
                            <x-text-input id="price" name="price" type="number" step="0.01" min="0"
                                class="mt-1 block w-full"
                                :value="old('price')"
                                placeholder="0.00" />
                            <x-input-error :messages="$errors->get('price')" class="mt-2" />
                        </div>

                        {{-- Status --}}
                        <div>
                            <x-input-label for="status" value="Statut *" />
                            <select id="status" name="status" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="new" {{ old('status', 'new') == 'new' ? 'selected' : '' }}>Nouveau</option>
                                <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmé</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Terminé</option>
                                <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Annulé</option>
                            </select>
                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                        {{-- Meet & Greet --}}
                        <div class="flex items-center">
                            <input id="meet_greet" name="meet_greet" type="checkbox" value="1"
                                class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                {{ old('meet_greet') ? 'checked' : '' }}>
                            <label for="meet_greet" class="ml-2 text-sm text-gray-900">
                                Accueil à l'aéroport (Meet & Greet)
                            </label>
                        </div>
                    </div>

                    {{-- Notes --}}
                    <div class="mt-6">
                        <x-input-label for="notes" value="Notes supplémentaires" />
                        <textarea id="notes" name="notes" rows="4"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            placeholder="Informations supplémentaires...">{{ old('notes') }}</textarea>
                        <x-input-error :messages="$errors->get('notes')" class="mt-2" />
                    </div>
                </div>

                <div class="flex items-center justify-end px-6 lg:px-8 py-4 bg-gray-50 border-t border-gray-200">
                    <a href="{{ route('admin.bookings.index') }}" class="mr-4 px-4 py-2 bg-gray-300 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                        Annuler
                    </a>

                    <x-primary-button class="px-6 py-2">
                        Créer la Réservation
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
