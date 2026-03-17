<x-guest-layout>
    <div class="max-w-4xl mx-auto bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 mt-6 overflow-hidden">
        
        <!-- Article Header -->
        <header class="px-6 py-8 md:p-10 border-b border-gray-100 dark:border-gray-700 text-center">
            <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 dark:text-gray-100 tracking-tight mb-6">
                {{ $article->title }}
            </h1>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 text-sm text-gray-500 dark:text-gray-400">
                <div class="flex items-center">
                    <div class="h-8 w-8 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center text-indigo-700 dark:text-indigo-300 font-bold mr-2">
                        {{ substr($article->user->name, 0, 1) }}
                    </div>
                    <span>Par <a href="{{ route('public.index', $article->user->id) }}" class="font-semibold text-gray-900 dark:text-gray-200 hover:text-indigo-600 dark:hover:text-indigo-400">{{ $article->user->name }}</a></span>
                </div>
                <span class="hidden sm:inline">&bull;</span>
                <time datetime="{{ $article->created_at->format('Y-m-d') }}">Publié le {{ $article->created_at->format('d/m/Y') }}</time>
                <span class="hidden sm:inline">&bull;</span>
                <span class="bg-rose-100 text-rose-700 text-xs font-bold px-2 py-0.5 rounded-full flex items-center">
                    ♥ {{ $article->likes }}
                </span>
            </div>

            @if($article->categories->isNotEmpty())
            <div class="mt-6 flex flex-wrap justify-center gap-2">
                @foreach ($article->categories as $category)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 dark:bg-gray-700 text-gray-800 dark:text-gray-200">
                        {{ $category->name }}
                    </span>
                @endforeach
            </div>
            @endif
        </header>

        <!-- Article Content -->
        <div class="px-6 py-10 md:p-12 prose prose-lg dark:prose-invert max-w-none text-gray-800 dark:text-gray-200">
            {!! nl2br(e($article->content)) !!}
        </div>

        <!-- Like Action -->
        @auth
        <div class="px-6 py-8 md:px-12 bg-gray-50 dark:bg-gray-800/50 border-t border-gray-100 dark:border-gray-700 flex justify-center">
            <a href="{{ route('article.like', $article->id) }}" class="inline-flex items-center px-6 py-3 border border-transparent shadow-sm text-base font-medium rounded-full text-white bg-rose-600 hover:bg-rose-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                </svg>
                J'aime cet article ({{ $article->likes }})
            </a>
        </div>
        @endauth
        
    </div>

    <!-- Comments Section -->
    <div class="max-w-4xl mx-auto mt-12 mb-20">
        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-8 px-2">
            Commentaires ({{ $article->comments->count() }})
        </h3>
        
        @auth
        <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 mb-10">
            <h4 class="text-lg font-medium text-gray-900 dark:text-gray-100 mb-4">Ajouter un commentaire</h4>
            <form action="{{ route('comments.store') }}" method="post">
                @csrf
                <input type="hidden" name="article_id" value="{{ $article->id }}">
                <div class="mb-4">
                    <label for="content" class="sr-only">Votre commentaire</label>
                    <textarea id="content" name="content" rows="4" class="block w-full border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm resize-none" placeholder="Partagez vos impressions..."></textarea>
                </div>
                <div class="flex justify-end">
                    <button type="submit" class="inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        Publier
                    </button>
                </div>
            </form>
        </div>
        @endauth
        @guest
        <div class="bg-gray-50 dark:bg-gray-800/50 rounded-xl p-6 mb-10 text-center border border-gray-200 dark:border-gray-700">
            <p class="text-gray-600 dark:text-gray-400">
                Vous devez être connecté pour laisser un commentaire. 
                <a href="{{ route('login') }}" class="text-indigo-600 dark:text-indigo-400 font-medium hover:underline">Se connecter</a>
            </p>
        </div>
        @endguest

        <div class="space-y-6">
            @forelse ($article->comments as $comment)
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 flex gap-4">
                <div class="flex-shrink-0">
                    <div class="h-10 w-10 rounded-full bg-gray-200 dark:bg-gray-700 text-gray-600 dark:text-gray-300 flex items-center justify-center font-bold">
                        {{ substr($comment->user->name, 0, 1) }}
                    </div>
                </div>
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-2">
                        <h4 class="text-sm font-bold text-gray-900 dark:text-gray-100">{{ $comment->user->name }}</h4>
                        <span class="text-xs text-gray-500 dark:text-gray-400">{{ $comment->created_at->diffForHumans() }}</span>
                    </div>
                    <p class="text-gray-700 dark:text-gray-300 text-sm whitespace-pre-line">{{ $comment->content }}</p>
                </div>
            </div>
            @empty
            <div class="text-center py-10">
                <p class="text-gray-500 dark:text-gray-400">Soyez le premier à commenter cet article !</p>
            </div>
            @endforelse
        </div>
    </div>
</x-guest-layout>

