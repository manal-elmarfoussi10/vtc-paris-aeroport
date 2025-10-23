{{-- File: resources/views/layouts/footer.blade.php --}}
<footer class="bg-dark-navy text-white">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            {{-- Company Info --}}
            <div class="col-span-1 md:col-span-2">
                <x-application-logo class="h-8 w-auto mb-4" />
                <p class="text-gray-300 mb-4 max-w-md">
                    Service VTC premium à Paris et vers les aéroports. Chauffeurs professionnels, tarifs fixes garantis, et service sur mesure 24h/24.
                </p>
                <div class="space-y-2 text-sm text-gray-400">
                    <p>📞 {{ setting('company_phone', '+33 1 23 45 67 89') }}</p>
                    <p>✉️ {{ setting('company_email', 'contact@vtc-paris-aeroport.fr') }}</p>
                    <p>📍 {{ setting('company_address', 'Paris, France') }}</p>
                </div>
            </div>

            {{-- Quick Links --}}
            <div>
                <h3 class="text-lg font-semibold mb-4">Navigation</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition duration-200">Accueil</a></li>
                    <li><a href="{{ route('booking') }}" class="text-gray-300 hover:text-white transition duration-200">Réserver</a></li>
                    <li><a href="{{ route('services.index') }}" class="text-gray-300 hover:text-white transition duration-200">Services</a></li>
                    <li><a href="{{ route('airports.index') }}" class="text-gray-300 hover:text-white transition duration-200">Aéroports</a></li>
                    <li><a href="{{ route('faq') }}" class="text-gray-300 hover:text-white transition duration-200">FAQ</a></li>
                    <li><a href="{{ route('contact') }}" class="text-gray-300 hover:text-white transition duration-200">Contact</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div>
                <h3 class="text-lg font-semibold mb-4">Services</h3>
                <ul class="space-y-2">
                    <li><a href="{{ route('airports.show', 'cdg') }}" class="text-gray-300 hover:text-white transition duration-200">CDG Charles de Gaulle</a></li>
                    <li><a href="{{ route('airports.show', 'ory') }}" class="text-gray-300 hover:text-white transition duration-200">ORY Orly</a></li>
                    <li><a href="{{ route('airports.show', 'bva') }}" class="text-gray-300 hover:text-white transition duration-200">BVA Beauvais</a></li>
                    <li><span class="text-gray-300">Transfert aéroport</span></li>
                    <li><span class="text-gray-300">Mise à disposition</span></li>
                    <li><span class="text-gray-300">Événements</span></li>
                </ul>
            </div>
        </div>

        {{-- Bottom Bar --}}
        <div class="mt-8 pt-8 border-t border-gray-700">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-sm text-gray-400 mb-4 md:mb-0">
                    © {{ date('Y') }} VTC Paris Aéroport. Tous droits réservés.
                </div>

                <div class="flex space-x-6 text-sm">
                    <a href="#" class="text-gray-400 hover:text-white transition duration-200">Politique de confidentialité</a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-200">Conditions générales</a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-200">Mentions légales</a>
                </div>
            </div>
        </div>
    </div>
</footer>
