@extends('layouts.admin')

@section('title', 'Tableau de bord - Administration VTC')
@section('description', 'Tableau de bord administrateur avec statistiques et gestion des réservations.')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Tableau de bord</h1>
            <p class="mt-2 text-gray-600">Vue d'ensemble de votre activité VTC</p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <x-stat title="Réservations aujourd'hui" :value="$stats['today_bookings'] ?? 0" description="Nouvelles réservations" />
            <x-stat title="Chiffre d'affaires aujourd'hui" :value="number_format($stats['today_revenue'] ?? 0, 0, ',', ' ') . '€'" description="Revenus du jour" />
            <x-stat title="Réservations cette semaine" :value="$stats['week_bookings'] ?? 0" description="7 derniers jours" />
            <x-stat title="Clients actifs" :value="$stats['active_customers'] ?? 0" description="Ce mois-ci" />
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-900 mb-4">Actions rapides</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <x-button href="{{ route('admin.bookings.create') }}" variant="primary">
                    Nouvelle réservation
                </x-button>
                <x-button href="{{ route('admin.bookings.index') }}" variant="outline">
                    Toutes les réservations
                </x-button>
                <x-button href="{{ route('admin.calendar') }}" variant="outline">
                    Voir le calendrier
                </x-button>
                <x-button href="{{ route('admin.settings') }}" variant="outline">
                    Paramètres
                </x-button>
            </div>
        </div>

        {{-- Today's Bookings --}}
        <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Réservations d'aujourd'hui</h2>
            </div>

            @if($todayBookings->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($todayBookings as $booking)
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
                                                {{ $booking->pickup_datetime->format('H:i') }} - {{ $booking->user ? $booking->user->name : 'Client anonyme' }}
                                            </h3>
                                            <p class="text-sm text-gray-600">
                                                De: {{ Str::limit($booking->pickup_address, 40) }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                À: {{ Str::limit($booking->dropoff_address, 40) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4">
                                    <div class="text-sm text-gray-900">
                                        {{ $booking->pax }}p, {{ $booking->luggage }}b
                                    </div>
                                    <x-button href="{{ route('admin.bookings.show', $booking->id) }}" variant="outline" size="sm">
                                        Voir
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10a2 2 0 002 2h4a2 2 0 002-2V11M9 11h6"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune réservation aujourd'hui</h3>
                    <p class="mt-1 text-sm text-gray-500">Profitez de votre journée !</p>
                </div>
            @endif
        </div>

        {{-- Upcoming Bookings --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-lg font-semibold text-gray-900">Prochaines prises en charge</h2>
            </div>

            @if($upcomingPickups->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($upcomingPickups as $booking)
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
                                                {{ $booking->pickup_datetime->format('d/m H:i') }} - {{ $booking->user ? $booking->user->name : 'Client anonyme' }}
                                            </h3>
                                            <p class="text-sm text-gray-600">
                                                {{ Str::limit($booking->pickup_address, 50) }}
                                            </p>
                                            <p class="text-sm text-gray-600">
                                                {{ $booking->pax }} passager{{ $booking->pax > 1 ? 's' : '' }}, {{ ucfirst($booking->vehicle_class) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex items-center space-x-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $booking->price_estimate ? number_format($booking->price_estimate, 0, ',', ' ') . '€' : 'À confirmer' }}
                                    </div>
                                    <x-button href="{{ route('admin.bookings.show', $booking->id) }}" variant="outline" size="sm">
                                        Détails
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune réservation à venir</h3>
                    <p class="mt-1 text-sm text-gray-500">Toutes les réservations sont à jour</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
