<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function all () {
        $users = User::paginate(12);
        $count = count(User::all());
        return view('admin.users.all', ['users' => $users, 'count' => $count]);
    }
}
