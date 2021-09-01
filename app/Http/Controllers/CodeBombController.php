<?php

namespace App\Http\Controllers;

use App\Models\CodeBomb;
use App\Models\player;
use App\Models\UsedCodeBomb;
use Carbon\Carbon;
use Illuminate\Http\Request;
use League\CommonMark\Inline\Element\Code;

class CodeBombController extends Controller
{
    public function all () {
        $codes = CodeBomb::paginate(12);
        $count = count(CodeBomb::all());

        return view('admin.codes.all', ['codes' => $codes , 'count' => $count]);
    }

    public function destroy ($id) {
        $code = CodeBomb::findOrFail($id);

        $code->delete();

        return redirect('/admin/codebombs')->with('success', 'CodeBomb supprimé avec succès');
    }

    public function edit(Request $request) {
        $code = CodeBomb::find($request->id);
        return view('admin.codes.edit', ['code' => $code]);
    }

    public function update(Request $request, $id)
    { 
        $validatedData = $request->validate([
            'code' => 'required|min:3',
            'value' => 'required|numeric',
            'end' => 'required|date'
        ]); 


        $code = CodeBomb::find($id);

        if ($request->code != null) {
            $code->code = $request->code;
        }

        if ($request->value != null) {
            $code->value = $request->value;
        }

        if ($request->end != null) {
            $code->end = Carbon::parse($request->end)->format('Y-m-d');
        }

        $code->save();

        return redirect('/admin/codebombs')->with('success', 'Code bomb modifié avec succès');
    }

    public function new () {
        return view('admin.codes.new');
    }

    public function store(Request $request)
    { 
        $validatedData = $request->validate([
            'code' => 'required|min:3',
            'value' => 'required|numeric',
            'end' => 'required|date'
        ]); 


        $code = new CodeBomb();
        $code->code = $request->code;
        $code->value = $request->value;
        $code->end = Carbon::parse($request->end)->format('Y-m-d');

        $code->save();

        return redirect('/admin/codebombs')->with('success', 'Code bomb créé avec succès');
    }

    public function apply (Request $request) {        
        
        $validatedData = $request->validate([
            'code' => 'required',
        ]); 
        
        $code = $request->code;
        $code_obj = CodeBomb::where('code', $code)->first();

        if ($code_obj == null) {
            return redirect()->back()->with('code_error', 'Le code entré est invalid');
        }

        $player = player::where('username', $request->session()->get('auth'))->first();

        $aplied = UsedCodeBomb::where('codebomb', $code_obj->id)->where('player', $player->id)->first();

        if ($aplied == null) {
            $new_apply = new UsedCodeBomb();
            $new_apply->player = $player->id;
            $new_apply->codebomb = $code_obj->id;
            $new_apply->save();

            return redirect()->back()->with('code_success', 'Bravo ! Vous avez à partir de maintenant un gain de ' . $code_obj->value . '% sur tous les jeux remportés.');
        }

        return redirect()->back()->with('code_error', 'Vous avez déjà utilisé ce code');
        
    }

}
