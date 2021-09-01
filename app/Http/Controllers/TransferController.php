<?php

namespace App\Http\Controllers;

use App\Models\player;
use App\Models\Transfer;
use Illuminate\Http\Request;

class TransferController extends Controller
{
    public function all () {
        $transfers = Transfer::paginate(12);

        $count = count(Transfer::all());
        
        $players = [];

        foreach ($transfers as $trasnfer) {
            $players[$trasnfer->user] = player::find($trasnfer->user);
        } 
        return view('admin.transfers.all', ['transfers' => $transfers , 'count' => $count , 'players' => $players]);
    }

    public function destroy ($id) {
        $transfer = Transfer::findOrFail($id);

        $transfer->delete();

        return redirect()->back()->with('success', 'Transfer supprimé avec succès');
    }
}
