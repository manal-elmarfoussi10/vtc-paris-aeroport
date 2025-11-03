{{-- File: resources/views/layouts/footer.blade.php --}}
<footer class="bg-gradient-to-br from-slate-900 via-blue-900 to-slate-800 text-white relative overflow-hidden">
    {{-- Background Pattern --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0" style="background-image: radial-gradient(circle at 25% 25%, rgba(255,255,255,0.1) 0%, transparent 50%), radial-gradient(circle at 75% 75%, rgba(255,255,255,0.1) 0%, transparent 50%);"></div>
    </div>

    <div class="relative max-w-7xl mx-auto py-16 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">

            {{-- Company Info --}}
            <div class="lg:col-span-5">
                <p class="text-blue-100 mb-6 max-w-md leading-relaxed">
                    Service VTC premium à Paris et vers les aéroports. Chauffeurs professionnels, tarifs fixes garantis, et service sur mesure 24h/24.
                </p>

                {{-- Contact Info --}}
                <div class="space-y-3 mb-6 text-blue-100">
                    <p><strong>Téléphone:</strong> +33 1 23 45 67 89</p>
                    <p><strong>Email:</strong> contact@vtc-paris-aeroport.fr</p>
                    <p><strong>Adresse:</strong> Paris, France</p>
                </div>

              
            </div>

            {{-- Quick Links --}}
            <div class="lg:col-span-2">
                <h3 class="text-xl font-bold mb-6 text-white">Navigation</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('home') }}" class="text-blue-100 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Accueil</a></li>
                    <li><a href="{{ route('booking') }}" class="text-blue-100 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Réserver</a></li>
                    <li><a href="{{ route('services.index') }}" class="text-blue-100 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Services</a></li>
                    <li><a href="{{ route('airports.index') }}" class="text-blue-100 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Aéroports</a></li>
                    <li><a href="{{ route('faq') }}" class="text-blue-100 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">FAQ</a></li>
                    <li><a href="{{ route('contact') }}" class="text-blue-100 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">Contact</a></li>
                </ul>
            </div>

            {{-- Services --}}
            <div class="lg:col-span-2">
                <h3 class="text-xl font-bold mb-6 text-white">Services</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('airports.show', 'cdg') }}" class="text-blue-100 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">CDG Charles de Gaulle</a></li>
                    <li><a href="{{ route('airports.show', 'ory') }}" class="text-blue-100 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">ORY Orly</a></li>
                    <li><a href="{{ route('airports.show', 'bva') }}" class="text-blue-100 hover:text-white transition-all duration-300 hover:translate-x-2 inline-block">BVA Beauvais</a></li>
                    <li><span class="text-blue-100">Transfert aéroport</span></li>
                    <li><span class="text-blue-100">Mise à disposition</span></li>
                    <li><span class="text-blue-100">Événements</span></li>
                </ul>
            </div>

            {{-- Newsletter --}}
            <div class="lg:col-span-3">
             

                {{-- Trust Badges --}}
                <div class="mt-6 flex flex-wrap gap-3">
                    <div class="bg-white/10 backdrop-blur-sm rounded-lg px-3 py-2 text-xs font-medium text-blue-100">
                        ⭐ 4.8/5 Avis
                    </div>
                </div>
<br><br>
                  {{-- Social Links --}}
                  <div class="flex space-x-4">
                    <a href="#" class="bg-white/20 hover:bg-white/30 p-3 rounded-full transition-all duration-300 hover:scale-110">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg>
                    </a>
                    <a href="#" class="bg-white/20 hover:bg-white/30 p-3 rounded-full transition-all duration-300 hover:scale-110">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22.46 6c-.77.35-1.6.58-2.46.69.88-.53 1.56-1.37 1.88-2.38-.83.5-1.75.85-2.72 1.05C18.37 4.5 17.26 4 16 4c-2.35 0-4.27 1.92-4.27 4.29 0 .34.04.67.11.98C8.28 9.09 5.11 7.38 3 4.79c-.37.63-.58 1.37-.58 2.15 0 1.49.75 2.81 1.91 3.56-.71 0-1.37-.2-1.95-.5v.03c0 2.08 1.48 3.82 3.44 4.21a4.22 4.22 0 0 1-1.93.07 4.28 4.28 0 0 0 4 2.98 8.521 8.521 0 0 1-5.33 1.84c-.34 0-.68-.02-1.02-.06C3.44 20.29 5.7 21 8.12 21 16 21 20.33 14.46 20.33 8.79c0-.19 0-.37-.01-.56.84-.6 1.56-1.36 2.14-2.23z"/></svg>
                    </a>
                    <a href="#" class="bg-white/20 hover:bg-white/30 p-3 rounded-full transition-all duration-300 hover:scale-110">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- Copyright Bar --}}
    <div class="bg-slate-900 border-t border-slate-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex flex-col md:flex-row justify-between items-center text-sm">
                <div class="text-slate-400 mb-2 md:mb-0">
                    © {{ date('Y') }} VTC Paris Aéroport. Tous droits réservés.
                </div>
                <div class="flex flex-wrap justify-center md:justify-end space-x-6 text-slate-400">
                    <a href="#" class="hover:text-white transition duration-200">Politique de confidentialité</a>
                    <a href="#" class="hover:text-white transition duration-200">Conditions générales</a>
                    <a href="#" class="hover:text-white transition duration-200">Mentions légales</a>
                    <span class="text-slate-500">|</span>
                    <a href="https://marfoussiwebart.com/" target="_blank" class="text-blue-400 hover:text-blue-300 transition duration-200 font-medium">
                        Website by Marfoussi Web Art
                    </a>
                </div>
            </div>
        </div>
    </div>
</footer>
