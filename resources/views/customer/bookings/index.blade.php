@extends('layouts.app')

@section('title', 'Mes réservations - VTC Paris Aéroport')
@section('description', 'Consultez l\'historique de vos réservations VTC et gérez vos trajets.')

@section('content')
<div class="min-h-screen bg-light-grey py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Mes réservations</h1>
            <p class="mt-2 text-gray-600">Historique et gestion de vos trajets</p>
        </div>

        {{-- Filters --}}
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <form method="GET" class="flex flex-wrap gap-4 items-end">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select name="status" id="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                        <option value="">Tous les statuts</option>
                        <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Nouveau</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmé</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Terminé</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Annulé</option>
                    </select>
                </div>

                <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">Du</label>
                    <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>

                <div>
                    <label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">Au</label>
                    <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="px-4 py-2 bg-blue-primary text-white rounded-md hover:bg-blue-700 transition duration-200">
                        Filtrer
                    </button>
                    <a href="{{ route('customer.bookings') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-200">
                        Réinitialiser
                    </a>
                </div>
            </form>
        </div>

        {{-- Bookings List --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if($bookings->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($bookings as $booking)
                        <div class="p-6 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-4">
                                        <div class="flex-shrink-0">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                                @elseif($booking->status === 'completed') bg-blue-100 text-blue-800
                                                @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                                @else bg-yellow-100 text-yellow-800 @endif">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </div>

                                        <div class="min-w-0 flex-1">
                                            <h3 class="text-sm font-medium text-gray-900">
                                                {{ $booking->pickup_datetime->format('d/m/Y H:i') }}
                                            </h3>
                                            <p class="text-sm text-gray-600">
                                                <strong>De:</strong> {{ Str::limit($booking->pickup_address, 40) }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                <strong>À:</strong> {{ Str::limit($booking->dropoff_address, 40) }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                {{ $booking->pax }} passager{{ $booking->pax > 1 ? 's' : '' }}, {{ $booking->luggage }} bagage{{ $booking->luggage > 1 ? 's' : '' }} • {{ ucfirst($booking->vehicle_class) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4">
                                    <div class="text-right">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $booking->price_estimate ? number_format($booking->price_estimate, 2, ',', ' ') . '€' : 'Prix à confirmer' }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            Réf: #{{ $booking->id }}
                                        </div>
                                    </div>

                                    <div class="flex space-x-2">
                                        <x-button href="{{ route('customer.bookings.show', $booking->id) }}" variant="outline" size="sm">
                                            Détails
                                        </x-button>

                                        @if($booking->status === 'new' || $booking->status === 'confirmed')
                                            @if($booking->pickup_datetime > now()->addHours(2))
                                                <form method="POST" action="{{ route('customer.bookings.cancel', $booking->id) }}"
                                                      onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')"
                                                      class="inline">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="px-3 py-1 text-xs bg-red-100 text-red-700 rounded hover:bg-red-200 transition duration-200">
                                                        Annuler
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    {{ $bookings->appends(request()->query())->links() }}
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune réservation trouvée</h3>
                    <p class="mt-1 text-sm text-gray-500">
                        @if(request()->hasAny(['status', 'date_from', 'date_to']))
                            Aucun résultat pour vos critères de recherche.
                        @else
                            Vous n'avez pas encore de réservation.
                        @endif
                    </p>
                    <div class="mt-6">
                        <x-button href="{{ route('booking') }}" variant="primary">
                            @if(request()->hasAny(['status', 'date_from', 'date_to']))
                                Nouvelle recherche
                            @else
                                Faire une réservation
                            @endif
                        </x-button>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
