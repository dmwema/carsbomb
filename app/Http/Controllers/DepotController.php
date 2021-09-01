<?php

namespace App\Http\Controllers;

use App\Models\Depot;
use App\Models\player;
use Illuminate\Http\Request;

class DepotController extends Controller
{
    public function all () {
        $depots = Depot::paginate(12);
        $count = count(Depot::all());

        $players = [];

        foreach ($depots as $depot) {
            $players[$depot->id] = player::find($depot->player);
        }
        
        return view('admin.depots.all', ['depots' => $depots , 'count' => $count, 'player' => $players]);
    }

    public function destroy ($id) {
        $depot = Depot::findOrFail($id);

        $depot->delete();

        return redirect()->back()->with('success', 'Server supprimé avec succès');
    }
}
