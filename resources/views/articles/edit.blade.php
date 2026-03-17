<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800 tracking-tight font-serif">
            Modifier l'article
        </h2>
    </x-slot>

    @if (session('success'))
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-8">
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
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 mt-8">
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
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <form method="post" action="{{ route('articles.update', $article->id) }}" class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-100">
                @csrf
                @method('PUT')
                
                <div class="p-8 border-b border-gray-100">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Titre de l'article</label>
                    <input type="text" value="{{ $article->title }}" name="title" id="title" placeholder="Saisissez un titre accrocheur..." class="w-full text-lg rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors">
                </div>

                <div class="p-8 border-b border-gray-100 bg-gray-50/30">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Contenu</label>
                    <textarea rows="15" name="content" id="content" placeholder="Rédigez votre article ici..." class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors resize-y font-sans">{{ $article->content }}</textarea>
                </div>

                <div class="p-8 border-b border-gray-100">
                    <fieldset>
                        <legend class="text-base font-medium text-gray-900 mb-4">Catégories</legend>
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach ($categories as $category)
                                <label class="relative flex items-start p-4 cursor-pointer rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                    <div class="flex items-center h-5">
                                        <input type="checkbox" name="categories[]" id="category-{{ $category->id }}" value="{{ $category->id }}" {{ in_array($category->id, $article->categories->pluck('id')->toArray()) ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 rounded border-gray-300 focus:ring-indigo-500">
                                    </div>
                                    <div class="ml-3 text-sm">
                                        <span class="font-medium text-gray-700">{{ $category->name }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </fieldset>
                </div>

                <div class="p-8 bg-gray-50 flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" name="draft" id="draft" {{ $article->draft ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 rounded border-gray-300 focus:ring-indigo-500">
                        <label for="draft" class="ml-2 block text-sm text-gray-900 font-medium cursor-pointer">
                            Enregistrer comme brouillon
                        </label>
                    </div>
     
                    <button type="submit" class="inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-full shadow-sm text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-colors">
                        Mettre à jour
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>