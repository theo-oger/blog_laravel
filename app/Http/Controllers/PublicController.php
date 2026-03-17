<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;

class PublicController extends Controller
{
    public function home()
    {
        // On récupère les 3 articles les plus likés qui ne sont pas des brouillons
        $articles = Article::where('draft', 0)->orderBy('likes', 'desc')->limit(3)->get();

        return view('public.home', [
            'articles' => $articles
        ]);
    }

    public function index(User $user)
{
    // On récupère les articles publiés de l'utilisateur
    $articles = Article::where('user_id', $user->id)->where('draft', 0)->get();

    // On retourne la vue
    return view('public.index', [
        'articles' => $articles,
        'user' => $user
    ]);
}

public function show(User $user, Article $article)
{
    return view('public.show', [
        'article' => $article
    ]);
}


}
