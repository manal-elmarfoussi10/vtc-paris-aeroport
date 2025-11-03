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

               
            </div>
        </div>
    </div>
</div>
@endsection
