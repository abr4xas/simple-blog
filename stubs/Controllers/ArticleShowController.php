<?php

namespace App\Http\Controllers\Front\Articles;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Abr4xas\SimpleBlog\Models\Article;

class ArticleShowController extends Controller
{
	public function __construct()
	{
		$this->middleware(['is.live:article']);
	}

	/**
     * Handle the incoming request.
	 *
	 * @param \Illuminate\Http\Request $request
	 * @param \Abr4xas\SimpleBlog\Models\Article $article
     * @return \Illuminate\Http\Response
	 */
    public function __invoke(Request $request, Article $article)
    {
		$article->loadMissing([
			'author',
			'category'
		]);

        // $related = $article->related();

        return $article;
    }
}
