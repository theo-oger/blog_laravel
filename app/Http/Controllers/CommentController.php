<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        $content = $request->input('content');
        $articleId = $request->input('article_id');

        Comment::create([
            'content' => $content,
            'article_id' => $articleId,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->back();
    }


}
