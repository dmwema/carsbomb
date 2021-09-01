<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use App\Models\HasServer;
use App\Models\Play;
use App\Models\player;
use App\Models\server;
use App\Models\Transfer;
use App\Models\Win;
use Illuminate\Http\Request;

class ServerController extends Controller
{
    public function all () {
        $servers = server::paginate(12);

        $count = count(server::all());
        
        $creators = [];

        foreach ($servers as $server) {
            $creators[$server->id] = player::find($server->creator);
        }

        return view('admin.servers.all', ['servers' => $servers,'creators' => $creators , 'count' => $count]);
    }

    public function destroy ($id) {
        $server = server::findOrFail($id);

        $server->delete();

        return redirect('admin/serveurs')->with('success', 'Server supprimé avec succès');
    }

    public function edit(Request $request) {
        $server = server::find($request->id);
        $creator = player::find($server->creator);
        return view('admin.servers.edit', ['server' => $server, 'creator' => $creator]);
    }

    public function update(Request $request, $id)
    { 
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'amount' => 'required|numeric',
            'max_players' => 'required|numeric',
        ]); 

        $server = server::find($id);

        if ($request->name != null) {
            $server->name = $request->name;
        }

        if ($request->amount != null) {
            $server->amount = $request->amount;
        }

        if ($request->max_players != null) {
            $server->max_players = $request->max_players;
        }

        if ($request->type != null) {
            $server->type = $request->type;
        }

        $server->save();

        return redirect('/admin/serveurs')->with('success', 'Serveur modifié avec succès');
    }

    public function new (Request $request) {
        $solde = 0;
        $player = player::where('username', $request->session()->get('auth'))->first();
        $onlines = count(player::all());

        $depots = Depot::where('player', $player->id)->sum('amount');
        $retraits = Transfer::where('user', $player->id)->sum('amount');
        $wins = Win::where('user', $player->id)->sum('amount');
        $looses = Play::where('player', $player->id)->sum('amount');

        $solde = $depots + $wins - $retraits - $looses;
            
        return view('public.server.new', ['player' => $player, 'onlines' => $onlines, 'solde' => $solde]);
    }
    
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:3',
            'amount' => 'required|numeric',
            'max_players' => 'required|numeric',
        ]); 

        $creator = player::where('username', $request->session()->get('auth'))->first();

        $server = new server();
        $server->name = $request->name;
        $server->amount = $request->amount;
        $server->max_players = $request->max_players;
        $server->creator = $creator->id;
        $server->type = 1;

        $server->save();
        
        return redirect()->back()->with('server_created', 'serveur crée avec succès');
    }

    public function find (Request $request) { 
        $solde = 0;
        $player = player::where('username', $request->session()->get('auth'))->first();
        $onlines = count(player::all());

        $depots = Depot::where('player', $player->id)->sum('amount');
        $retraits = Transfer::where('user', $player->id)->sum('amount');
        $wins = Win::where('user', $player->id)->sum('amount');
        $looses = Play::where('player', $player->id)->sum('amount');

        $solde = $depots + $wins - $retraits - $looses;

        $servers = server::all();
        $servers_members = [];
        $is_players_server = [];

        $players_servers = HasServer::where('player', $player->id)->get();

        foreach ($servers as $server) {
            $servers_members[$server->id] = count(HasServer::where('server', $server->id)->get());
            
            $is_players_server[$server->id] = false;
            foreach ($players_servers as $players_server) {
                if ($server->id == $players_server->server) {
                    $is_players_server[$server->id] = true;
                }
            }
        }

        return view('public.server.find', ['player' => $player, 'onlines' => $onlines, 'solde' => $solde, 'servers' => $servers, 'servers_members' => $servers_members, 'is_players_server' => $is_players_server]);
   
    }

    public function join (Request $request) {
        $server_id = $request->server_id;
        $player = player::where('username', $request->session()->get('auth'))->first();
        
        $has_server = new HasServer();
        $has_server->player = $player->id;
        $has_server->server = $server_id;
        
        $has_server->save();

        return redirect()->back()->with('server_joined', 'Vous avez rejoint le serveur avec succès');
    }

    public function quit (Request $request) {
        $server_id = $request->server_id;
        $player = player::where('username', $request->session()->get('auth'))->first();
        
        $has_server = HasServer::where('player', $player->id)->where('server', $server_id);
        
        $has_server->delete();

        return redirect()->back()->with('server_quit', 'Vous avez quitté le serveur avec succès');
    }
}
