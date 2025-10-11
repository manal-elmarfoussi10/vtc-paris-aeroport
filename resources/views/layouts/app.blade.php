<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        {{-- Custom Title and Description from the extending page --}}
        <title>@yield('title', config('app.name', 'VTC Paris Aéroport'))</title>
        <meta name="description" content="@yield('description', 'Réservez votre chauffeur privé VTC à Paris et vers les aéroports.')">
        
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        {{-- IMPORTANT: Using Tailwind CDN --}}
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'blue-primary': '#1D4ED8',
                            'dark-navy': '#0F172A',
                            'light-grey': '#F8FAFC',
                        },
                        // Add custom animation for a single pulse effect (optional)
                        animation: {
                            'pulse-once': 'pulse 2s cubic-bezier(0.4, 0, 0.6, 1) 1',
                        }
                    }
                }
            }
        </script>
    </head>
    
    <body class="font-sans antialiased bg-light-grey">
        <div class="min-h-screen flex flex-col"> {{-- Use flex-col to push footer to bottom --}}
            
            {{-- Navigation (Fixed Top) --}}
            @include('layouts.navigation')

            @isset($header)
                <header class="bg-white shadow pt-20">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset {{-- <-- FIX APPLIED: Closing the @isset block --}}

            <main class="flex-grow pt-20 sm:pt-24"> {{-- Added pt-20/pt-24 for fixed nav spacing --}}
                @yield('content')
            </main>
            
            @include('layouts.footer')
            
        </div>
    </body>
</html>