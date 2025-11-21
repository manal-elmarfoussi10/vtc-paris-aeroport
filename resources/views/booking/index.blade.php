@extends('layouts.app')

@section('title', 'Réserver un VTC - Transfert Paris Aéroports')
@section('description', 'Réservez votre chauffeur privé pour les aéroports CDG, Orly et Beauvais. Tarifs fixes, service premium 24h/24.')

@section('head')
<style>
/* Modern Booking Page Styles - Enhanced */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes gradientShift {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

@keyframes pulse {
    0%, 100% {
        transform: scale(1);
    }
    50% {
        transform: scale(1.05);
    }
}

@keyframes slideInLeft {
    from {
        opacity: 0;
        transform: translateX(-50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(50px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

@keyframes bounceIn {
    0% {
        opacity: 0;
        transform: scale(0.3);
    }
    50% {
        opacity: 1;
        transform: scale(1.05);
    }
    70% {
        transform: scale(0.9);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}

@keyframes shimmer {
    0% {
        background-position: -200% 0;
    }
    100% {
        background-position: 200% 0;
    }
}

/* Progress Bar - Enhanced */
.progress-container {
    position: relative;
    width: 100%;
    height: 6px;
    background: #e5e7eb;
    border-radius: 3px;
    overflow: hidden;
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);
}

.progress-bar {
    height: 100%;
    background: linear-gradient(90deg, #1e40af, #3b82f6, #60a5fa, #93c5fd);
    background-size: 300% 100%;
    animation: gradientShift 3s ease infinite, shimmer 2s linear infinite;
    transition: width 0.8s cubic-bezier(0.4, 0, 0.2, 1);
    border-radius: 3px;
}

/* Step Indicators - Enhanced */
.step-indicator {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: white;
    border: 3px solid #e5e7eb;
    color: #6b7280;
    font-weight: bold;
    font-size: 18px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    z-index: 1;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
}

.step-indicator.active {
    background: linear-gradient(135deg, #1e40af, #3b82f6);
    border-color: #1e40af;
    color: white;
    box-shadow: 0 0 30px rgba(59, 130, 246, 0.4), 0 4px 16px rgba(59, 130, 246, 0.2);
    animation: bounceIn 0.6s ease-out;
}

.step-indicator.completed {
    background: linear-gradient(135deg, #10b981, #34d399);
    border-color: #10b981;
    color: white;
    box-shadow: 0 0 20px rgba(16, 185, 129, 0.3);
}

.step-indicator::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(59, 130, 246, 0.3);
    transform: translate(-50%, -50%);
    transition: all 0.3s ease;
}

.step-indicator.active::before {
    width: 60px;
    height: 60px;
}

/* Card Styles - Enhanced */
.booking-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1), 0 1px 3px rgba(0, 0, 0, 0.05);
    border: 1px solid #f3f4f6;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    overflow: hidden;
    position: relative;
}

.booking-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.05), transparent);
    transition: left 0.5s ease;
}

.booking-card:hover {
    transform: translateY(-8px) scale(1.02);
    box-shadow: 0 25px 80px rgba(0, 0, 0, 0.15), 0 0 30px rgba(59, 130, 246, 0.1);
}

.booking-card:hover::before {
    left: 100%;
}

/* Form Elements - Enhanced */
.form-input-modern {
    border: 2px solid #e5e7eb;
    border-radius: 14px;
    padding: 14px 18px;
    font-size: 16px;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    background: white;
    position: relative;
    overflow: hidden;
}

.form-input-modern::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
    transition: left 0.4s ease;
}

.form-input-modern:focus {
    border-color: #3b82f6;
    box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.15), 0 4px 16px rgba(59, 130, 246, 0.1);
    outline: none;
    transform: translateY(-2px);
}

.form-input-modern:focus::before {
    left: 100%;
}

/* Map Container - Enhanced */
.map-container {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.15), 0 2px 8px rgba(0, 0, 0, 0.1);
    border: 2px solid #f3f4f6;
    transition: all 0.3s ease;
}

#map {
    min-height: 320px;
}

.map-container:hover {
    box-shadow: 0 12px 48px rgba(0, 0, 0, 0.2), 0 0 20px rgba(59, 130, 246, 0.1);
    border-color: #3b82f6;
}

/* Price Display - Enhanced */
.price-display {
    background: linear-gradient(135deg, #1e40af, #3b82f6, #60a5fa);
    color: white;
    border-radius: 16px;
    padding: 24px;
    text-align: center;
    position: relative;
    overflow: hidden;
    box-shadow: 0 8px 32px rgba(30, 64, 175, 0.3);
}

.price-display::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    animation: gradientShift 4s infinite;
}

.price-display::after {
    content: '';
    position: absolute;
    top: -50%;
    left: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
    animation: pulse 3s ease-in-out infinite;
}

/* Service Cards - Enhanced */
.service-card {
    background: white;
    border: 2px solid #f3f4f6;
    border-radius: 16px;
    padding: 20px;
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    cursor: pointer;
    position: relative;
    overflow: hidden;
}

.service-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(135deg, rgba(59, 130, 246, 0.05), rgba(147, 197, 253, 0.05));
    opacity: 0;
    transition: opacity 0.3s ease;
}

.service-card:hover {
    border-color: #3b82f6;
    transform: translateY(-6px) scale(1.02);
    box-shadow: 0 12px 40px rgba(59, 130, 246, 0.2), 0 0 20px rgba(59, 130, 246, 0.1);
}

.service-card:hover::before {
    opacity: 1;
}

.service-card.selected {
    border-color: #3b82f6;
    background: linear-gradient(135deg, #eff6ff, #dbeafe);
    box-shadow: 0 8px 32px rgba(59, 130, 246, 0.25);
}

.service-card.selected::before {
    opacity: 1;
}

/* Floating Action Button - Enhanced */
.fab {
    position: fixed;
    bottom: 32px;
    right: 32px;
    width: 64px;
    height: 64px;
    border-radius: 50%;
    background: linear-gradient(135deg, #1e40af, #3b82f6, #60a5fa);
    background-size: 200% 200%;
    color: white;
    border: none;
    box-shadow:
        0 8px 32px rgba(59, 130, 246, 0.4),
        0 4px 16px rgba(59, 130, 246, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
    cursor: pointer;
    transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    z-index: 1000;
    display: flex;
    align-items: center;
    justify-content: center;
    animation: float 3s ease-in-out infinite;
}

.fab::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.4);
    transform: translate(-50%, -50%);
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.fab:hover {
    transform: scale(1.15) rotate(180deg);
    box-shadow:
        0 16px 48px rgba(59, 130, 246, 0.6),
        0 8px 24px rgba(59, 130, 246, 0.4),
        0 0 40px rgba(59, 130, 246, 0.3);
    background-position: right中心;
}

.fab:hover::before {
    width: 100px;
    height: 100px;
}

.fab:active {
    transform: scale(0.95) rotate(180deg);
}

/* Floating Animation */
@keyframes float {
    0%, 100% {
        transform: translateY(0px);
    }
    50% {
        transform: translateY(-10px);
    }
}

/* Pulse Animation for Active Elements */
@keyframes pulse-glow {
    0%, 100% {
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
    }
    50% {
        box-shadow: 0 0 40px rgba(59, 130, 246, 0.6), 0 0 60px rgba(59, 130, 246, 0.4);
    }
}

.step-indicator.active {
    animation: pulse-glow 2s ease-in-out infinite;
}

/* Advanced Button Animations */
button:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
}

button:active {
    transform: translateY(0px);
    transition: all 0.1s ease;
}

/* Ripple Effect */
@keyframes ripple {
    0% {
        transform: scale(0);
        opacity: 1;
    }
    100% {
        transform: scale(4);
        opacity: 0;
    }
}

.ripple {
    position: relative;
    overflow: hidden;
}

.ripple::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 5px;
    height: 5px;
    background: rgba(255, 255, 255, 0.5);
    opacity: 0;
    border-radius: 100%;
    transform: scale(1, 1) translate(-50%);
    transform-origin: 50% 50%;
}

.ripple:focus:not(:active)::after {
    animation: ripple 1s ease-out;
}

/* Staggered Animation for Cards */
.animate-stagger-1 { animation-delay: 0.1s; }
.animate-stagger-2 { animation-delay: 0.2s; }
.animate-stagger-3 { animation-delay: 0.3s; }
.animate-stagger-4 { animation-delay: 0.4s; }

/* 3D Transform Effects */
.perspective-1000 {
    perspective: 1000px;
}

.transform-3d {
    transform-style: preserve-3d;
}

/* Advanced Gradient Animations */
.price-display {
    background: linear-gradient(135deg, #1e40af, #3b82f6, #60a5fa, #93c5fd, #1e40af);
    background-size: 400% 400%;
    animation: gradient-shift 8s ease infinite;
}

@keyframes gradient-shift {
    0%, 100% {
        background-position: 0% 50%;
    }
    50% {
        background-position: 100% 50%;
    }
}

/* Interactive Map Enhancements */
.map-container:hover {
    transform: scale(1.02);
    box-shadow:
        0 20px 60px rgba(0, 0, 0, 0.2),
        0 0 30px rgba(59, 130, 246, 0.15),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

/* Form Element Advanced Effects */
.form-input-modern:focus {
    transform: translateY(-3px) scale(1.01);
    box-shadow:
        0 0 0 4px rgba(59, 130, 246, 0.15),
        0 8px 25px rgba(59, 130, 246, 0.1),
        0 0 40px rgba(59, 130, 246, 0.05);
}

.form-input-modern:focus::before {
    left: 100%;
    background: linear-gradient(90deg,
        transparent,
        rgba(59, 130, 246, 0.2),
        rgba(147, 197, 253, 0.2),
        transparent
    );
}

/* Loading States with Animation */
.loading {
    position: relative;
    overflow: hidden;
}

.loading::after {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg,
        transparent,
        rgba(59, 130, 246, 0.1),
        rgba(147, 197, 253, 0.1),
        transparent
    );
    animation: shimmer 1.5s infinite;
}

/* Success Animation */
@keyframes success-bounce {
    0%, 20%, 50%, 80%, 100% {
        transform: translateY(0);
    }
    40% {
        transform: translateY(-10px);
    }
    60% {
        transform: translateY(-5px);
    }
}

.success-checkmark {
    width: 24px;
    height: 24px;
    border-radius: 50%;
    background: #10b981;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-weight: bold;
    animation: success-bounce 1s ease-out, bounceIn 0.6s ease-out;
}

/* (media queries and other styles you had – keep them the same) */
/* ... I shortened here to keep the answer readable, but in your file keep ALL the CSS you pasted before ... */

</style>

<script defer src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initMap"></script>
@endsection

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 to-blue-50 pt-20 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Hero Section --}}
        <div class="text-center mb-12 animate-fade-in-up">
            <br><br><br><br>
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-600 to-blue-800 rounded-full mb-6 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3a2 2 0 012-2h4a2 2 0 012 2v4m-6 4v10m0 0l-2-2m2 2l2-2m4-6v2a2 2 0 01-2 2H8a2 2 0 01-2-2v-2a2 2 0 012-2h8a2 2 0 012 2z"></path>
                </svg>
            </div>
            <h1 class="text-4xl sm:text-5xl lg:text-6xl font-bold text-gray-900 mb-4">
                Réservez votre <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-800">VTC </span>
            </h1>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto leading-relaxed">
                Voyagez en toute sérénité vers les aéroports parisiens avec nos chauffeurs professionnels
            </p>
        </div>

        {{-- Progress Bar --}}
        <div class="mb-12 animate-fade-in-up">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="step-indicator active" id="step-1">1</div>
                    <span class="ml-4 text-base font-semibold text-gray-900">Trajet</span>
                </div>
                <div class="flex items-center">
                    <div class="step-indicator" id="step-2">2</div>
                    <span class="ml-4 text-base font-semibold text-gray-600">Détails</span>
                </div>
                <div class="flex items-center">
                    <div class="step-indicator" id="step-3">3</div>
                    <span class="ml-4 text-base font-semibold text-gray-600">Confirmation</span>
                </div>
            </div>
            <div class="progress-container">
                <div class="progress-bar" id="progress-bar" style="width: 33%"></div>
            </div>
        </div>

        {{-- Floating Action Button --}}
        <button type="button" class="fab ripple" onclick="scrollToTop()" title="Retour en haut">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
        </button>

        {{-- Booking Form --}}
        <form method="POST" action="{{ route('booking.store') }}" class="space-y-8 perspective-1000 transform-3d bg-dynamic-gradient" id="booking-form">
            @csrf
            <x-auth-session-status class="mb-4" :status="session('status')" />
        
            {{-- STEP 1 – TRAJET --}}
            <div id="step-1-content" class="step-transition">
                <div class="booking-card p-6 md:p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 mr-3">
                            1
                        </span>
                        Informations sur votre trajet
                    </h2>
        
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        {{-- Left side: form fields --}}
                        <div class="space-y-5">
                            {{-- Pickup --}}
                            <div>
                                <label for="pickup_address" class="block text-sm font-medium text-gray-700 mb-1">
                                    Adresse de départ *
                                </label>
                                <input
                                    type="text"
                                    id="pickup_address"
                                    name="pickup_address"
                                    class="w-full form-input-modern"
                                    placeholder="Ex : 10 Rue de Rivoli, 75001 Paris"
                                    value="{{ old('pickup_address') }}"
                                    required
                                >
                                @error('pickup_address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
        
                            {{-- Dropoff --}}
                            <div>
                                <label for="dropoff_address" class="block text-sm font-medium text-gray-700 mb-1">
                                    Adresse d'arrivée *
                                </label>
                                <input
                                    type="text"
                                    id="dropoff_address"
                                    name="dropoff_address"
                                    class="w-full form-input-modern"
                                    placeholder="Ex : Aéroport CDG, Terminal 2E"
                                    value="{{ old('dropoff_address') }}"
                                    required
                                >
                                @error('dropoff_address')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
        
                            {{-- Date & time --}}
                            <div>
                                <label for="pickup_datetime" class="block text-sm font-medium text-gray-700 mb-1">
                                    Date & heure de prise en charge *
                                </label>
                                <input
                                    type="datetime-local"
                                    id="pickup_datetime"
                                    name="pickup_datetime"
                                    class="w-full form-input-modern"
                                    value="{{ old('pickup_datetime') }}"
                                    required
                                >
                                @error('pickup_datetime')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
        
                            {{-- Passengers --}}
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="pax" class="block text-sm font-medium text-gray-700 mb-1">
                                        Passagers *
                                    </label>
                                    <select id="pax" name="pax" class="w-full form-input-modern" required>
                                        <option value="">Sélectionnez</option>
                                        @for($i = 1; $i <= 8; $i++)
                                            <option value="{{ $i }}" {{ old('pax') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('pax')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
        
                                <div>
                                    <label for="luggage" class="block text-sm font-medium text-gray-700 mb-1">
                                        Bagages *
                                    </label>
                                    <select id="luggage" name="luggage" class="w-full form-input-modern" required>
                                        <option value="">Sélectionnez</option>
                                        @for($i = 0; $i <= 8; $i++)
                                            <option value="{{ $i }}" {{ old('luggage') == $i ? 'selected' : '' }}>{{ $i }}</option>
                                        @endfor
                                    </select>
                                    @error('luggage')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
        
                        {{-- Right side: map + distance --}}
                        <div class="space-y-5">
                            <div class="map-container loading">
                                <div id="map"></div>
                            </div>
        
                            <div class="grid grid-cols-2 gap-4">
                                <div class="price-display relative overflow-hidden">
                                    <p class="text-sm opacity-80">Distance estimée</p>
                                    <p class="mt-2 text-2xl font-bold" id="distance-display">–</p>
                                </div>
                                <div class="price-display relative overflow-hidden">
                                    <p class="text-sm opacity-80">Durée estimée</p>
                                    <p class="mt-2 text-2xl font-bold" id="duration-display">–</p>
                                </div>
                            </div>
                        </div>
                    </div>
        
                    {{-- Step 1 actions --}}
                    <div class="mt-8 flex justify-end">
                        <button
                            type="button"
                            onclick="nextStep(2)"
                            class="inline-flex items-center px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 ripple"
                        >
                            Continuer
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        
            {{-- STEP 2 – DÉTAILS & VÉHICULE --}}
            <div id="step-2-content" class="step-transition hidden">
                <div class="booking-card p-6 md:p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 mr-3">
                            2
                        </span>
                        Choisissez votre véhicule et options
                    </h2>
        
                    <div class="space-y-8">
                        {{-- Vehicle list --}}
                        <div>
                            <h3 class="text-lg font-semibold mb-3">Classe de véhicule *</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                @foreach($vehicles as $vehicle)
                                    <div class="service-card animate-stagger-{{ $loop->index + 1 }}">
                                        <input
                                            type="radio"
                                            class="hidden vehicle-radio"
                                            name="vehicle_class"
                                            value="{{ $vehicle->class }}"
                                            id="vehicle_{{ $vehicle->id }}"
                                        >
                                        <div class="flex justify-between items-start mb-2">
                                            <h4 class="font-semibold text-gray-900">
                                                {{ $vehicle->name }}
                                            </h4>
                                            <span class="text-xs px-2 py-1 rounded-full bg-blue-100 text-blue-700">
                                                {{ $vehicle->capacity_pax }} pers.
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-600 mb-2">
                                            {{ $vehicle->getClassLabelAttribute() }}
                                        </p>
                                        @if($vehicle->photo_path)
                                            <img
                                                src="{{ asset('storage/' . $vehicle->photo_path) }}"
                                                alt="{{ $vehicle->name }}"
                                                class="w-full h-24 object-cover rounded-lg mb-3"
                                            >
                                        @endif
                                        <p class="text-2xl font-bold text-gray-900 mb-3">
                                            {{ number_format($vehicle->base_rate, 0, ',', ' ') }}€
                                        </p>
                                        <button
                                            type="button"
                                            class="w-full bg-blue-600 text-white py-2 px-4 rounded-lg hover:bg-blue-700 transition-colors"
                                            onclick="selectVehicle('{{ $vehicle->class }}', this.closest('.service-card'))"
                                        >
                                            Choisir ce véhicule
                                        </button>
                                    </div>
                                @endforeach
                            </div>
                            @error('vehicle_class')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
        
                        {{-- Options --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <div class="space-y-2">
                                <h3 class="text-lg font-semibold">Options supplémentaires</h3>
        
                                <label class="flex items-center space-x-3">
                                    <input
                                        type="checkbox"
                                        id="child_seat_count"
                                        name="child_seat_count"
                                        value="1"
                                        class="h-4 w-4 text-blue-600 border-gray-300 rounded"
                                        {{ old('child_seat_count') ? 'checked' : '' }}
                                    >
                                    <span class="text-sm text-gray-700">Siège enfant (+15€)</span>
                                </label>
        
                                <label class="flex items-center space-x-3">
                                    <input
                                        type="checkbox"
                                        id="meet_greet"
                                        name="meet_greet"
                                        value="1"
                                        class="h-4 w-4 text-blue-600 border-gray-300 rounded"
                                        {{ old('meet_greet') ? 'checked' : '' }}
                                    >
                                    <span class="text-sm text-gray-700">Accueil à l'aéroport (+10€)</span>
                                </label>
                            </div>
        
                            {{-- Customer --}}
                            <div class="space-y-3">
                                <h3 class="text-lg font-semibold">Vos coordonnées</h3>
        
                                <div>
                                    <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">
                                        Nom & prénom *
                                    </label>
                                    <input
                                        type="text"
                                        id="customer_name"
                                        name="customer_name"
                                        class="w-full form-input-modern"
                                        placeholder="Ex : Jean Dupont"
                                        value="{{ old('customer_name') }}"
                                        required
                                    >
                                    @error('customer_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
        
                                <div>
                                    <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">
                                        Téléphone
                                    </label>
                                    <input
                                        type="text"
                                        id="customer_phone"
                                        name="customer_phone"
                                        class="w-full form-input-modern"
                                        placeholder="+33 6 12 34 56 78"
                                        value="{{ old('customer_phone') }}"
                                    >
                                </div>
                            </div>
        
                            {{-- Price --}}
                            <div class="space-y-3">
                                <h3 class="text-lg font-semibold">Prix estimé</h3>
                                <div class="price-display">
                                    <p class="text-sm opacity-80">Montant estimatif du trajet</p>
                                    <p class="mt-3 text-3xl font-extrabold" id="price-estimate">
                                        À calculer
                                    </p>
                                    <p class="mt-1 text-xs opacity-70">
                                        Prix final confirmé après validation de votre réservation.
                                    </p>
                                </div>
                            </div>
                        </div>
        
                        {{-- Notes --}}
                        <div>
                            <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                                Commentaires au chauffeur (optionnel)
                            </label>
                            <textarea
                                id="notes"
                                name="notes"
                                rows="3"
                                class="w-full form-input-modern"
                                placeholder="Interphone, code porte, numéro de vol..."
                            >{{ old('notes') }}</textarea>
                        </div>
                    </div>
        
                    {{-- Step 2 actions --}}
                    <div class="mt-8 flex justify-between">
                        <button type="button" onclick="prevStep(1)" class="inline-flex items-center px-5 py-3 rounded-xl border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 ripple">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Retour
                        </button>
        
                        <button type="button" onclick="nextStep(3)" class="inline-flex items-center px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 ripple">
                            Continuer
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        
            {{-- STEP 3 – CONFIRMATION --}}
            <div id="step-3-content" class="step-transition hidden">
                <div class="booking-card p-6 md:p-8 mb-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                        <span class="w-10 h-10 flex items-center justify-center rounded-full bg-blue-100 text-blue-600 mr-3">
                            3
                        </span>
                        Vérifiez et confirmez votre réservation
                    </h2>
        
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="space-y-3">
                            <h3 class="font-semibold text-gray-800 mb-2">Trajet</h3>
                            <p class="text-sm text-gray-600"><strong>Départ :</strong> <span id="summary-pickup">–</span></p>
                            <p class="text-sm text-gray-600"><strong>Arrivée :</strong> <span id="summary-dropoff">–</span></p>
                            <p class="text-sm text-gray-600"><strong>Date & heure :</strong> <span id="summary-datetime">–</span></p>
                            <p class="text-sm text-gray-600"><strong>Passagers :</strong> <span id="summary-passengers">–</span></p>
                            <p class="text-sm text-gray-600"><strong>Bagages :</strong> <span id="summary-luggage">–</span></p>
                        </div>
        
                        <div class="space-y-3">
                            <h3 class="font-semibold text-gray-800 mb-2">Véhicule & client</h3>
                            <p class="text-sm text-gray-600"><strong>Véhicule :</strong> <span id="summary-vehicle">–</span></p>
                            <p class="text-sm text-gray-600"><strong>Prix estimé :</strong> <span id="summary-total">À calculer</span></p>
                            <p class="text-sm text-gray-600"><strong>Client :</strong> <span id="summary-customer">–</span></p>
                        </div>
                    </div>
        
                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 mb-6 text-sm text-blue-900">
                        En cliquant sur "Confirmer la réservation", vous envoyez votre demande à notre équipe.
                        Nous vous recontacterons pour confirmer le prix final et le chauffeur.
                    </div>
        
                    <div class="flex items-center mb-6">
                        <input
                            type="checkbox"
                            id="terms"
                            required
                            class="h-4 w-4 text-blue-600 border-gray-300 rounded"
                        >
                        <label for="terms" class="ml-2 text-sm text-gray-700">
                            J'ai lu et j'accepte les conditions générales de vente.
                        </label>
                    </div>
        
                    <div class="flex justify-between">
                        <button type="button" onclick="prevStep(2)" class="inline-flex items-center px-5 py-3 rounded-xl border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 ripple">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Retour
                        </button>
        
                        <button
                            type="submit"
                            class="inline-flex items-center px-6 py-3 rounded-xl bg-blue-600 text-white font-semibold shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 ripple"
                        >
                            Confirmer la réservation
                        </button>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection

@section('scripts')
<script>
let currentDistance = 0; // km
let currentDuration = 0; // minutes
let currentStep     = 1;

// dummy for Google Maps callback
function initMap() {}

// scroll to top
function scrollToTop() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// fill confirmation (step 3)
function updateBookingSummary() {
    const pickup   = document.getElementById('pickup_address')?.value || '';
    const dropoff  = document.getElementById('dropoff_address')?.value || '';
    const datetime = document.getElementById('pickup_datetime')?.value || '';
    const pax      = document.getElementById('pax')?.value || '';
    const luggage  = document.getElementById('luggage')?.value || '';
    const customer = document.getElementById('customer_name')?.value || '';

    document.getElementById('summary-pickup').textContent     = pickup   || 'À définir';
    document.getElementById('summary-dropoff').textContent    = dropoff  || 'À définir';
    document.getElementById('summary-datetime').textContent   = datetime || 'À définir';
    document.getElementById('summary-passengers').textContent = pax      || 'À définir';
    document.getElementById('summary-luggage').textContent    = luggage  || 'À définir';
    document.getElementById('summary-customer').textContent   = customer || 'À définir';

    const vehicleRadio = document.querySelector('input[name="vehicle_class"]:checked');
    if (vehicleRadio) {
        const card  = vehicleRadio.closest('.service-card');
        const name  = card.querySelector('h4')?.textContent || 'À définir';
        const price = card.querySelector('.text-2xl')?.textContent || 'À définir';

        document.getElementById('summary-vehicle').textContent       = name;
        document.getElementById('summary-vehicle-price').textContent = price;
    }

    document.getElementById('summary-total').textContent =
        document.getElementById('price-estimate')?.textContent || 'À calculer';
}

// step navigation
function nextStep(step) {
    if (validateCurrentStep()) {
        showStep(step);
    }
}
function prevStep(step) {
    showStep(step);
}
function showStep(step) {
    document.querySelectorAll('.step-transition').forEach(el => el.classList.add('hidden'));

    const target = document.getElementById(`step-${step}-content`);
    if (target) target.classList.remove('hidden');

    document.querySelectorAll('.step-indicator').forEach((ind, idx) => {
        const n = idx + 1;
        ind.classList.remove('active', 'completed');
        if (n === step) ind.classList.add('active');
        else if (n < step) ind.classList.add('completed');
    });

    document.getElementById('progress-bar').style.width = `${(step / 3) * 100}%`;

    currentStep = step;
    if (step === 3) updateBookingSummary();
}

function validateCurrentStep() {
    let ok = true;

    if (currentStep === 1) {
        const pickup   = document.getElementById('pickup_address').value.trim();
        const dropoff  = document.getElementById('dropoff_address').value.trim();
        const datetime = document.getElementById('pickup_datetime').value;
        const pax      = document.getElementById('pax').value;

        if (!pickup || !dropoff || !datetime || !pax) {
            ok = false;
            alert('Veuillez remplir tous les champs obligatoires.');
        }
    } else if (currentStep === 2) {
        const luggage = document.getElementById('luggage').value;
        const vehicle = document.querySelector('input[name="vehicle_class"]:checked');
        if (!luggage || !vehicle) {
            ok = false;
            alert('Veuillez sélectionner un véhicule et indiquer le nombre de bagages.');
        }
    }

    return ok;
}

// distance API
let distanceTimeout;
async function updateDistance() {
    const pickup  = document.getElementById('pickup_address').value.trim();
    const dropoff = document.getElementById('dropoff_address').value.trim();

    if (!pickup || !dropoff) {
        currentDistance = 0;
        currentDuration = 0;
        updatePrice();
        return;
    }

    try {
        const response = await fetch("{{ route('booking.distance') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({ origin: pickup, destination: dropoff }),
        });

        const json = await response.json();

        if (json.success) {
            const data = json.data;
            currentDistance = data.distance_value / 1000;
            currentDuration = data.duration_value / 60;

            document.getElementById('distance-display').textContent = data.distance_text;
            document.getElementById('duration-display').textContent = data.duration_text;
        } else {
            currentDistance = 0;
            currentDuration = 0;
        }
    } catch (e) {
        console.error(e);
        currentDistance = 0;
        currentDuration = 0;
    }

    updatePrice();
}
function scheduleDistanceUpdate() {
    clearTimeout(distanceTimeout);
    distanceTimeout = setTimeout(updateDistance, 800);
}

// price
function updatePrice() {
    const selectedVehicle = document.querySelector('input[name="vehicle_class"]:checked');
    const vehicleClass    = selectedVehicle ? selectedVehicle.value : null;

    const childSeat = document.querySelector('input[name="child_seat_count"]')?.checked ?? false;
    const meetGreet = document.querySelector('input[name="meet_greet"]')?.checked ?? false;

    let basePrice = 0, perKm = 0;
    switch (vehicleClass) {
        case 'business':
            basePrice = 80; perKm = 2.0; break;
        case 'van':
            basePrice = 100; perKm = 2.5; break;
        case 'sedan':
        default:
            basePrice = 60; perKm = 1.5;
    }

    let total = basePrice;
    if (currentDistance > 0) total += currentDistance * perKm;
    if (childSeat) total += 15;
    if (meetGreet) total += 10;

    const el = document.getElementById('price-estimate');
    if (el) el.textContent = total > 0 ? `${Math.round(total)}€` : 'À calculer';
}

// vehicle select
function selectVehicle(vehicleClass, el) {
    document.querySelectorAll('.service-card').forEach(card => card.classList.remove('selected'));
    el.classList.add('selected');
    const radio = el.querySelector('.vehicle-radio');
    if (radio) radio.checked = true;
    updatePrice();
}

// init
document.addEventListener('DOMContentLoaded', () => {
    const pickup  = document.getElementById('pickup_address');
    const dropoff = document.getElementById('dropoff_address');

    if (pickup)  pickup.addEventListener('input', scheduleDistanceUpdate);
    if (dropoff) dropoff.addEventListener('input', scheduleDistanceUpdate);

    const form = document.getElementById('booking-form');
    if (form) {
        form.addEventListener('change', updatePrice);
        form.addEventListener('input', updatePrice);
    }
});
</script>
@endsection