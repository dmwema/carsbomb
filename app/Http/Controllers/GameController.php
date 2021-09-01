<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use App\Models\Play;
use App\Models\player;
use App\Models\server;
use App\Models\Transfer;
use App\Models\Win;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function play (Request $request) {
        $player = player::where('username', $request->session()->get('auth'))->first();

        $solde = 0;

        $depots = Depot::where('player', $player->id)->sum('amount');
        $retraits = Transfer::where('user', $player->id)->sum('amount');
        $wins = Win::where('user', $player->id)->sum('amount');
        $looses = Play::where('player', $player->id)->sum('amount');

        $solde = $depots + $wins - $retraits - $looses;

        $server = server::find($request->server_id);

        if ($server->amount > $solde) {
            return view('public.game.error');
        }

        if ($player->status == 3) {
            return 'Votre compte est réfusé. Vous ne pouvez pas joueur, veuillez nous contacter.';
        }

        return view('public.game.play', ['server' => $server]);
    }

    public function start () {
        
    }

    public function stop () {

    }
}