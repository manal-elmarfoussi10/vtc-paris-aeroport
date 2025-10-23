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
                        {{-- Company Phone --}}
                        <div>
                            <x-input-label for="company_phone" value="Téléphone société *" />
                            <x-text-input id="company_phone" name="company_phone" type="tel"
                                class="mt-1 block w-full"
                                :value="old('company_phone', setting('company_phone', '+33 1 23 45 67 89'))"
                                placeholder="+33 1 23 45 67 89" required />
                            <x-input-error :messages="$errors->get('company_phone')" class="mt-2" />
                        </div>

                        {{-- Company Email --}}
                        <div>
                            <x-input-label for="company_email" value="E-mail société *" />
                            <x-text-input id="company_email" name="company_email" type="email"
                                class="mt-1 block w-full"
                                :value="old('company_email', setting('company_email', 'contact@vtc-paris-aeroport.fr'))"
                                required />
                            <x-input-error :messages="$errors->get('company_email')" class="mt-2" />
                        </div>

                        {{-- WhatsApp --}}
                        <div>
                            <x-input-label for="whatsapp" value="WhatsApp (optionnel)" />
                            <x-text-input id="whatsapp" name="whatsapp" type="tel"
                                class="mt-1 block w-full"
                                :value="old('whatsapp', setting('whatsapp'))"
                                placeholder="33123456789" />
                            <x-input-error :messages="$errors->get('whatsapp')" class="mt-2" />
                            <p class="mt-1 text-sm text-gray-600">Numéro sans espaces ni + (ex: 33123456789)</p>
                        </div>

                        {{-- Company Address --}}
                        <div>
                            <x-input-label for="company_address" value="Adresse société" />
                            <x-text-input id="company_address" name="company_address" type="text"
                                class="mt-1 block w-full"
                                :value="old('company_address', setting('company_address', 'Paris, France'))" />
                            <x-input-error :messages="$errors->get('company_address')" class="mt-2" />
                        </div>
                    </div>
                </div>

                {{-- Airport Rules --}}
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Règles aéroport</h2>

                    <div class="space-y-6">
                        {{-- CDG Rules --}}
                        <div>
                            <label for="cdg_rules" class="block text-sm font-medium text-gray-700 mb-2">
                                Règles Charles de Gaulle (CDG)
                            </label>
                            <textarea id="cdg_rules" name="cdg_rules" rows="4"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                placeholder="Temps d'attente, zones de prise en charge, etc.">{{ old('cdg_rules', setting('cdg_rules', 'Temps d\'attente gratuit: 45 minutes\nZone de prise en charge: Niveau Arrivées\nDocuments requis: Carte d\'identité')) }}</textarea>
                            <x-input-error :messages="$errors->get('cdg_rules')" class="mt-2" />
                        </div>

                        {{-- ORY Rules --}}
                        <div>
                            <label for="ory_rules" class="block text-sm font-medium text-gray-700 mb-2">
                                Règles Orly (ORY)
                            </label>
                            <textarea id="ory_rules" name="ory_rules" rows="4"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                placeholder="Temps d'attente, zones de prise en charge, etc.">{{ old('ory_rules', setting('ory_rules', 'Temps d\'attente gratuit: 30 minutes\nZone de prise en charge: Porte 1\nDocuments requis: Carte d\'identité')) }}</textarea>
                            <x-input-error :messages="$errors->get('ory_rules')" class="mt-2" />
                        </div>

                        {{-- BVA Rules --}}
                        <div>
                            <label for="bva_rules" class="block text-sm font-medium text-gray-700 mb-2">
                                Règles Beauvais (BVA)
                            </label>
                            <textarea id="bva_rules" name="bva_rules" rows="4"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                placeholder="Temps d'attente, zones de prise en charge, etc.">{{ old('bva_rules', setting('bva_rules', 'Temps d\'attente gratuit: 60 minutes\nZone de prise en charge: Arrivées\nDocuments requis: Carte d\'identité')) }}</textarea>
                            <x-input-error :messages="$errors->get('bva_rules')" class="mt-2" />
                        </div>
                    </div>
                </div>

                {{-- Pricing Rules --}}
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Règles de tarification</h2>

                    <div>
                        <label for="pricing_rules" class="block text-sm font-medium text-gray-700 mb-2">
                            Règles générales de tarification
                        </label>
                        <textarea id="pricing_rules" name="pricing_rules" rows="6"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            placeholder="Tarifs de base, suppléments, conditions...">{{ old('pricing_rules', setting('pricing_rules', 'Tarif de base Paris aéroports: 65€ (Sedan), 85€ (Business), 120€ (Van)
Supplément nocturne (22h-6h): +20€
Supplément week-end: +15€
Siège enfant: +15€
Accueil personnalisé: +10€')) }}</textarea>
                        <x-input-error :messages="$errors->get('pricing_rules')" class="mt-2" />
                    </div>
                </div>

                {{-- Site Texts --}}
                <div class="mb-8">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Textes du site</h2>

                    <div class="space-y-6">
                        {{-- Hero Title --}}
                        <div>
                            <label for="hero_title" class="block text-sm font-medium text-gray-700 mb-2">
                                Titre hero page d'accueil
                            </label>
                            <x-text-input id="hero_title" name="hero_title" type="text"
                                class="mt-1 block w-full"
                                :value="old('hero_title', setting('hero_title', 'Service VTC Premium à Paris'))" />
                            <x-input-error :messages="$errors->get('hero_title')" class="mt-2" />
                        </div>

                        {{-- Hero Subtitle --}}
                        <div>
                            <label for="hero_subtitle" class="block text-sm font-medium text-gray-700 mb-2">
                                Sous-titre hero
                            </label>
                            <textarea id="hero_subtitle" name="hero_subtitle" rows="3"
                                class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                                placeholder="Description sous le titre principal">{{ old('hero_subtitle', setting('hero_subtitle', 'Transferts CDG, Orly, Beauvais sans surprise. L\'élégance, la ponctualité, et le professionnalisme.')) }}</textarea>
                            <x-input-error :messages="$errors->get('hero_subtitle')" class="mt-2" />
                        </div>
                    </div>
                </div>

                {{-- Submit --}}
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <x-button href="{{ route('admin.dashboard') }}" variant="outline">
                        ← Retour au tableau de bord
                    </x-button>

                    <div class="flex space-x-4">
                        <form method="POST" action="{{ route('admin.settings.reset') }}" class="inline">
                            @csrf
                            <button type="submit" onclick="return confirm('Êtes-vous sûr de vouloir réinitialiser tous les paramètres ?')" class="px-4 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700 transition duration-200">
                                Réinitialiser
                            </button>
                        </form>

                        <x-primary-button>
                            Enregistrer les modifications
                        </x-primary-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
