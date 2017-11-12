<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Article;
use App\Game;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $articles = Article::orderBy('created_at', 'desc')->take(3)->get();
        $games = Game::where('status', 'ACTIVE')->orderBy('when', 'desc')->take(10)->get();
        return view('home', compact('articles', 'games'));
    }
}
