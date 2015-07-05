<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Request;
use Illuminate\HttpResponse;
use App\Article;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Auth;
//use App\Http\Controllers\Requests\CreateArticleRequest;


class ArticlesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); // Trigger authenticate middleware
    }

    public function index()
    {
    	$articles = Article::latest('published_at')->published()->get();

    	return view('articles.index', compact('articles'));
    }

    /**
     * @param  int
     * @return Response
     */
    public function show($id)
    {
    	$article = Article::findOrFail($id);

        //dd($article->published_at);

    	return view('articles.show', compact('article'));
    }

    /**
     * Create a new arrticle.
     * 
     * @return Response
     */
    public function create()
    {

    	return view ('articles.create');
    }

    /**
     * Save a new article.
     * 
     * @param  CreateArticleRequest $request
     * @return Response
     */
    public function store(Requests\ArticleRequest $request)
    {

        // This only fires if validation passes
        $article = new Article($request->all());
        Auth::user()->articles()->save($article);

        return redirect('articles');
    }

    public function edit($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.edit', compact('article'));
    }

    public function update($id, Requests\ArticleRequest $request)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());
        return redirect('articles');
    }
}
