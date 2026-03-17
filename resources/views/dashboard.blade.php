<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 tracking-tight font-serif">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
            <div class="bg-green-50 border-l-4 border-green-400 p-4 rounded-r-md shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700 font-medium">
                            {{ session('success') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    @if (session('error'))
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8">
            <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-r-md shadow-sm">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-red-700 font-medium">
                            {{ session('error') }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 text-gray-900 border-b border-gray-100">
                    <h3 class="text-lg font-medium">Bienvenue, {{ Auth::user()->name }}</h3>
                    <p class="mt-1 text-sm text-gray-500">Voici un résumé de vos articles publiés ou en brouillon.</p>
                </div>
            </div>

            <!-- Articles List -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-gray-900">Vos articles</h3>
                    <a href="{{ route('articles.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        Nouvel article
                    </a>
                </div>

                @if($articles->count() > 0)
                    <div class="divide-y divide-gray-100">
                        @foreach ($articles as $article)
                            <div class="p-6 flex flex-col sm:flex-row sm:items-center sm:justify-between hover:bg-gray-50/50 transition-colors">
                                <div class="flex-1 min-w-0 pr-4">
                                    <div class="flex items-center gap-3 mb-1">
                                        <h4 class="text-xl font-bold text-gray-900 truncate">
                                            <a href="{{ route('public.show', [$article->user_id, $article->id]) }}" class="hover:text-indigo-600 transition-colors">{{ $article->title }}</a>
                                        </h4>
                                        @if($article->draft)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                                Brouillon
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Publié
                                            </span>
                                        @endif
                                    </div>
                                    <p class="text-sm text-gray-500 mb-2 truncate">{{ Str::limit($article->content, 120) }}</p>
                                    <div class="flex items-center gap-4 text-xs text-gray-400">
                                        <span>Modifié le {{ $article->updated_at->format('d/m/Y') }}</span>
                                        <span>&bull;</span>
                                        <span class="flex items-center gap-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 text-rose-500" viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                            </svg>
                                            {{ $article->likes }}
                                        </span>
                                    </div>
                                </div>
                                <div class="mt-4 sm:mt-0 flex shrink-0 items-center gap-3">
                                    <a href="{{ route('articles.edit', $article->id) }}" class="inline-flex items-center px-3 py-1 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                                        Modifier
                                    </a>
                                    <form action="{{ route('articles.remove', $article->id) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="inline-flex items-center px-3 py-1 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition-colors">
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="p-12 text-center text-gray-500">
                        <p class="mb-4">Vous n'avez pas encore d'article.</p>
                        <a href="{{ route('articles.create') }}" class="text-indigo-600 hover:text-indigo-800 font-medium transition-colors">Écrivez votre premier article &rarr;</a>
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
