@extends('layouts.admin')

@section('title', 'Paramètres - Administration')
@section('description', 'Configuration générale du système VTC.')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Paramètres</h1>
            <p class="mt-2 text-gray-600">Configuration générale du système</p>
        </div>

        {{-- Settings Form --}}
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <form method="POST" action="{{ route('admin.settings.update') }}" class="p-8">
                @csrf

                {{-- Company Information --}}
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Informations société</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Company Name --}}
                        <div>
                            <x-input-label for="company_name" value="Nom société" />
                            <x-text-input id="company_name" name="company_name" type="text"
                                class="mt-1 block w-full"
                                :value="old('company_name', 'VTC Paris Aéroport')" />
                            <x-input-error :messages="$errors->get('company_name')" class="mt-2" />
                        </div>

                        {{-- Company Email --}}
                        <div>
                            <x-input-label for="company_email" value="E-mail société *" />
                            <x-text-input id="company_email" name="company_email" type="email"
                                class="mt-1 block w-full"
                                :value="old('company_email', 'contact@vtc-paris-aeroport.fr')"
                                required />
                            <x-input-error :messages="$errors->get('company_email')" class="mt-2" />
                        </div>

                        {{-- Admin Password --}}
                        <div>
                            <x-input-label for="admin_password" value="Mot de passe admin" />
                            <x-text-input id="admin_password" name="admin_password" type="password"
                                class="mt-1 block w-full"
                                placeholder="Nouveau mot de passe" />
                            <x-input-error :messages="$errors->get('admin_password')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-600">Laissez vide pour ne pas changer</p>
                        </div>
                    </div>
                </div>

                {{-- Pricing Settings --}}
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Tarification</h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {{-- Base Rates --}}
                        <div class="md:col-span-2 lg:col-span-3">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Tarifs de base par classe</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <x-input-label for="pricing_base_sedan" value="Berline (€)" />
                                    <x-text-input id="pricing_base_sedan" name="pricing_base_sedan" type="number" step="0.01"
                                        class="mt-1 block w-full"
                                        :value="old('pricing_base_sedan', \App\Models\Setting::get('pricing_base_sedan', 60.00))" />
                                    <x-input-error :messages="$errors->get('pricing_base_sedan')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="pricing_base_business" value="Business (€)" />
                                    <x-text-input id="pricing_base_business" name="pricing_base_business" type="number" step="0.01"
                                        class="mt-1 block w-full"
                                        :value="old('pricing_base_business', \App\Models\Setting::get('pricing_base_business', 80.00))" />
                                    <x-input-error :messages="$errors->get('pricing_base_business')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="pricing_base_van" value="Van (€)" />
                                    <x-text-input id="pricing_base_van" name="pricing_base_van" type="number" step="0.01"
                                        class="mt-1 block w-full"
                                        :value="old('pricing_base_van', \App\Models\Setting::get('pricing_base_van', 100.00))" />
                                    <x-input-error :messages="$errors->get('pricing_base_van')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- Per KM Rates --}}
                        <div class="md:col-span-2 lg:col-span-3">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Tarif par kilomètre</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <x-input-label for="pricing_per_km_sedan" value="Berline (€/km)" />
                                    <x-text-input id="pricing_per_km_sedan" name="pricing_per_km_sedan" type="number" step="0.01"
                                        class="mt-1 block w-full"
                                        :value="old('pricing_per_km_sedan', \App\Models\Setting::get('pricing_per_km_sedan', 1.50))" />
                                    <x-input-error :messages="$errors->get('pricing_per_km_sedan')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="pricing_per_km_business" value="Business (€/km)" />
                                    <x-text-input id="pricing_per_km_business" name="pricing_per_km_business" type="number" step="0.01"
                                        class="mt-1 block w-full"
                                        :value="old('pricing_per_km_business', \App\Models\Setting::get('pricing_per_km_business', 2.00))" />
                                    <x-input-error :messages="$errors->get('pricing_per_km_business')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="pricing_per_km_van" value="Van (€/km)" />
                                    <x-text-input id="pricing_per_km_van" name="pricing_per_km_van" type="number" step="0.01"
                                        class="mt-1 block w-full"
                                        :value="old('pricing_per_km_van', \App\Models\Setting::get('pricing_per_km_van', 2.50))" />
                                    <x-input-error :messages="$errors->get('pricing_per_km_van')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- Airport Surcharges --}}
                        <div class="md:col-span-2 lg:col-span-3">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Suppléments aéroport</h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <x-input-label for="pricing_airport_cdg" value="CDG (€)" />
                                    <x-text-input id="pricing_airport_cdg" name="pricing_airport_cdg" type="number" step="0.01"
                                        class="mt-1 block w-full"
                                        :value="old('pricing_airport_cdg', \App\Models\Setting::get('pricing_airport_cdg', 15.00))" />
                                    <x-input-error :messages="$errors->get('pricing_airport_cdg')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="pricing_airport_ory" value="ORY (€)" />
                                    <x-text-input id="pricing_airport_ory" name="pricing_airport_ory" type="number" step="0.01"
                                        class="mt-1 block w-full"
                                        :value="old('pricing_airport_ory', \App\Models\Setting::get('pricing_airport_ory', 12.00))" />
                                    <x-input-error :messages="$errors->get('pricing_airport_ory')" class="mt-2" />
                                </div>
                                <div>
                                    <x-input-label for="pricing_airport_bva" value="BVA (€)" />
                                    <x-text-input id="pricing_airport_bva" name="pricing_airport_bva" type="number" step="0.01"
                                        class="mt-1 block w-full"
                                        :value="old('pricing_airport_bva', \App\Models\Setting::get('pricing_airport_bva', 20.00))" />
                                    <x-input-error :messages="$errors->get('pricing_airport_bva')" class="mt-2" />
                                </div>
                            </div>
                        </div>

                        {{-- Minimum Fare --}}
                        <div>
                            <x-input-label for="pricing_minimum_fare" value="Tarif minimum (€)" />
                            <x-text-input id="pricing_minimum_fare" name="pricing_minimum_fare" type="number" step="0.01"
                                class="mt-1 block w-full"
                                :value="old('pricing_minimum_fare', \App\Models\Setting::get('pricing_minimum_fare', 45.00))" />
                            <x-input-error :messages="$errors->get('pricing_minimum_fare')" class="mt-2" />
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <x-button href="{{ route('admin.dashboard') }}" variant="outline">
                        ← Retour au tableau de bord
                    </x-button>

                    <x-primary-button>
                        Enregistrer les modifications
                    </x-primary-button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
