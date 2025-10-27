@extends('layouts.admin')

@section('title', 'Modifier le véhicule: ' . $vehicle->name)

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
                    Modifier le véhicule: {{ $vehicle->name }}
                </h2>

                <form method="POST" action="{{ route('admin.vehicles.update', $vehicle) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <x-input-label for="name" :value="__('Nom du véhicule')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full"
                                          :value="old('name', $vehicle->name)" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <!-- Class -->
                        <div>
                            <x-input-label for="class" :value="__('Classe')" />
                            <select id="class" name="class" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">Sélectionner une classe</option>
                                <option value="sedan" {{ old('class', $vehicle->class) == 'sedan' ? 'selected' : '' }}>Berline</option>
                                <option value="business" {{ old('class', $vehicle->class) == 'business' ? 'selected' : '' }}>Business</option>
                                <option value="van" {{ old('class', $vehicle->class) == 'van' ? 'selected' : '' }}>Van</option>
                                <option value="berline" {{ old('class', $vehicle->class) == 'berline' ? 'selected' : '' }}>Berline</option>
                                <option value="suv" {{ old('class', $vehicle->class) == 'suv' ? 'selected' : '' }}>SUV</option>
                                <option value="luxury" {{ old('class', $vehicle->class) == 'luxury' ? 'selected' : '' }}>Luxe</option>
                            </select>
                            <x-input-error :messages="$errors->get('class')" class="mt-2" />
                        </div>

                        <!-- Capacity Pax -->
                        <div>
                            <x-input-label for="capacity_pax" :value="__('Capacité passagers')" />
                            <x-text-input id="capacity_pax" name="capacity_pax" type="number" class="mt-1 block w-full"
                                          :value="old('capacity_pax', $vehicle->capacity_pax)" min="1" max="8" required />
                            <x-input-error :messages="$errors->get('capacity_pax')" class="mt-2" />
                        </div>

                        <!-- Capacity Luggage -->
                        <div>
                            <x-input-label for="capacity_luggage" :value="__('Capacité bagages')" />
                            <x-text-input id="capacity_luggage" name="capacity_luggage" type="number" class="mt-1 block w-full"
                                          :value="old('capacity_luggage', $vehicle->capacity_luggage)" min="0" max="8" required />
                            <x-input-error :messages="$errors->get('capacity_luggage')" class="mt-2" />
                        </div>

                        <!-- Base Rate -->
                        <div>
                            <x-input-label for="base_rate" :value="__('Tarif de base (€)')" />
                            <x-text-input id="base_rate" name="base_rate" type="number" step="0.01" class="mt-1 block w-full"
                                          :value="old('base_rate', $vehicle->base_rate)" min="0" required />
                            <x-input-error :messages="$errors->get('base_rate')" class="mt-2" />
                        </div>

                        <!-- Per Km -->
                        <div>
                            <x-input-label for="per_km" :value="__('Tarif par km (€)')" />
                            <x-text-input id="per_km" name="per_km" type="number" step="0.01" class="mt-1 block w-full"
                                          :value="old('per_km', $vehicle->per_km)" min="0" />
                            <x-input-error :messages="$errors->get('per_km')" class="mt-2" />
                        </div>

                        <!-- Per Min -->
                        <div>
                            <x-input-label for="per_min" :value="__('Tarif par minute (€)')" />
                            <x-text-input id="per_min" name="per_min" type="number" step="0.01" class="mt-1 block w-full"
                                          :value="old('per_min', $vehicle->per_min)" min="0" />
                            <x-input-error :messages="$errors->get('per_min')" class="mt-2" />
                        </div>

                        <!-- Photo -->
                        <div class="md:col-span-2">
                            <x-input-label for="photo" :value="__('Photo du véhicule')" />
                            <input id="photo" name="photo" type="file" class="mt-1 block w-full text-sm text-gray-500
                                file:mr-4 file:py-2 file:px-4
                                file:rounded-full file:border-0
                                file:text-sm file:font-semibold
                                file:bg-blue-50 file:text-blue-700
                                hover:file:bg-blue-100" accept="image/*" />
                            <p class="mt-1 text-sm text-gray-500">Formats acceptés: JPEG, PNG, JPG, GIF. Taille max: 2MB.</p>
                            @if($vehicle->photo_path)
                                <div class="mt-2">
                                    <p class="text-sm text-gray-600">Photo actuelle:</p>
                                    <img src="{{ asset('storage/' . $vehicle->photo_path) }}" alt="{{ $vehicle->name }}" class="mt-1 w-32 h-32 object-cover rounded-lg">
                                </div>
                            @endif
                            <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                        </div>

                        <!-- Description -->
                        <div class="md:col-span-2">
                            <x-input-label for="description" :value="__('Description')" />
                            <textarea id="description" name="description" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('description', $vehicle->description) }}</textarea>
                            <x-input-error :messages="$errors->get('description')" class="mt-2" />
                        </div>

                        <!-- Is Active -->
                        <div class="md:col-span-2">
                            <label class="flex items-center">
                                <input type="hidden" name="is_active" value="0">
                                <input id="is_active" name="is_active" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" value="1" {{ old('is_active', $vehicle->is_active) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">Véhicule actif</span>
                            </label>
                            <x-input-error :messages="$errors->get('is_active')" class="mt-2" />
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        <a href="{{ route('admin.vehicles.show', $vehicle) }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Annuler
                        </a>
                        <x-primary-button>
                            Mettre à jour le véhicule
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
