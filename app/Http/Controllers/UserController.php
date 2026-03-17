<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index()    {
        // On récupère l'utilisateur connecté.
        $user = Auth::user();
        $articles = Article::where('user_id', $user->id)->get();

        // On retourne la vue.
        return view('dashboard', [
            'articles' => $articles
        ]);
    }

    public function create()
    {
        $categories = Category::all();
        return view('articles.create', [
            'categories' => $categories
        ]);    }

    public function store(Request $request)    {
        $data = $request->only(['title', 'content', 'draft']);

        $data['user_id'] = Auth::user()->id;

        $data['draft'] = isset($data['draft']) ? 1 : 0;

        $article = Article::create($data);
        $article->categories()->sync($request->input('categories', []));
        return redirect()->route('dashboard')->with('success', 'Article créé avec succès !');
    }

    public function edit(Article $article)
    {
        if ($article->user_id !== Auth::user()->id) {
            return redirect()->route('dashboard')->with('error', 'Vous ne pouvez pas modifier cet article.');
        }

        // On retourne la vue avec l'article et les catégories
        $categories = Category::all();
        return view('articles.edit', [
            'article' => $article,
            'categories' => $categories
        ]);
    }

    public function remove(Article $article)
    {
        if ($article->user_id !== Auth::user()->id) {
            return redirect()->route('dashboard')->with('error', 'Vous ne pouvez pas supprimer cet article.');
        }

        // On supprime les relations pour éviter les erreurs de contrainte d'intégrité
        $article->categories()->detach();
        $article->comments()->delete();

        $article->delete();
        return redirect()->route('dashboard')->with('success', 'Article supprimé avec succès !');
    }

    public function update(Request $request, Article $article)
    {
        // On vérifie que l'utilisateur est bien le créateur de l'article
        if ($article->user_id !== Auth::user()->id) {
            return redirect()->route('dashboard')->with('error', 'Vous ne pouvez pas modifier cet article.');
        }

        // On récupère les données du formulaire
        $data = $request->only(['title', 'content', 'draft']);

        // Gestion du draft
        $data['draft'] = isset($data['draft']) ? 1 : 0;

        // On met à jour l'article
        $article->update($data);
        $article->categories()->sync($request->input('categories', []));

        // On redirige l'utilisateur vers la liste des articles (avec un flash)
        return redirect()->route('dashboard')->with('success', 'Article mis à jour !');
    }

    public function like(Article $article)
    {
        $article->likes = $article->likes + 1;
        $article->save();

        return redirect()->back();    }

}
