<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
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

Route::middleware('auth')->group(function () {
  Route::get("/ticket", [TicketController::class, "index"])->name("ticket.index");
  Route::get("/ticket/create", [TicketController::class, 'create'])->name("ticket.create");
  Route::patch("/ticket/store", [TicketController::class, 'store'])->name("ticket.store");
  Route::get("/ticket/edit/{id}", [TicketController::class, 'edit'])->name("ticket.edit");
  Route::get("/ticket/view", [TicketController::class, 'view'])->name("ticket.view");
  Route::get("/ticket/destroy{ticket}", [TicketController::class, 'destroy'])->name("ticket.destroy");
});

Route::get('/auth/redirect', function () {

  return Socialite::driver('github')->redirect();
})->name('github.login');


Route::get('/auth/callback', function () {
  $user = Socialite::driver('github')->user();
  $name = isset($user->name) ? $user->name : (isset($user->nickname) ? $user->nickname : "null");
  $login_user = users::firstOrCreate(
    ["email" => isset($user->email) ? $user->email : null],
    [
      "name" => $name,
      "password" => bcrypt("12345678"),
      "github_id" => isset($user->id) ? $user->id : null,
    ]
  );
  Auth::login($login_user);
  return redirect('/dashboard');
});


Route::get("/google", function () {
  return Socialite::driver('google')->redirect();
})->name('google.signup');

Route::get('/google/login', function () {
  $user = Socialite::driver('google')->user();

  $name = isset($user->name) ? $user->name : (isset($user->nickname) ? $user->nickname : "null");
  $login_user = users::firstOrCreate(
    ["email" => isset($user->email) ? $user->email : null],
    [
      "name" => $name,
      "password" => bcrypt("12345678"),
      "google_id" => isset($user->id) ? $user->id : null,
    ]
  );
  Auth::login($login_user);
  return redirect('/dashboard');
});



Route::middleware(['auth', 'role:admin'])->group(function () {
  Route::get("/admin/dashboard", [AdminController::class, "dashboard"])->name("admin.dashboard");
  Route::get('/admin/logout',[AdminController::class,"AdminLogout"])->name('admin.logout');
  Route::get('/admin/profile',[AdminController::class,"AdminProfile"])->name('admin.profile');
  Route::post('/admin/profile/store',[AdminController::class,"AdminProfilestore"])->name('admin.profilestore');
  Route::get('/admin/changepassword',[AdminController::class,"AdminChangepassword"])->name('admin.changepassword');
  Route::post('/admin/changepassword',[AdminController::class,"AdminSavepassword"])->name('admin.savepassword');

});

Route::middleware(['auth', 'role:agent'])->group(function () {
  Route::get("/agent/dashboard", [AgentController::class, "dashboard"])->name("agent.dashboard");
});

/**
 * admin login
 */

 Route::get('admin/login',[AdminController::class,"AdminLogin"])->name('admin.login');

require __DIR__ . '/auth.php';
