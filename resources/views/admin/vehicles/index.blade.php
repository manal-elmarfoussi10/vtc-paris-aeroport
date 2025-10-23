@extends('layouts.admin')

@section('title', 'Gestion des véhicules - Administration')
@section('description', 'Gestion de la flotte de véhicules VTC.')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Véhicules</h1>
                    <p class="mt-2 text-gray-600">Gestion de la flotte</p>
                </div>
                <x-button href="{{ route('admin.vehicles.create') }}" variant="primary">
                    Ajouter un véhicule
                </x-button>
            </div>
        </div>

        {{-- Vehicles Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($vehicles as $vehicle)
                <div class="bg-white rounded-lg shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <div class="p-6">
                        {{-- Vehicle Image --}}
                        @if($vehicle->photo_path)
                            <img src="{{ asset('storage/' . $vehicle->photo_path) }}" alt="{{ $vehicle->name }}"
                                 class="w-full h-48 object-cover rounded-lg mb-4">
                        @else
                            <div class="w-full h-48 bg-gray-200 rounded-lg flex items-center justify-center mb-4">
                                <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        @endif

                        {{-- Vehicle Info --}}
                        <div class="mb-4">
                            <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $vehicle->name }}</h3>
                            <p class="text-blue-primary font-medium capitalize">{{ $vehicle->class }}</p>
                        </div>

                        {{-- Specs --}}
                        <div class="space-y-2 mb-6">
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Capacité passagers:</span>
                                <span class="font-medium">{{ $vehicle->capacity_pax }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Capacité bagages:</span>
                                <span class="font-medium">{{ $vehicle->capacity_luggage }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-600">Tarif de base:</span>
                                <span class="font-medium">{{ number_format($vehicle->base_rate, 0, ',', ' ') }}€</span>
                            </div>
                        </div>

                        {{-- Actions --}}
                        <div class="flex space-x-2">
                            <x-button href="{{ route('admin.vehicles.show', $vehicle->id) }}" variant="outline" class="flex-1">
                                Voir
                            </x-button>
                            <x-button href="{{ route('admin.vehicles.edit', $vehicle->id) }}" variant="outline" class="flex-1">
                                Éditer
                            </x-button>
                        </div>

                        {{-- Toggle Active --}}
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <form method="POST" action="{{ route('admin.vehicles.toggle', $vehicle->id) }}" class="flex items-center justify-between">
                                @csrf
                                @method('PATCH')
                                <span class="text-sm text-gray-600">Actif</span>
                                <button type="submit" class="relative inline-flex h-6 w-11 flex-shrink-0 cursor-pointer rounded-full border-2 border-transparent {{ $vehicle->active ? 'bg-blue-primary' : 'bg-gray-200' }} transition-colors duration-200 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-primary focus:ring-offset-2" role="switch" aria-checked="{{ $vehicle->active ? 'true' : 'false' }}">
                                    <span class="translate-x-0 inline-block h-5 w-5 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out {{ $vehicle->active ? 'translate-x-5' : 'translate-x-0' }}"></span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        @if($vehicles->isEmpty())
            <div class="bg-white rounded-lg shadow p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun véhicule</h3>
                <p class="mt-1 text-sm text-gray-500">Commencez par ajouter votre premier véhicule.</p>
                <div class="mt-6">
                    <x-button href="{{ route('admin.vehicles.create') }}" variant="primary">
                        Ajouter un véhicule
                    </x-button>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
