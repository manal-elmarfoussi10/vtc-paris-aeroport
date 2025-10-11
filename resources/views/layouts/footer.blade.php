{{--
    File: resources/views/layouts/footer.blade.php
    Description: Global footer for the VTC Paris Aéroport application.
--}}
<footer class="bg-dark-navy mt-16 border-t border-gray-700">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        
        <div class="grid grid-cols-2 gap-8 xl:grid-cols-4">
            
            {{-- Logo & Info --}}
            <div class="space-y-4 col-span-2 xl:col-span-1">
                {{-- Use application-logo component here --}}
                @include('components.application-logo', ['is_dark' => true])
                <p class="text-sm text-gray-400">
                    Votre partenaire de confiance pour tous vos transferts VTC à Paris.
                    <br>Transferts aéroports CDG, Orly, Beauvais.
                </p>
            </div>

            {{-- Navigation Links --}}
            <div>
                <h3 class="text-lg font-semibold text-white tracking-wider uppercase">
                    Navigation
                </h3>
                <ul role="list" class="mt-4 space-y-2">
                    <li><a href="{{ route('booking') }}" class="text-base text-gray-400 hover:text-white transition duration-150">Réserver un VTC</a></li>
                    <li><a href="{{ route('services') }}" class="text-base text-gray-400 hover:text-white transition duration-150">Nos Services</a></li>
                    <li><a href="{{ route('airports') }}" class="text-base text-gray-400 hover:text-white transition duration-150">Tarifs Aéroports</a></li>
                    <li><a href="{{ route('faq') }}" class="text-base text-gray-400 hover:text-white transition duration-150">FAQ</a></li>
                </ul>
            </div>

            {{-- Légal & Contact --}}
            <div>
                <h3 class="text-lg font-semibold text-white tracking-wider uppercase">
                    Support
                </h3>
                <ul role="list" class="mt-4 space-y-2">
                    <li><a href="{{ route('contact') }}" class="text-base text-gray-400 hover:text-white transition duration-150">Contactez-nous</a></li>
                    <li><a href="#" class="text-base text-gray-400 hover:text-white transition duration-150">Mentions Légales</a></li>
                    <li><a href="#" class="text-base text-gray-400 hover:text-white transition duration-150">Conditions Générales</a></li>
                    <li><a href="{{ route('login') }}" class="text-base text-gray-400 hover:text-white transition duration-150">Accès Client</a></li>
                </ul>
            </div>
        </div>

        <div class="mt-12 border-t border-gray-700 pt-8 flex flex-col sm:flex-row justify-between items-center">
            <p class="text-base text-gray-500">
                &copy; {{ date('Y') }} VTC Paris Aéroport. Tous droits réservés.
            </p>
        </div>
    </div>
</footer>