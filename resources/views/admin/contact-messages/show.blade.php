@extends('layouts.admin')

@section('title', 'Message de contact: ' . $contactMessage->subject)

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            {{-- Header --}}
            <div class="p-6 lg:p-8 bg-white border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <div>
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            Message de contact
                        </h2>
                        <p class="mt-1 text-sm text-gray-600">
                            Reçu le {{ $contactMessage->created_at->format('d/m/Y à H:i') }}
                        </p>
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('admin.contact-messages.index') }}"
                           class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                            Retour à la liste
                        </a>
                        <form method="POST" action="{{ route('admin.contact-messages.destroy', $contactMessage) }}"
                              class="inline"
                              onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce message ?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Message Content --}}
            <div class="p-6 lg:p-8">

                {{-- Sender Info --}}
                <div class="mb-8">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informations de l'expéditeur</h3>
                    <div class="bg-gray-50 rounded-lg p-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <strong class="text-sm font-medium text-gray-700">Nom:</strong>
                            <p class="text-sm text-gray-900 mt-1">{{ $contactMessage->name }}</p>
                        </div>
                        <div>
                            <strong class="text-sm font-medium text-gray-700">Email:</strong>
                            <p class="text-sm text-gray-900 mt-1">
                                <a href="mailto:{{ $contactMessage->email }}" class="text-blue-600 hover:text-blue-800">
                                    {{ $contactMessage->email }}
                                </a>
                            </p>
                        </div>
                        @if($contactMessage->phone)
                            <div>
                                <strong class="text-sm font-medium text-gray-700">Téléphone:</strong>
                                <p class="text-sm text-gray-900 mt-1">
                                    <a href="tel:{{ $contactMessage->phone }}" class="text-blue-600 hover:text-blue-800">
                                        {{ $contactMessage->phone }}
                                    </a>
                                </p>
                            </div>
                        @endif
                        <div>
                            <strong class="text-sm font-medium text-gray-700">Sujet:</strong>
                            <p class="text-sm text-gray-900 mt-1">{{ $contactMessage->subject }}</p>
                        </div>
                    </div>
                </div>

                {{-- Message --}}
                <div>
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Message</h3>
                    <div class="bg-gray-50 rounded-lg p-4">
                        <p class="text-gray-900 whitespace-pre-wrap">{{ $contactMessage->message }}</p>
                    </div>
                </div>

                {{-- Quick Actions --}}
                <div class="mt-8 flex flex-col sm:flex-row gap-4">
                    <a href="mailto:{{ $contactMessage->email }}?subject=Re: {{ $contactMessage->subject }}"
                       class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Répondre par email
                    </a>
                    @if($contactMessage->phone)
                        <a href="tel:{{ $contactMessage->phone }}"
                           class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                            </svg>
                            Appeler
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
