<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use App\Models\Play;
use App\Models\player;
use App\Models\Transfer;
use App\Models\Win;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class WithdrawalController extends Controller
{
    public function all () {
        $withdrawals = Withdrawal::paginate(12);
        $count = count(Withdrawal::all());

        $players = [];

        foreach($withdrawals as $withdrawal) {
            $players[$withdrawal->id] = player::find($withdrawal->user);
        }
        
        return view('admin.withdrawals.all', ['withdrawals' => $withdrawals, 'players' => $players, 'count' => $count]);
    }

    public function destroy ($id) {
        $withdrawal = Withdrawal::findOrFail($id);

        $withdrawal->delete();

        return redirect('admin/demandesretrait')->with('success', 'Demande de retrait supprimée avec succès');
    }

    public function new (Request $request) {
        $player = player::where('username', $request->session()->get('auth'))->first();

        $depots = Depot::where('player', $player->id)->sum('amount');
        $retraits = Transfer::where('user', $player->id)->sum('amount');
        $wins = Win::where('user', $player->id)->sum('amount');
        $looses = Play::where('player', $player->id)->sum('amount');

        $solde = $depots + $wins - $retraits - $looses;

        return view('public.withdrawal.new', ['player' => $player, 'solde' => $solde]);
    }

    public function store (Request $request) {
        $validated = $request->validate([
            'amount' => 'required',
        ]);

        $player = player::where('username', $request->session()->get('auth'))->first();

        $withdrawals = Withdrawal::where('user', $player->id)->where('state', 0)->get();

        $sum_withdrawals = 0;

        foreach ($withdrawals as $w) {
            $sum_withdrawals += $w->amount;
        }

        // dd($sum_withdrawals);

        $depots = Depot::where('player', $player->id)->sum('amount');
        $retraits = Transfer::where('user', $player->id)->sum('amount');
        $wins = Win::where('user', $player->id)->sum('amount');
        $looses = Play::where('player', $player->id)->sum('amount');

        $solde = $depots + $wins - $retraits - $looses;

        if ($solde == 0) {
            return redirect()->back()->with('error_withdrawal', 'Vous n\'avez pas assez d\'argent dans votre compte pour effectuer cette demande de retrait');
        }

        if ($request->amount > $solde) {
            return redirect()->back()->with('error_withdrawal', 'Vous n\'avez pas assez d\'argent dans votre compte pour effectuer cette demande de retrait');
        } 

        if ($request->amount < 10) {
            return redirect()->back()->with('Vous ne pouvez pas rétirer moins de 10€');
        } 

        if ($sum_withdrawals + $request->amount - 10 > $solde) {
            return redirect()->back()->with('error_withdrawal', 'Vos demandes de retrait en cours sont de ' . $sum_withdrawals . '€, Vous ne pouvez donc pas demander un retrai de ' . $request->amount . '€');
        }

        $withdrawal = new Withdrawal();
        $withdrawal->user = $player->id;
        $withdrawal->amount = $request->amount;
        $withdrawal->save();

        return redirect()->back()->with('success_withdrawal', 'Demande de retrait effectuée avec succès. Vous serez livré dans 7 jours tout au plus.');
    }
}
