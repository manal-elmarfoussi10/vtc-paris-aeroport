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

        {{-- ⚠️ IMPORTANT: Removing @vite and adding Tailwind CDN as per project constraints --}}
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            // Re-configure Tailwind for project colors (must match home/index.blade.php @once block)
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            'blue-primary': '#1D4ED8', // Primary Blue
                            'dark-navy': '#0F172A', // Dark Navy
                            'light-grey': '#F8FAFC', // Light Grey
                        }
                    }
                }
            }
        </script>
    </head>
    
    <body class="font-sans antialiased bg-light-grey">
        <div class="min-h-screen">
            
            {{-- Navigation (Fixed Top, includes logo) --}}
            @include('layouts.navigation')

            {{-- Page Heading (Moved down to account for fixed header height) --}}
            @isset($header)
                <header class="bg-white shadow pt-20"> {{-- Added pt-20 for fixed nav spacing --}}
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <main class="flex-grow pt-20 sm:pt-24"> {{-- Added pt-20/pt-24 for fixed nav spacing --}}
                {{-- FIX APPLIED: Replaced $slot with @yield('content') for traditional Blade sections --}}
                @yield('content')
            </main>
            
            {{-- Global Footer --}}
            @include('layouts.footer')
            
        </div>
    </body>
</html>