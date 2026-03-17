<x-guest-layout>
    <!-- Profile Header -->
    <div class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-700 mt-6 rounded-t-lg">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 text-center">
            <div class="h-20 w-20 rounded-full bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-300 flex items-center justify-center text-3xl font-bold mx-auto mb-4 border-4 border-white shadow-sm">
                {{ substr($user->name, 0, 1) }}
            </div>
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-gray-100 tracking-tight sm:text-4xl">
                Le blog de {{ $user->name }}
            </h1>
            <p class="mt-3 max-w-2xl mx-auto text-lg text-gray-500 dark:text-gray-400">
                Découvrez tous les articles publiés par cet auteur.
            </p>
        </div>
    </div>

    <!-- Article List -->
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10 bg-white dark:bg-gray-800 rounded-b-lg shadow-sm">
        @if($articles->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-500 dark:text-gray-400 text-lg">Cet auteur n'a pas encore publié d'articles.</p>
            </div>
        @else
            <div class="space-y-8">
                @foreach ($articles as $article)
                    <div class="border border-gray-100 dark:border-gray-700 rounded-xl p-6 hover:shadow-md transition-shadow">
                        <div class="flex justify-between items-start mb-2">
                            <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                <a href="{{ route('public.show', [$article->user_id, $article->id]) }}" class="hover:text-indigo-600 transition-colors">
                                    {{ $article->title }}
                                </a>
                            </h2>
                            <span class="bg-rose-100 text-rose-700 text-xs font-bold px-2 py-1 rounded inline-flex items-center shrink-0 ml-4">
                                ♥ {{ $article->likes }}
                            </span>
                        </div>
                        
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-4">
                            Publié le {{ $article->created_at->format('d/m/Y') }}
                        </p>
                        
                        <p class="text-gray-700 dark:text-gray-300 mb-6 line-clamp-2">
                            {{ Str::limit($article->content, 180) }}
                        </p>

                        <div class="flex items-center justify-between">
                            <div class="flex flex-wrap gap-2">
                                @foreach ($article->categories as $category)
                                    <span class="inline-block bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs px-3 py-1 rounded-full">
                                        {{ $category->name }}
                                    </span>
                                @endforeach
                            </div>
                            <a href="{{ route('public.show', [$article->user_id, $article->id]) }}" class="text-indigo-600 dark:text-indigo-400 font-medium hover:underline text-sm">
                                Lire la suite &rarr;
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-guest-layout>