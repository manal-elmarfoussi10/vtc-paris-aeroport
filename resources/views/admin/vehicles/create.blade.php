@extends('layouts.admin')

@section('title', 'Ajouter un véhicule - Administration')
@section('description', 'Créer un nouveau véhicule dans la flotte VTC.')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Ajouter un véhicule</h1>
                    <p class="mt-2 text-gray-600">Créer un nouveau véhicule dans votre flotte</p>
                </div>
                <x-button href="{{ route('admin.vehicles.index') }}" variant="outline">
                    ← Retour à la liste
                </x-button>
            </div>
        </div>

        {{-- Form --}}
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <form method="POST" action="{{ route('admin.vehicles.store') }}" enctype="multipart/form-data" class="p-8">
                @csrf

                {{-- Session Status --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                {{-- Name --}}
                <div class="mb-6">
                    <x-input-label for="name" value="Nom du véhicule *" />
                    <x-text-input id="name" name="name" type="text"
                        class="mt-1 block w-full"
                        :value="old('name')"
                        placeholder="Mercedes Classe S, BMW X5, etc."
                        required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                {{-- Class --}}
                <div class="mb-6">
                    <x-input-label for="class" value="Classe *" />
                    <x-select id="class" name="class" class="mt-1 block w-full" required>
                        <option value="">Sélectionner une classe</option>
                        <option value="berline" {{ old('class') == 'berline' ? 'selected' : '' }}>Berline</option>
                        <option value="suv" {{ old('class') == 'suv' ? 'selected' : '' }}>SUV</option>
                        <option value="van" {{ old('class') == 'van' ? 'selected' : '' }}>Van</option>
                        <option value="luxury" {{ old('class') == 'luxury' ? 'selected' : '' }}>Luxe</option>
                    </x-select>
                    <x-input-error :messages="$errors->get('class')" class="mt-2" />
                </div>

                {{-- Capacity Pax --}}
                <div class="mb-6">
                    <x-input-label for="capacity_pax" value="Capacité passagers *" />
                    <x-text-input id="capacity_pax" name="capacity_pax" type="number"
                        class="mt-1 block w-full"
                        :value="old('capacity_pax')"
                        min="1" max="8"
                        required />
                    <x-input-error :messages="$errors->get('capacity_pax')" class="mt-2" />
                </div>

                {{-- Capacity Luggage --}}
                <div class="mb-6">
                    <x-input-label for="capacity_luggage" value="Capacité bagages *" />
                    <x-text-input id="capacity_luggage" name="capacity_luggage" type="number"
                        class="mt-1 block w-full"
                        :value="old('capacity_luggage')"
                        min="0" max="10"
                        required />
                    <x-input-error :messages="$errors->get('capacity_luggage')" class="mt-2" />
                </div>

                {{-- Base Rate --}}
                <div class="mb-6">
                    <x-input-label for="base_rate" value="Tarif de base (€) *" />
                    <x-text-input id="base_rate" name="base_rate" type="number"
                        class="mt-1 block w-full"
                        :value="old('base_rate')"
                        step="0.01" min="0"
                        placeholder="50.00"
                        required />
                    <x-input-error :messages="$errors->get('base_rate')" class="mt-2" />
                    <p class="mt-1 text-sm text-gray-600">Tarif de base par heure ou par course selon votre politique tarifaire.</p>
                </div>

                {{-- Photo --}}
                <div class="mb-6">
                    <x-input-label for="photo" value="Photo du véhicule" />
                    <input type="file" id="photo" name="photo"
                        class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100"
                        accept="image/*" />
                    <x-input-error :messages="$errors->get('photo')" class="mt-2" />
                    <p class="mt-1 text-sm text-gray-600">Formats acceptés: JPG, PNG, GIF. Taille maximale: 2MB.</p>
                </div>

                {{-- Active --}}
                <div class="mb-6">
                    <label class="flex items-center">
                        <input type="checkbox" name="active" value="1" {{ old('active', true) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-blue-primary shadow-sm focus:border-blue-primary focus:ring focus:ring-blue-primary focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-600">Véhicule actif</span>
                    </label>
                    <p class="mt-1 text-sm text-gray-600">Désactivez pour retirer temporairement ce véhicule de la flotte disponible.</p>
                </div>

                {{-- Submit --}}
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <x-button href="{{ route('admin.vehicles.index') }}" variant="outline">
                        Annuler
                    </x-button>

                    <x-primary-button>
                        Créer le véhicule
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
