@extends('layouts.admin')

@section('title', 'Véhicule: ' . $vehicle->name)

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
                    {{ __('Véhicule: :name', ['name' => $vehicle->name]) }}
                </h2>
                    <div class="flex flex-wrap -mx-3 mb-6">
                        <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                            <h3 class="text-lg font-semibold mb-4">Informations générales</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="mb-3">
                                    <strong>Nom:</strong> {{ $vehicle->name }}
                                </div>
                                <div class="mb-3">
                                    <strong>Classe:</strong> {{ $vehicle->class_label }}
                                </div>
                                <div class="mb-3">
                                    <strong>Capacité passagers:</strong> {{ $vehicle->capacity_pax }}
                                </div>
                                <div class="mb-3">
                                    <strong>Capacité bagages:</strong> {{ $vehicle->capacity_luggage }}
                                </div>
                                <div class="mb-3">
                                    <strong>Tarif de base:</strong> {{ number_format($vehicle->base_rate, 2) }} €
                                </div>
                                @if($vehicle->per_km)
                                    <div class="mb-3">
                                        <strong>Tarif par km:</strong> {{ number_format($vehicle->per_km, 2) }} €
                                    </div>
                                @endif
                                @if($vehicle->per_min)
                                    <div class="mb-3">
                                        <strong>Tarif par minute:</strong> {{ number_format($vehicle->per_min, 2) }} €
                                    </div>
                                @endif
                                <div class="mb-3">
                                    <strong>Statut:</strong>
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $vehicle->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ $vehicle->is_active ? 'Actif' : 'Inactif' }}
                                    </span>
                                </div>
                                @if($vehicle->description)
                                    <div class="mb-3">
                                        <strong>Description:</strong> {{ $vehicle->description }}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="w-full md:w-1/2 px-3">
                            <h3 class="text-lg font-semibold mb-4">Photo du véhicule</h3>
                            @if($vehicle->photo_path)
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <img src="{{ asset('storage/' . $vehicle->photo_path) }}" alt="{{ $vehicle->name }}" class="w-full h-64 object-cover rounded-lg">
                                </div>
                            @else
                                <div class="bg-gray-50 rounded-lg p-4 text-center">
                                    <p class="text-gray-500">Aucune photo disponible</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('admin.vehicles.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Retour à la liste
                        </a>
                        <div class="space-x-2">
                            <a href="{{ route('admin.vehicles.edit', $vehicle) }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                Modifier
                            </a>
                            <form method="POST" action="{{ route('admin.vehicles.toggle-active', $vehicle) }}" class="inline">
                                @csrf
                                <button type="submit" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded">
                                    {{ $vehicle->is_active ? 'Désactiver' : 'Activer' }}
                                </button>
                            </form>
                            <form method="POST" action="{{ route('admin.vehicles.destroy', $vehicle) }}" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
