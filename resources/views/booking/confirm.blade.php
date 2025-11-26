@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-6 bg-white rounded shadow mt-8">
    <h1 class="text-2xl font-bold mb-4">Confirmation de réservation</h1>

    @if(session('status'))
        <div class="bg-green-100 text-green-800 p-3 mb-6 rounded">
            {{ session('status') }}
        </div>
    @endif

    <div class="mb-6">
        <h2 class="text-xl font-semibold mb-2">Détails de la réservation</h2>
        <ul class="list-disc list-inside space-y-1 text-gray-700">
            <li><strong>Trajet :</strong> {{ $booking->pickup_address }} → {{ $booking->dropoff_address }}</li>
            <li><strong>Heure de prise en charge :</strong> {{ \Carbon\Carbon::parse($booking->pickup_time)->format('d/m/Y H:i') }}</li>
            <li><strong>Véhicule :</strong> {{ optional($booking->vehicle)->class ?? $booking->vehicle_class }}</li>
            <li><strong>Client :</strong> {{ $booking->customer_name }} ({{ $booking->customer_email }})</li>
            <li><strong>Nombre de passagers :</strong> {{ $booking->pax }}</li>
            <li><strong>Bagages :</strong> {{ $booking->luggage }}</li>
            <li><strong>Options :</strong>
                @php
                    $options = [];
                    if ($booking->child_seat_count) {
                        $options[] = $booking->child_seat_count . ' siège(s) enfant';
                    }
                    if ($booking->meet_greet) {
                        $options[] = 'Meet & Greet';
                    }
                @endphp
                {{ $options ? implode(', ', $options) : 'Aucune' }}
            </li>
            <li><strong>Prix estimé :</strong> {{ number_format($booking->price, 0, ',', ' ') }} €</li>
            @if($booking->notes)
            <li><strong>Notes :</strong> {{ $booking->notes }}</li>
            @endif
        </ul>
    </div>

    <a href="{{ route('booking') }}" class="inline-block mt-4 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded">
        Retour à la page de réservation
    </a>
</div>
@endsection
