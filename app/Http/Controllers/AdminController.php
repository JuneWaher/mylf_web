<?php

namespace App\Http\Controllers;

use App\Game;
use App\User;
use Mail;
use App\Article;
use Illuminate\Http\Request;
use App\Http\Requests\AdminGamePromoteRequest;
use App\Http\Requests\AdminUserPromoteRequest;
use App\Http\Requests\AdminUserDemoteRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Game::all();
        $articles = Article::all();
        $users = User::all();
        return view('admin.dash', compact('games', 'articles', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
    public function destroy($id)
    {
        //
    }

    public function games()
    {
        $games = Game::orderBy('when', 'desc')->paginate(10);
        return view('admin.game.list', compact('games'));
    }

    public function articles()
    {
        $articles = Article::paginate(10);
        return view('admin.article.list', compact('articles'));
    }

    public function users()
    {
        $users = User::paginate(10);
        return view('admin.user.list', compact('users'));
    }

    public function gameshow()
    {
        $games = Game::paginate(10);
        return view('admin.game.list', compact('games'));
    }

    public function acceptGame(AdminGamePromoteRequest $request, Game $game)
    {
        $status = $game->status;
        $mess = "<strong>".$game->title."</strong> has been updated to ";
        if ($game->status == 'ACTIVE')
            return back()->withOk("Can't promote status of <strong>" .$game->title. "</strong>.");
        else if ($game->status == 'PENDING') {
            $status = 'ACTIVE';
        }
        else if ($game->status == 'CANCELED' || $game->status == 'ENDED') {
            $status = 'PENDING';
        }
        $request->offsetSet('status', $status);
        $game->update($request->all());

        //Sending mail to all database
        $users = User::all();
        
        //$adm->notify(new NewGameUser($game));
        for ($i = 0; $i < count($users); $i++)
        {
            Mail::send('mail.activegamenotification', ['game' => $game, 'user' => $users[$i]], function($message)
            {
                $message->to($users[$i]);
            });
        }

        return back()->withOk($mess . $status);
    }

    public function demote(AdminGamePromoteRequest $request, Game $game)
    {
        $status = $game->status;
        $mess = "<strong>".$game->title."</strong> has been updated to ";

        if ($game->status == 'CANCELED')
            return back()->withOk("Can't demote status of <strong>" .$game->title. "</strong>.");
        else if ($game->status == 'ENDED') {
            $status = 'CANCELED';
        }
        else if ($game->status == 'PENDING') {
            $status = 'ENDED';
        }
        else if ($game->status == 'ACTIVE') {
            $status = 'PENDING';
        }

        $request->offsetSet('status', $status);
        $game->update($request->all());
        return back()->withOk($mess . $status);
    }

    public function promoteuser(AdminUserPromoteRequest $request, User $user)
    {
        if ($user->role_id > 1)
            $user->role_id -= 1;
        else
            return back()->withOk("Impossible, utilisateur déjà au maximum");
        $request->offsetSet('role_id', $user->role_id);
        $user->update($request->all());
        
        //===== Send mail ?
        
        return back()->withOk($user->name . " monte d'un rang");
    }

    public function demoteuser(AdminUserDemoteRequest $request, User $user)
    {
        if ($user->role_id < 5)
            $user->role_id += 1;
        else
            return back()->withOk("Impossible, utiliser déjà au minimum");
        
        $request->offsetSet('role_id', $user->role_id);
        $user->update($request->all());
        
        //===== Send mail ?
        
        return back()->withOk($user->name . " descend d'un rang");
    }
}
