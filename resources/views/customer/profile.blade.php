@extends('layouts.app')

@section('title', 'Mon profil - VTC Paris Aéroport')
@section('description', 'Modifiez vos informations personnelles et préférences de compte.')

@section('content')
<div class="min-h-screen bg-light-grey py-12">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Mon profil</h1>
            <p class="mt-2 text-gray-600">Modifiez vos informations personnelles</p>
        </div>

        {{-- Profile Form --}}
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <form method="POST" action="{{ route('customer.profile.update') }}" class="p-8">
                @csrf
                @method('PUT')

                {{-- Session Status --}}
                <x-auth-session-status class="mb-4" :status="session('status')" />

                {{-- Name --}}
                <div class="mb-6">
                    <x-input-label for="name" value="Nom complet *" />
                    <x-text-input id="name" name="name" type="text"
                        class="mt-1 block w-full"
                        :value="old('name', auth()->user()->name)"
                        required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                {{-- Email --}}
                <div class="mb-6">
                    <x-input-label for="email" value="Adresse e-mail *" />
                    <x-text-input id="email" name="email" type="email"
                        class="mt-1 block w-full"
                        :value="old('email', auth()->user()->email)"
                        required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    <p class="mt-1 text-sm text-gray-600">Votre e-mail doit être vérifié pour recevoir les confirmations de réservation.</p>
                </div>

                {{-- Phone --}}
                <div class="mb-6">
                    <x-input-label for="phone" value="Téléphone" />
                    <x-text-input id="phone" name="phone" type="tel"
                        class="mt-1 block w-full"
                        :value="old('phone', auth()->user()->phone)"
                        placeholder="+33 6 XX XX XX XX" />
                    <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    <p class="mt-1 text-sm text-gray-600">Utilisé pour les confirmations de dernière minute.</p>
                </div>

                {{-- Current Password (for verification) --}}
                <div class="mb-6 pt-6 border-t border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Sécurité</h3>

                    <div class="mb-4">
                        <x-input-label for="current_password" value="Mot de passe actuel *" />
                        <x-text-input id="current_password" name="current_password" type="password"
                            class="mt-1 block w-full"
                            autocomplete="current-password" />
                        <x-input-error :messages="$errors->get('current_password')" class="mt-2" />
                        <p class="mt-1 text-sm text-gray-600">Requis pour confirmer les modifications.</p>
                    </div>

                    {{-- New Password --}}
                    <div class="mb-4">
                        <x-input-label for="password" value="Nouveau mot de passe" />
                        <x-text-input id="password" name="password" type="password"
                            class="mt-1 block w-full"
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        <p class="mt-1 text-sm text-gray-600">Laissez vide si vous ne souhaitez pas changer.</p>
                    </div>

                    {{-- Confirm New Password --}}
                    <div class="mb-4">
                        <x-input-label for="password_confirmation" value="Confirmer le nouveau mot de passe" />
                        <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                            class="mt-1 block w-full"
                            autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                {{-- Submit --}}
                <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                    <x-button href="{{ route('customer.dashboard') }}" variant="outline">
                        ← Retour au tableau de bord
                    </x-button>

                    <x-primary-button>
                        Enregistrer les modifications
                    </x-primary-button>
                </div>
            </form>
        </div>

        {{-- Account Info --}}
        <div class="mt-8 bg-white rounded-lg shadow p-6">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Informations du compte</h3>
            <dl class="space-y-3">
                <div class="flex justify-between">
                    <dt class="text-sm font-medium text-gray-500">Membre depuis</dt>
                    <dd class="text-sm text-gray-900">{{ auth()->user()->created_at->format('d/m/Y') }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-sm font-medium text-gray-500">Statut e-mail</dt>
                    <dd class="text-sm text-gray-900">
                        @if(auth()->user()->email_verified_at)
                            <span class="text-green-600">✓ Vérifié</span>
                        @else
                            <span class="text-red-600">✗ Non vérifié</span>
                            <form method="POST" action="{{ route('verification.send') }}" class="inline ml-2">
                                @csrf
                                <button type="submit" class="text-sm text-blue-600 hover:text-blue-500">
                                    Renvoyer l'e-mail
                                </button>
                            </form>
                        @endif
                    </dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-sm font-medium text-gray-500">Réservations totales</dt>
                    <dd class="text-sm text-gray-900">{{ auth()->user()->customer->total_bookings ?? 0 }}</dd>
                </div>
            </dl>
        </div>

        {{-- Danger Zone --}}
        <div class="mt-8 bg-red-50 border border-red-200 rounded-lg p-6">
            <h3 class="text-lg font-medium text-red-900 mb-4">Zone de danger</h3>
            <p class="text-sm text-red-700 mb-4">
                Supprimer votre compte est définitif et entraînera la suppression de toutes vos données et réservations.
            </p>
            <button type="button"
                    onclick="if(confirm('Êtes-vous sûr de vouloir supprimer votre compte ? Cette action est irréversible.')) { document.getElementById('delete-form').submit(); }"
                    class="px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition duration-200 text-sm">
                Supprimer mon compte
            </button>

            <form id="delete-form" method="POST" action="{{ route('profile.destroy') }}" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</div>
@endsection
