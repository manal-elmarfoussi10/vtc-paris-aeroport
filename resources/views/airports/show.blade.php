@extends('layouts.app')

@section('title', $airport->seo_title ?? "Transfert VTC {$airport->name} - {$airport->code}")
@section('description', $airport->seo_description ?? "Service de transfert VTC vers {$airport->name}. Réservation en ligne, chauffeur professionnel, tarifs fixes.")

@section('content')
<div class="min-h-screen bg-light-grey py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-8">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">{{ $airport->name }}</h1>
            <p class="text-xl text-gray-600">{{ $airport->description }}</p>
        </div>

        {{-- Airport Info Cards --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-2xl font-bold text-blue-primary mb-1">{{ number_format($airport->base_rate_to_paris, 0, ',', ' ') }}€</div>
                <div class="text-sm text-gray-600">Tarif de base vers Paris</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-2xl font-bold text-blue-primary mb-1">{{ $airport->transfer_time_city }} min</div>
                <div class="text-sm text-gray-600">Temps de trajet</div>
            </div>
            <div class="bg-white rounded-lg shadow p-6 text-center">
                <div class="text-2xl font-bold text-blue-primary mb-1">{{ $airport->transfer_time_airport }} min</div>
                <div class="text-sm text-gray-600">Temps d'attente gratuit</div>
            </div>
        </div>

        {{-- Main Content --}}
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <div class="prose prose-lg max-w-none">
                {!! $airport->seo_text !!}
            </div>
        </div>

        {{-- Pricing Table --}}
        <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
            <h2 class="text-2xl font-bold text-gray-900 mb-6">Tarifs de transfert</h2>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Véhicule</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Capacité</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tarif</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($vehicles as $vehicle)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ ucfirst($vehicle->class) }}</div>
                                    <div class="text-sm text-gray-500">{{ $vehicle->name }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ $vehicle->capacity_pax }} passager{{ $vehicle->capacity_pax > 1 ? 's' : '' }}, {{ $vehicle->capacity_luggage }} bagage{{ $vehicle->capacity_luggage > 1 ? 's' : '' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    À partir de {{ number_format($airport->base_rate_to_paris + $vehicle->base_rate, 0, ',', ' ') }}€
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm">
                                    <x-button href="{{ route('booking') }}?airport={{ $airport->slug }}&vehicle={{ $vehicle->class }}" variant="primary" size="sm">
                                        Réserver
                                    </x-button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- FAQ Section --}}
        @if($airport->faq)
            <div class="bg-white rounded-lg shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Questions fréquentes</h2>

                <div class="space-y-4">
                    @foreach($airport->faq as $item)
                        <div class="border-b border-gray-200 pb-4">
                            <h3 class="text-lg font-medium text-gray-900 mb-2">{{ $item['question'] }}</h3>
                            <p class="text-gray-600">{{ $item['answer'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- CTA Section --}}
        <div class="bg-blue-primary rounded-lg p-8 text-center text-white">
            <h2 class="text-3xl font-bold mb-4">Prêt à réserver votre transfert ?</h2>
            <p class="text-xl mb-6 text-blue-100">Réservation en ligne simple et rapide</p>
            <x-button href="{{ route('booking') }}?airport={{ $airport->slug }}" variant="secondary" size="lg">
                Réserver maintenant
            </x-button>
        </div>
    </div>
</div>
@endsection
