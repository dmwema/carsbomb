<?php

namespace App\Http\Controllers;

use App\Models\player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function register (Request $request) {
        $validated = $request->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'email' => 'required|email',
            'username' => 'required|min:3|unique:players',
            'birthday' => 'required|date',
            'country' => 'required',
            'pw' => 'required|confirmed|min:6',
            'pw_confirmation' => 'required|min:6',
            'credit_card' => 'required',
            'postal_adress' => 'required',
            'compl_adress' => 'required',
            'postal_code' => 'required',
            'major' => 'accepted',
            'cgu' => 'accepted',
            /*'image' => 'image',
            'card1' => 'image',
            'card2' => 'image',
            'rib' => 'image',*/
        ]);

        $player = new player();
        $player->lastname = $request->lastname;
        $player->firstname = $request->firstname;
        $player->username = $request->username;
        $player->email = $request->email;
        $player->birthday = $request->birthday;
        $player->country = $request->country;

        // upload image
        // $imageName = time().'.'.$request->image->extension();  
        //$request->image->move(public_path('assets/images/players'), $imageName);
        $player->image = 'teste';
        // $player->image = $imageName;

        $player->credit_card = $request->credit_card;
        $player->postal_adress = $request->postal_adress;
        $player->compl_adress = $request->compl_adress;
        $player->postal_code = $request->postal_code;
        $player->rib = $request->rib;
        
        $player->parent = $request->parent;
        $player->status = ACCOUNT_WAITING;
        $player->type = 1;

        $player->password = Hash::make($request->pw);

        $player->save();
        
        $request->session()->put('auth', $player->username);   

        return redirect()->route('public.profile');
    }

    public function login (Request $request) { 
        $validated = $request->validate([
            'identity' => 'required',
            'password' => 'required|min:6',
        ]);

        $player = player::where('username', $request->identity)->orWhere('email', $request->identity)->first();
        
        if ($player == null) {
            return 'Aucon compte trouvé';
        }

        if (Hash::check($request->password, $player->password)) {    
            $request->session()->put('auth', $player->username);    
            return redirect()->route('public.profile');
        }

        return 'any';
    }

    public function logout(Request $request) {
        $request->session()->forget('auth');
        return redirect()->route('public.login');
    }

}
