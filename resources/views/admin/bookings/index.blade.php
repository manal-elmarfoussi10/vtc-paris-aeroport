@extends('layouts.admin')

@section('title', 'Gestion des réservations - Administration')
@section('description', 'Liste et gestion de toutes les réservations VTC.')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Réservations</h1>
                    <p class="mt-2 text-gray-600">Gestion complète des réservations</p>
                </div>
                <x-button href="{{ route('admin.bookings.create') }}" variant="primary">
                    Nouvelle réservation
                </x-button>
            </div>
        </div>

        {{-- Filters --}}
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
                    <select name="status" id="status" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                        <option value="">Tous les statuts</option>
                        <option value="new" {{ request('status') == 'new' ? 'selected' : '' }}>Nouveau</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Confirmé</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Terminé</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Annulé</option>
                    </select>
                </div>

                <div>
                    <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">Date de début</label>
                    <input type="date" name="date_from" id="date_from" value="{{ request('date_from') }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                </div>

                <div>
                    <label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">Date de fin</label>
                    <input type="date" name="date_to" id="date_to" value="{{ request('date_to') }}"
                        class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full">
                </div>

                <div class="flex items-end">
                    <button type="submit" class="px-4 py-2 bg-blue-primary text-white rounded-md hover:bg-blue-700 transition duration-200 mr-2">
                        Filtrer
                    </button>
                    <a href="{{ route('admin.bookings.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 transition duration-200">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        {{-- Export --}}
        <div class="bg-white rounded-lg shadow p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h3 class="text-lg font-medium text-gray-900">Export des données</h3>
                    <p class="text-sm text-gray-600">Téléchargez la liste des réservations au format CSV</p>
                </div>
                <form method="POST" action="{{ route('admin.bookings.export') }}" class="inline">
                    @csrf
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition duration-200">
                        📊 Exporter CSV
                    </button>
                </form>
            </div>
        </div>

        {{-- Bookings Table --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if($bookings->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Trajet</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date/Heure</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prix</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($bookings as $booking)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                        #{{ $booking->id }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $booking->user ? $booking->user->name : 'Client anonyme' }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $booking->user ? $booking->user->email : ($booking->customer_email ?? 'N/A') }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-gray-900">
                                            <strong>De:</strong> {{ Str::limit($booking->pickup_address, 30) }}
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            <strong>À:</strong> {{ Str::limit($booking->dropoff_address, 30) }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $booking->pickup_datetime->format('d/m/Y H:i') }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form method="POST" action="{{ route('admin.bookings.update', $booking->id) }}" class="inline">
                                            @csrf
                                            @method('PATCH')
                                            <select name="status" onchange="this.form.submit()"
                                                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-xs">
                                                <option value="new" {{ $booking->status == 'new' ? 'selected' : '' }}>Nouveau</option>
                                                <option value="confirmed" {{ $booking->status == 'confirmed' ? 'selected' : '' }}>Confirmé</option>
                                                <option value="completed" {{ $booking->status == 'completed' ? 'selected' : '' }}>Terminé</option>
                                                <option value="cancelled" {{ $booking->status == 'cancelled' ? 'selected' : '' }}>Annulé</option>
                                            </select>
                                        </form>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $booking->price_estimate ? number_format($booking->price_estimate, 2, ',', ' ') . '€' : 'À confirmer' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <x-button href="{{ route('admin.bookings.show', $booking->id) }}" variant="outline" size="sm">
                                                Voir
                                            </x-button>
                                            <x-button href="{{ route('admin.bookings.edit', $booking->id) }}" variant="outline" size="sm">
                                                Éditer
                                            </x-button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
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
                            Il n'y a pas encore de réservations.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
