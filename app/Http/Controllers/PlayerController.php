<?php

namespace App\Http\Controllers;

use App\Models\CodeBomb;
use App\Models\Depot;
use App\Models\HasCards;
use App\Models\HasServer;
use App\Models\Play;
use App\Models\player;
use App\Models\server as ModelsServer;
use App\Models\Transfer;
use App\Models\UsedCodeBomb;
use App\Models\Win;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    
    public function all () {
        $players = player::paginate(12);
        $count = count(player::all());

        $childs = [];

        $depots = [];
        $retraits = [];
        $wins = [];
        $looses = [];
        $soldes = [];
        

        $used_codes = [];

        $boot_inscrs = [];
        $boot_parents = [];

        foreach ($players as $player) {
            $usr_depots = Depot::where('player', $player->id)->get();
            $retraits[$player->id] = Transfer::where('user', $player->id)->sum('amount');
            $wins[$player->id] = Win::where('user', $player->id)->sum('amount');
            $looses[$player->id] = Play::where('player', $player->id)->sum('amount');

            $sum_depots = 0;

            foreach ($usr_depots as $usr_depot) {
               $sum_depots += $usr_depot->amount;
            }   
            $depots[$player->id] = $sum_depots;

            $soldes[$player->id] = $depots[$player->id] + $wins[$player->id] - $retraits[$player->id] - $looses[$player->id];
            
            $codes = UsedCodeBomb::where('player', $player->id)->get()->toArray();
            if ($codes == []) {
                $used_codes[$player->id] = 'Aucun';
            } else {
                $code_exist = '';
                foreach ($codes as $code) {
                    if ($code_exist == '') {
                        $code_exist .= CodeBomb::find($code['codebomb'])->code;
                    } else {
                        $code_exist .= ', ' .  CodeBomb::find($code['codebomb'])->code;
                    }
                }
                $used_codes[$player->id] = $code_exist;
            }

            $childs_arr = player::where('parent', $player->username)->get();   

            $boot_parent = false;
            
            if ($childs_arr == null) {
                $childs[$player->id] = 'Aucun';
            } else {
                foreach($childs_arr as $ch) {
                    if ($this->boot_inscr($childs)) {
                        $boot_parent = true;
                    }
                    if ($childs[$player->id] == null) {
                        $childs[$player->id] = $ch->pseudo;
                    } else {
                        $childs[$player->id] += ', ' . $ch->pseudo;
                    }
                }
            }

            $boot_parents[$player->id] = $boot_parent;

            // boosts inscr.
            if ($player->parent != null) {
                $boot_inscrs[$player->id] = $this->boot_inscr($player);
            }
            //end boots
        }
        
        return view('admin.players.all', ['players' => $players, 'count' => $count, 
                'used_codes' => $used_codes, 'childs' => $childs, 
                'boot_parents' => $boot_parents, 'boot_inscrs' => $boot_inscrs,
                'depots' => $depots, 'retraits' => $retraits, 'wins' => $wins, 'looses' => $looses,
                'soldes' => $soldes]);
    }

    private function boot_inscr($player) {
        return  Carbon::parse($player->created_at)->addMonth()->gt(Carbon::now());
    }

    public function destroy ($id) {
        $player = player::findOrFail($id);

        $player->delete();

        return redirect()->back()->with('success', 'Joueur supprimé avec succès');
    }

    public function profile (Request $request) {
        $solde = 0;
        $player = player::where('username', $request->session()->get('auth'))->first();
        $onlines = count(player::all());

        $depots = Depot::where('player', $player->id)->sum('amount');
        $retraits = Transfer::where('user', $player->id)->sum('amount');
        $wins = Win::where('user', $player->id)->sum('amount');
        $looses = Play::where('player', $player->id)->sum('amount');

        $solde = $depots + $wins - $retraits - $looses;
            
        return view('public.profile.profile', ['player' => $player, 'onlines' => $onlines, 'solde' => $solde]);
    }

    public function account (Request $request)
    {
        $solde = 0;
        $player = player::where('username', $request->session()->get('auth'))->first();

        $depots = Depot::where('player', $player->id)->sum('amount');
        $retraits = Transfer::where('user', $player->id)->sum('amount');
        $wins = Win::where('user', $player->id)->sum('amount');
        $looses = Play::where('player', $player->id)->sum('amount');

        $solde = $depots + $wins - $retraits - $looses;

        $used_bombs_id = UsedCodeBomb::where('player', $player->id)->get();
        $used_bombs = [];

        $users_created_servers = ModelsServer::where('creator', $player->id)->get();
        $users_servers = [];

        $has_servers = HasServer::where('player', $player->id)->get();

        foreach ($has_servers as $has_server) {
            $users_servers[] = ModelsServer::find($has_server->server)->first();
        }

        foreach ($used_bombs_id as $bomb) {
            $used_bombs[] = CodeBomb::find($bomb->codebomb);
        }

        $hascards = $this->has_cards($request);

        return view('public.profile.account', ['hascards' => $hascards, 'player' => $player, 'solde' => $solde, 'depots' => $depots, 'wins' => $wins, 'looses' => $looses, 'used_bombs' => $used_bombs, 'users_created_servers' => $users_created_servers, 'users_servers' => $users_servers]);
    }

    public function edit_profile (Request $request) {
        $player = player::where('username', $request->session()->get('auth'))->first();
        return view('public.profile.edit', ['player' => $player]);
    }

    public function update(Request $request)
    {
        $player = player::where('username', $request->session()->get('auth'))->first();

        $validated = $request->validate([
            'firstname' => 'required|min:3',
            'lastname' => 'required|min:3',
            'email' => 'required|email',
            'adress' => 'required',
            'country' => 'required',
        ]);

        if ($request->firstname != null) {
            $player->firstname = $request->firstname;
        }

        if ($request->lastname != null) {
            $player->lastname = $request->lastname;
        }

        if ($request->email != null) {
            $player->email = $request->email;
        }

        if ($request->adress != null) {
            $player->adress = $request->adress;
        }

        if ($request->country != null) {
            $player->country = $request->country;
        }

        $player->save();

        return redirect()->route('public.profile.account')->with('success', 'Profile modifié avec succès');
    }

    public function validate_account (Request $request) {
        $player = player::find($request->player);
        $player->status = \ACCOUNT_VALIDATED;
        $player->save();
        return redirect()->back()->with('validated', 'Compte validé avec succès !');
    }

    public function not_validate_account (Request $request) {
        $player = player::find($request->player);
        $player->status = \ACCOUNT_REFUSED;
        $player->save();
        return redirect()->back()->with('validated', 'Compte réfusé avec succès !');
    }

    public function sendCards (Request $request) {
        $player = player::where('username', $request->session()->get('auth'))->first();
        
        // upload image
        $imageName1 = time().'.'.$request->card_recto->extension();  
        $request->card_recto->move(public_path('assets/images/cards'), $imageName1);

        $hascard = new HasCards();
        $hascard->player = $player->id;
        $hascard->name = "PIÈCE D’IDENTITÉ RECTO";
        $hascard->image = $imageName1;
        $hascard->type = 1;
        $hascard->save();
          

        // upload image
        $imageName2 = time().'.'.$request->card_verso->extension();  
        $request->card_verso->move(public_path('assets/images/cards'), $imageName2);

        $hascard2 = new HasCards();
        $hascard2->player = $player->id;
        $hascard2->name = "PIÈCE D’IDENTITÉ VERSO";
        $hascard2->image = $imageName2;
        $hascard2->type = 2;
        $hascard2->save();
        

        // upload image
        $imageName3 = time().'.'.$request->rib->extension();  
        $request->rib->move(public_path('assets/images/cards'), $imageName3);

        $hascard3 = new HasCards();
        $hascard3->player = $player->id;
        $hascard3->name = "RIB";
        $hascard3->image = $imageName3;
        $hascard3->type = 3;
        $hascard3->save();

        return redirect()->back();    
    }

    public function has_cards(Request $request) {
        $player = player::where('username', $request->session()->get('auth'))->first();
        return HasCards::where('player', $player->id)->get() != null;
    }


    public function delete(Request $request) {
        $player = player::where('username', $request->session()->get('auth'))->first();
        $player->delete();
        $request->session()->flush();
        return redirect()->route('home');
    }

    public function card_validation(Request $request)
    {
        $players = player::where('status', ACCOUNT_WAITING)->get();
        $cards1 = [];
        $cards2 = [];
        $rib = [];
        $count = count(player::all());

        foreach ($players as $player) {
            $cards1[$player->id] = HasCards::where('player', $player->id)->where('type', 1)->first();
            $cards2[$player->id] = HasCards::where('player', $player->id)->where('type', 2)->first();
            $rib[$player->id] = HasCards::where('player', $player->id)->where('type', 3)->first();
        }
        return view('admin.cards', ['players' => $players, 'cards1' => $cards1, 'cards2' => $cards2, 'rib' => $rib, 'count' => $count]);
    }
}
