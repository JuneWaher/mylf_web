<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleCreateRequest;
use App\Http\Requests\ArticleUpdateRequest;
use Illuminate\Http\Request;
use App\Article;
use Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $pages = 5;

    public function index()
    {
        $articles = Article::orderBy('id', 'desc')->paginate($this->pages);
        return view('article.list', compact('articles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('article.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ArticleCreateRequest $request)
    {
        $add = Article::where('title', $request->title)->count();
        $add++;
        $request->offsetSet('slug', str_slug($request->title . '-' . $add, '-'));
        $request->offsetSet('summary', substr($request->content, 0, 255));
        
        $imgName = hash('md5', $request->id . $request->title . $add) .'.'. $request->file('cov')->getClientOriginalExtension();

        $request->file('cov')->move('uploads/avatars/', $imgName);
    
        $data = $request->except('cov');
        $data['cov'] = $imgName;
        $data['user_id'] = Auth::user()->id;

        Article::create($data);
        return redirect('/articles')->withOk("<strong>".$request->input('title')."</strong> a été créé !");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article)
    {
        return view('article.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Article $article)
    {
        return view('article.edit', compact('article'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return back()->withOk("The article <strong>".$article->title."</strong> has been destroyed");
    }
}
