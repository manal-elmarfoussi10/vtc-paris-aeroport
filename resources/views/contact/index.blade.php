@extends('layouts.app')

@section('title', 'Contact - VTC Paris Aéroport')
@section('description', 'Contactez notre service client VTC. Réservations, questions, support 24h/24. Réponse sous 2h.')

@section('content')
<div class="min-h-screen bg-light-grey py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Contactez-nous</h1>
            <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                Notre équipe est à votre disposition 24h/24 pour répondre à vos questions et vous accompagner dans vos réservations.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

            {{-- Contact Form --}}
            <div class="bg-white rounded-lg shadow-lg p-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Envoyez-nous un message</h2>

                <form method="POST" action="{{ route('contact.send') }}" class="space-y-6">
                    @csrf

                    {{-- Name --}}
                    <div>
                        <x-input-label for="name" value="Nom complet *" />
                        <x-text-input id="name" name="name" type="text"
                            class="mt-1 block w-full"
                            :value="old('name')"
                            required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    {{-- Email --}}
                    <div>
                        <x-input-label for="email" value="Adresse e-mail *" />
                        <x-text-input id="email" name="email" type="email"
                            class="mt-1 block w-full"
                            :value="old('email')"
                            required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    {{-- Phone --}}
                    <div>
                        <x-input-label for="phone" value="Téléphone" />
                        <x-text-input id="phone" name="phone" type="tel"
                            class="mt-1 block w-full"
                            :value="old('phone')"
                            placeholder="+33 6 XX XX XX XX" />
                        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                    </div>

                    {{-- Subject --}}
                    <div>
                        <x-input-label for="subject" value="Sujet *" />
                        <x-select id="subject" name="subject" class="mt-1 block w-full" required>
                            <option value="">Sélectionner un sujet</option>
                            <option value="booking" {{ old('subject') == 'booking' ? 'selected' : '' }}>Réservation</option>
                            <option value="pricing" {{ old('subject') == 'pricing' ? 'selected' : '' }}>Tarifs et devis</option>
                            <option value="modification" {{ old('subject') == 'modification' ? 'selected' : '' }}>Modification de réservation</option>
                            <option value="complaint" {{ old('subject') == 'complaint' ? 'selected' : '' }}>Réclamation</option>
                            <option value="partnership" {{ old('subject') == 'partnership' ? 'selected' : '' }}>Partenariat</option>
                            <option value="other" {{ old('subject') == 'other' ? 'selected' : '' }}>Autre</option>
                        </x-select>
                        <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                    </div>

                    {{-- Message --}}
                    <div>
                        <x-input-label for="message" value="Message *" />
                        <textarea id="message" name="message" rows="6"
                            class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm"
                            placeholder="Décrivez votre demande en détail..."
                            required>{{ old('message') }}</textarea>
                        <x-input-error :messages="$errors->get('message')" class="mt-2" />
                    </div>

                    {{-- Submit --}}
                    <div class="flex justify-end">
                        <x-primary-button>
                            Envoyer le message
                        </x-primary-button>
                    </div>
                </form>
            </div>

            {{-- Contact Info --}}
            <div class="space-y-8">

                {{-- Quick Contact --}}
                <div class="bg-white rounded-lg shadow-lg p-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Contact rapide</h2>

                    <div class="space-y-4">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Téléphone</p>
                                <p class="text-sm text-gray-600">{{ setting('company_phone', '+33 1 23 45 67 89') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">E-mail</p>
                                <p class="text-sm text-gray-600">{{ setting('company_email', 'contact@vtc-paris-aeroport.fr') }}</p>
                            </div>
                        </div>

                        <div class="flex items-center">
                            <div class="flex-shrink-0 h-10 w-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="h-5 w-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium text-gray-900">Adresse</p>
                                <p class="text-sm text-gray-600">{{ setting('company_address', 'Paris, France') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Response Time --}}
                <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                    <div class="flex items-center mb-3">
                        <svg class="h-6 w-6 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <h3 class="text-lg font-medium text-green-900">Réponse garantie</h3>
                    </div>
                    <ul class="text-sm text-green-800 space-y-1">
                        <li>• Réponse téléphonique immédiate</li>
                        <li>• E-mail sous 2 heures</li>
                        <li>• Support 24h/24 et 7j/7</li>
                        <li>• Résolution sous 24h</li>
                    </ul>
                </div>

                {{-- WhatsApp --}}
                @if(setting('whatsapp'))
                    <div class="bg-green-500 rounded-lg p-6 text-center text-white">
                        <svg class="h-12 w-12 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                        </svg>
                        <h3 class="text-lg font-bold mb-2">WhatsApp</h3>
                        <p class="mb-4">Réponse instantanée</p>
                        <a href="https://wa.me/{{ setting('whatsapp') }}" target="_blank"
                           class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-full text-green-600 bg-white hover:bg-gray-50 transition duration-300">
                            Écrire sur WhatsApp
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
