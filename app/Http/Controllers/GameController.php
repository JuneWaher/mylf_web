<?php

namespace App\Http\Controllers;

use App\Notifications\NewGameUser;
use App\Http\Requests\GameCreateRequest;
use App\Http\Requests\GameUpdateRequest;
use Illuminate\Http\Request;
use App\User;
use App\Game;
use Auth;
use Mail;

class GameController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $pages = 5;
    public function index()
    {
        $games = Game::orderBy('when', 'desc')->where('status', '!=', 'PENDING')->paginate($this->pages);
        return view('game.list', compact('games'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('game.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GameCreateRequest $request)
    {
        $add = Game::where('title', $request->title)->count();
        $add++;
        $request->offsetSet('slug', str_slug($request->title . '-' . $add, '-'));
        $request->offsetSet('summary', substr($request->synopsis, 0, 255));

        $imgName = hash('md5', $request->id . $request->title . $add) .'.'. $request->file('cov')->getClientOriginalExtension();
        $request->when = date("Y-m-d H:i:s");
        $request->file('cov')->move('uploads/avatars/', $imgName);

        $data = $request->except('cov');
        $data['cov'] = $imgName;
        $data['status'] = 'PENDING';
        $data['user_id'] = Auth::user()->id;
        $data['author'] = Auth::user()->id;

        Game::create($data);

        // Send message to Bureau & General to accept the games
        /*
            NEED TO BE DONE
        */

        $user = Auth::user();
        Mail::send('mail.gamerequest', ["game" => $data, "user" => $user], function($message){
            $message->to("len.compan@gmail.com");
        });

        return redirect('/')->withOk("<strong>".$request->input('title')."</strong> has been created. An Admin has been e-mailed to review the query.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Game $game)
    {
        return view('game.show', compact('game'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Game $game)
    {
        return view('game.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(GameUpdateRequest $request, Game $game)
    {
        $game->update($request->all());
        return redirect('game/'.$game->slug)->withOk("<strong>".$game->title."</strong> has been modified.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Game $game)
    {
        $game->delete();
        return back()->withOk("The game <strong>".$game->title."</strong> has been deleted.");
    }

    public function subscribe(Game $game)
    {
        if ($game->users->find(Auth::user()->id) || $game->pj_limit == $game->pj_current) {
            return back();  
        }
        $game->increment('pj_current');
        $game->update(['pj_current', $game->pj_current]);
        $game->users()->attach(Auth::user());

        return back();
    }

    public function unsub(Game $game)
    {
        // if ($game->when < Carbon::now())
        //     return back();

        if ($game->users->find(Auth::user()->id)) {
            $game->users()->detach(Auth::user());
            $game->users->find(Auth::user()->id)->games()->detach($game);
            $game->pj_current--;
            $game->update(['pj_current', $game->pj_current]);
            return back();
        }
        return back();
    }
}
