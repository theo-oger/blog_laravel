<x-guest-layout>
    <!-- Hero Section -->
    <div class="bg-indigo-700 rounded-2xl shadow-lg mb-12 overflow-hidden mt-6">
        <div class="px-6 py-12 md:py-20 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tight mb-4 text-white">
                Les meilleurs articles
            </h1>
            <p class="mt-4 max-w-2xl text-lg md:text-xl text-indigo-100 mx-auto">
                Explorez des récits passionnants, des astuces et des réflexions partagés par notre communauté.
            </p>
            <div class="mt-8 flex justify-center space-x-4">
                <a href="#articles" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-indigo-700 bg-white hover:bg-indigo-50 shadow-sm transition-colors">
                    Lire les articles
                </a>
                @guest
                <a href="{{ route('register') }}" class="inline-flex items-center justify-center px-6 py-3 border border-indigo-400 text-base font-medium rounded-md text-white hover:bg-indigo-600 transition-colors">
                    S'inscrire
                </a>
                @endguest
            </div>
        </div>
    </div>

    <!-- Articles Section -->
    <div id="articles" class="mb-16">
        <div class="text-center mb-10">
            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 tracking-tight">
                À la une
            </h2>
            <div class="w-16 h-1 bg-indigo-500 mx-auto mt-4 rounded"></div>
        </div>

        @if($articles->isEmpty())
            <div class="bg-white dark:bg-gray-800 rounded-xl p-12 text-center shadow-sm border border-gray-100 dark:border-gray-700">
                <p class="text-gray-600 dark:text-gray-400 text-lg">Aucun article n'a encore été publié.</p>
            </div>
        @else
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                @foreach ($articles as $article)
                    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden flex flex-col hover:shadow-md transition-shadow">
                        <div class="p-6 flex-1 flex flex-col">
                            <div class="flex items-center justify-between mb-4">
                                <span class="bg-rose-100 text-rose-700 text-xs font-bold px-3 py-1 rounded-full flex items-center">
                                    <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" /></svg>
                                    {{ $article->likes }}
                                </span>
                                <span class="text-sm text-gray-500 dark:text-gray-400">{{ $article->created_at->format('d/m/Y') }}</span>
                            </div>
                            
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2 leading-tight">
                                <a href="{{ route('public.show', [$article->user_id, $article->id]) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors">
                                    {{ $article->title }}
                                </a>
                            </h3>
                            
                            <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">
                                {{ Str::limit($article->content, 120) }}
                            </p>
                            
                            <div class="mt-auto pt-4 border-t border-gray-100 dark:border-gray-700 flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="h-8 w-8 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center text-indigo-700 dark:text-indigo-300 font-bold text-sm">
                                        {{ substr($article->user->name, 0, 1) }}
                                    </div>
                                    <a href="{{ route('public.index', $article->user->id) }}" class="ml-2 text-sm font-medium text-gray-900 dark:text-gray-200 hover:underline">
                                        {{ $article->user->name }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-guest-layout>
