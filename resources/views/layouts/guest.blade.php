<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|playfair-display:700,800&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased bg-gray-50 flex flex-col min-h-screen">
        
        <!-- Navigation Header -->
        <header class="bg-white shadow-sm sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-16 items-center">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                            <x-application-logo class="w-8 h-8 fill-current text-indigo-600 group-hover:text-indigo-700 transition-colors" />
                            <span class="font-bold text-xl tracking-tight text-gray-900 font-serif">MonBlog</span>
                        </a>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        <a href="{{ route('home') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600 transition-colors hidden sm:block">Accueil</a>
                        
                        @auth
                            <a href="{{ route('dashboard') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600 transition-colors">Mon Compte</a>
                            @if(Route::has('articles.create'))
                                <a href="{{ route('articles.create') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-800 transition-colors">Écrire un article</a>
                            @endif
                        @else
                            <a href="{{ route('login') }}" class="text-sm font-medium text-gray-700 hover:text-indigo-600 transition-colors">Connexion</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="text-sm font-medium bg-indigo-600 text-white px-4 py-2 rounded-full hover:bg-indigo-700 transition-colors shadow-sm hidden sm:block">S'inscrire</a>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="flex-grow w-full max-w-7xl mx-auto sm:px-6 lg:px-8 px-4 relative">
            {{ $slot }}
        </main>
        
        <!-- Footer -->
        <footer class="bg-white border-t border-gray-100 mt-12 py-10">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <p class="text-gray-500 text-sm">
                    &copy; {{ date('Y') }} MonBlog - Tous droits réservés.
                </p>
                <p class="text-gray-400 text-xs mt-2">
                    Créé avec Laravel et Tailwind CSS.
                </p>
            </div>
        </footer>
    </body>
</html>
