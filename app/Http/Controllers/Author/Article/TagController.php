<?php

namespace App\Http\Controllers\Author\Article;

use App\Models\Tag;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function __invoke(Tag $tag)
    {
        return view('articles.tags', [
            'tag' => $tag->load(['articles' => function($query) {
                $query->whenNotAdmin()->whenSearch('title')->latest();
            }, 'articles.images', 'articles.tags', 'articles.user', 'articles.category'])
        ]);
    }
}
