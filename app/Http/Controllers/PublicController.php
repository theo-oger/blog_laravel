<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Article;

class PublicController extends Controller
{
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

public function show( Article $article)
{
    $articles = Article::where('user_id', $article->user_id)->where('draft', 0)->get();

 return view('articles.show', [
            'article' => $article,
            'articles' => $articles
        ]);
}
}
