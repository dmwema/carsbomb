<?php

use App\Http\Controllers\CodeBombController;
use App\Http\Controllers\DepotController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PayPalPaymentController;
use App\Http\Controllers\PlayerController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\WithdrawalController;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('auth-player')->group(function () {
    Route::get('/menu', [PlayerController::class, 'profile'])->name('public.profile');

    Route::get('/profile/edit',[PlayerController::class, 'edit_profile'])->name('profile.edit');
    Route::post('/profile/update',[PlayerController::class, 'update'])->name('profile.update');
    
    Route::get('/account', [PlayerController::class, 'account'])->name('public.profile.account');

    Route::get('/server/new', [ServerController::class, 'new'])->name('public.server.new');
    Route::post('/server/create', [ServerController::class, 'create'])->name('public.server.create');
    Route::get('/server/find', [ServerController::class, 'find'])->name('public.server.find');
    
    Route::post('/codebomb/apply', [CodeBombController::class, 'apply'])->name('public.code.use');

    Route::get('/server/join/{server_id}', [ServerController::class, 'join'])->name('public.server.join');
    Route::get('/server/quit/{server_id}', [ServerController::class, 'quit'])->name('public.server.quit');
    
    Route::get('/play/server-{server_id}', [GameController::class, 'play'])->name('public.game.play');

    Route::get('/withdrawal/new', [WithdrawalController::class, 'new'])->name('public.withdrawal.new');
    Route::post('/withdrawal/store', [WithdrawalController::class, 'store'])->name('public.withdrawal.store');

    //Payment
    Route::get('payment', [PaymentController::class, 'index'])->name('depot');;
    Route::post('charge', [PaymentController::class, 'charge']);
    Route::get('paymentsuccess', [PaymentController::class, 'payment_success']);
    Route::get('paymenterror', [PaymentController::class, 'payment_error']);

    Route::delete('/account/delete', [PlayerController::class, 'delete'])->name('public.account.delete');

    // cards
    Route::post('/send-cards', [PlayerController::class, 'sendCards'])->name('public.send-cards');

});

Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return redirect(route("admin.joueurs"));
    })->name('admin.home');

    Route::get('joueurs', [PlayerController::class, 'all'])->name('admin.joueurs');
    Route::get('cards', [PlayerController::class, 'card_validation'])->name('admin.cards');

    Route::get('/validate/player', [PlayerController::class, 'validate_account'])->name('player.validate');
    Route::get('/not/validate/player', [PlayerController::class, 'not_validate_account'])->name('player.not.validate');


    Route::get('serveurs', [ServerController::class, 'all'])->name('admin.servers');

    Route::get('codebombs', [CodeBombController::class, 'all'])->name('admin.codebombs');

    Route::get('demandesretrait', [WithdrawalController::class, 'all'])->name('admin.retraits');

    Route::get('transfer', [TransferController::class, 'new'])->name('admin.transfer');

    Route::get('transfers', [TransferController::class, 'all'])->name('admin.transfers');

    Route::get('depots', [DepotController::class, 'all'])->name('admin.depots');


    Route::delete('codebomb/{id}', [CodeBombController::class, 'destroy'])->name('code.delete');

    Route::delete('server/{id}', [ServerController::class, 'destroy'])->name('server.delete');

    Route::delete('depot/{id}', [DepotController::class, 'destroy'])->name('depot.delete');

    Route::delete('player/{id}', [PlayerController::class, 'destroy'])->name('player.delete');

    Route::delete('transfer/{id}', [TransferController::class, 'destroy'])->name('transfer.delete');

    Route::delete('withdrawal/{id}', [WithdrawalController::class, 'destroy'])->name('withdrawal.delete');


    Route::get('/edit/code/{id}', [CodeBombController::class, 'edit'])->name('code.edit');

    Route::get('/edit/server/{id}', [ServerController::class, 'edit'])->name('server.edit');


    Route::put('/update/code/{id}', [CodeBombController::class, 'update'])->name('code.update');

    Route::put('/update/server/{id}', [ServerController::class, 'update'])->name('server.update');


    Route::get('/new/code', [CodeBombController::class, 'new'])->name('code.new');

    Route::put('/store/code', [CodeBombController::class, 'store'])->name('code.store');
    
});


Route::get('/login', function (Request $request) {
    if (auth_player()) { 
        return redirect()->route('home');
    }
    return view('public.auth.login');
})->name('public.login');

Route::get('/register', function (Request $request) {
    if (auth_player()) { 
        return redirect()->route('home');
    }
    return view('public.auth.register');
})->name('public.register');

Route::get('/logout', [RegisterController::class, 'logout'])->name('public.logout');

Route::post('/register', [RegisterController::class, 'register'])->name('public.register.store');

Route::post('/login', [RegisterController::class, 'login'])->name('public.login.store');