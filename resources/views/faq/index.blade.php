@extends('layouts.app')

@section('title', 'FAQ - Questions fréquentes VTC Paris Aéroport')
@section('description', 'Réponses aux questions les plus fréquentes sur nos services VTC, réservations, tarifs, et transferts aéroports.')

@section('content')
<div class="min-h-screen bg-light-grey py-12">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-900 mb-4">Questions fréquentes</h1>
            <p class="text-xl text-gray-600">
                Trouvez rapidement les réponses à vos questions sur nos services de transport privé.
            </p>
        </div>

        {{-- FAQ Accordion --}}
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-8">
            <div class="divide-y divide-gray-200">
                @foreach($faqs as $index => $faq)
                    <div class="faq-item" x-data="{ open: false }">
                        <button @click="open = !open"
                                class="w-full px-6 py-4 text-left flex justify-between items-center hover:bg-gray-50 focus:outline-none focus:bg-gray-50">
                            <span class="text-lg font-medium text-gray-900">{{ $faq['question'] }}</span>
                            <svg class="h-5 w-5 text-gray-500 transform transition-transform duration-200"
                                 :class="{ 'rotate-180': open }"
                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div x-show="open"
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 max-h-0"
                             x-transition:enter-end="opacity-100 max-h-screen"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 max-h-screen"
                             x-transition:leave-end="opacity-0 max-h-0"
                             class="overflow-hidden">
                            <div class="px-6 pb-4">
                                <p class="text-gray-600 leading-relaxed">{{ $faq['answer'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Contact CTA --}}
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-8 text-center">
            <h2 class="text-2xl font-bold text-blue-900 mb-4">Vous n'avez pas trouvé votre réponse ?</h2>
            <p class="text-blue-700 mb-6">
                Notre équipe est là pour vous aider. Contactez-nous directement pour toute question supplémentaire.
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <x-button href="{{ route('contact') }}" variant="primary">
                    Nous contacter
                </x-button>
                <x-button href="tel:{{ setting('company_phone', '+33123456789') }}" variant="outline">
                    📞 {{ setting('company_phone', '+33 1 23 45 67 89') }}
                </x-button>
            </div>
        </div>
    </div>
</div>

<script>
// Auto-open first FAQ item
document.addEventListener('DOMContentLoaded', function() {
    const firstFaq = document.querySelector('.faq-item');
    if (firstFaq && firstFaq.__x) {
        firstFaq.__x.$data.open = true;
    }
});
</script>
@endsection
