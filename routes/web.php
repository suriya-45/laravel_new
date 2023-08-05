<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TicketController;
use App\Models\users;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('auth')->prefix("ticket")->group(function(){
//   Route::get("/",[TicketController::class,"create"])->name("ticket.create");
  Route::resource("/",TicketController::class);
});

Route::get('/auth/redirect', function () {
    
    return Socialite::driver('github')->redirect();
})->name('github.login');


Route::get('/auth/callback', function () {
    $user = Socialite::driver('github')->user();
    $name = isset($user->name) ? $user->name : (isset($user->nickname) ? $user->nickname : "null");
    $login_user = users::firstOrCreate(
      ["email"=>isset($user->email) ? $user->email : null],
      [
      "name"=>$name,
      "password"=>bcrypt("12345678"),
      "github_id"=>isset($user->id) ? $user->id : null,
      ]
    );
   Auth::login($login_user);
   return redirect('/dashboard');
});

Route::get("/google",function(){
    return Socialite::driver('google')->redirect();
})->name('google.signup');
Route::get('/google/login', function () {
    $user = Socialite::driver('google')->user();
 
    $name = isset($user->name) ? $user->name : (isset($user->nickname) ? $user->nickname : "null");
    $login_user = users::firstOrCreate(
      ["email"=>isset($user->email) ? $user->email : null],
      [
      "name"=>$name,
      "password"=>bcrypt("12345678"),
      "github_id"=>isset($user->id) ? $user->id : null,
      ]
    );
   Auth::login($login_user);
   return redirect('/dashboard');
});

require __DIR__.'/auth.php';
