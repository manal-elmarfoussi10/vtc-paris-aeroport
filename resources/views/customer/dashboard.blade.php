@extends('layouts.app')

@section('title', 'Mon compte - VTC Paris Aéroport')
@section('description', 'Gérez vos réservations VTC, consultez votre historique et modifiez votre profil.')

@section('content')
<div class="min-h-screen bg-light-grey py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Mon compte</h1>
            <p class="mt-2 text-gray-600">Bienvenue, {{ auth()->user()->name }}</p>
        </div>

        {{-- Stats Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <x-stat title="Réservations totales" :value="$stats['total_bookings'] ?? 0" description="Depuis votre inscription" />
            <x-stat title="Réservations actives" :value="$upcomingBookings->whereIn('status', ['new', 'confirmed'])->count()" description="En cours" />
            <x-stat title="Dernière réservation" :value="$stats['last_booking'] ? $stats['last_booking']->format('d/m/Y') : 'Aucune'" description="Date" />
        </div>

        {{-- Quick Actions --}}
        <div class="bg-white rounded-lg shadow p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-900 mb-4">Actions rapides</h2>
            <div class="flex flex-wrap gap-4">
                <x-button href="{{ route('booking') }}" variant="primary">
                    Nouvelle réservation
                </x-button>
                <x-button href="{{ route('customer.bookings') }}" variant="outline">
                    Mes réservations
                </x-button>
                <x-button href="{{ route('customer.profile.edit') }}" variant="outline">
                    Modifier mon profil
                </x-button>
            </div>
        </div>

        {{-- Recent Bookings --}}
        <div class="bg-white rounded-lg shadow overflow-hidden mb-8">
            <div class="px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-900">Réservations récentes</h2>
            </div>

            @if($recentBookings->count() > 0)
                <div class="divide-y divide-gray-200">
                    @foreach($recentBookings as $booking)
                        <div class="p-6 hover:bg-gray-50">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($booking->status === 'confirmed') bg-green-100 text-green-800
                                                @elseif($booking->status === 'completed') bg-blue-100 text-blue-800
                                                @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                                @else bg-yellow-100 text-yellow-800 @endif">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-sm font-medium text-gray-900">
                                                {{ $booking->pickup_datetime->format('d/m/Y H:i') }}
                                            </h3>
                                            <p class="text-sm text-gray-600">
                                                {{ Str::limit($booking->pickup_address, 50) }} → {{ Str::limit($booking->dropoff_address, 50) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="flex items-center space-x-4">
                                    <span class="text-sm font-medium text-gray-900">
                                        {{ $booking->price_estimate ? number_format($booking->price_estimate, 2, ',', ' ') . '€' : 'Prix à confirmer' }}
                                    </span>
                                    <x-button href="{{ route('customer.bookings.show', $booking->id) }}" variant="outline" size="sm">
                                        Voir détails
                                    </x-button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    <x-button href="{{ route('customer.bookings') }}" variant="outline">
                        Voir toutes mes réservations
                    </x-button>
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Aucune réservation</h3>
                    <p class="mt-1 text-sm text-gray-500">Vous n'avez pas encore de réservation.</p>
                    <div class="mt-6">
                        <x-button href="{{ route('booking') }}" variant="primary">
                            Faire ma première réservation
                        </x-button>
                    </div>
                </div>
            @endif
        </div>

        {{-- Upcoming Bookings Alert --}}
        @php
            $upcoming = $upcomingBookings
                ->where('status', 'confirmed')
                ->where('pickup_datetime', '>', now())
                ->where('pickup_datetime', '<=', now()->addHours(24))
                ->first();
        @endphp

        @if($upcoming)
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <svg class="h-6 w-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-900">
                            Réservation dans moins de 24h
                        </h3>
                        <div class="mt-2 text-sm text-blue-800">
                            <p>
                                Votre chauffeur arrivera le {{ $upcoming->pickup_datetime->format('d/m/Y à H:i') }} à l'adresse :
                                <strong>{{ $upcoming->pickup_address }}</strong>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
