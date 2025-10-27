{{-- File: resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', 'VTC Paris Aéroport - Chauffeur Privé')</title>
        <meta name="description" content="@yield('description', 'Service VTC premium à Paris et vers les aéroports. Chauffeurs professionnels, tarifs fixes garantis, et service sur mesure 24h/24.')">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            // Custom color palette matching the requested aesthetic
                            'blue-primary': '#1D4ED8', // Tailwind blue-700 equivalent for branding
                            'dark-navy': '#0F172A',   // Tailwind slate-900 equivalent for background
                            'light-grey': '#F8FAFC',  // Tailwind gray-50 equivalent for light sections
                        },
                        // Custom animation for a single pulse effect on the CTA button
                        animation: {
                            'pulse-once': 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) 1',
                        }
                    }
                }
            }
        </script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-50 flex flex-col">

            @hasSection('navigation')
                @yield('navigation')
            @else
                @include('layouts.navigation')
            @endif

            @hasSection('header')
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        @yield('header')
                    </div>
                </header>
            @endif

            <main class="flex-grow"> 
                @yield('content')
            </main>
            
            @include('layouts.footer')
            
        </div>
    </body>
</html>