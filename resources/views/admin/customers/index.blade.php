@extends('layouts.admin')

@section('title', 'Gestion des clients - Administration')
@section('description', 'Liste et gestion de tous les clients inscrits.')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Clients</h1>
            <p class="mt-2 text-gray-600">Gestion de la base clients</p>
        </div>

        {{-- Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <x-stat title="Total clients" :value="$customers->total()" description="Inscrits" />
            <x-stat title="Clients actifs" :value="$customers->where('total_bookings', '>', 0)->count()" description="Avec réservations" />
            <x-stat title="Nouveaux ce mois" :value="$customers->where('created_at', '>=', now()->startOfMonth())->count()" description="Ce mois-ci" />
        </div>

        {{-- Customers Table --}}
        <div class="bg-white rounded-lg shadow overflow-hidden">
            @if($customers->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Client</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statistiques</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dernière réservation</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($customers as $customer)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="flex items-center">
                                            <div class="flex-shrink-0 h-10 w-10">
                                                <div class="h-10 w-10 rounded-full bg-blue-primary flex items-center justify-center">
                                                    <span class="text-sm font-medium text-white">
                                                        {{ substr($customer->user->name, 0, 1) }}
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="ml-4">
                                                <div class="text-sm font-medium text-gray-900">
                                                    {{ $customer->user->name }}
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                    Membre depuis {{ $customer->user->created_at->format('M Y') }}
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $customer->user->email }}</div>
                                        <div class="text-sm text-gray-500">{{ $customer->user->phone ?? 'Pas de téléphone' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $customer->total_bookings }} réservation{{ $customer->total_bookings > 1 ? 's' : '' }}</div>
                                        <div class="text-sm text-gray-500">
                                            @if($customer->last_booking_at)
                                                Dernière: {{ $customer->last_booking_at->diffForHumans() }}
                                            @else
                                                Aucune réservation
                                            @endif
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        @if($customer->last_booking_at)
                                            {{ $customer->last_booking_at->format('d/m/Y') }}
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex space-x-2">
                                            <x-button href="{{ route('admin.customers.show', $customer->id) }}" variant="outline" size="sm">
                                                Voir
                                            </x-button>
                                            <x-button href="{{ route('admin.customers.edit', $customer->id) }}" variant="outline" size="sm">
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
                    {{ $customers->links() }}
                </div>
            @else
                <div class="px-6 py-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Aucun client trouvé</h3>
                    <p class="mt-1 text-sm text-gray-500">Il n'y a pas encore de clients inscrits.</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
