<?php

use App\Models\Attentance;
use App\Models\Grade;
use App\Models\Session;
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
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/create-grade', function (Request $request) {
    Grade::create(['title' => $request->title]);
    return redirect('/home');
});

Route::post('/create-session', function (Request $request) {
    if ($request->grade_id == '0') return redirect()->back();
    Session::create(['title' => $request->title, 'grade_id' => $request->grade_id]);
    return redirect('/home');
});

Route::post('/collect-attendance', function (Request $request) {
    if ($request->session_id == '0') return redirect()->back();

    foreach ($request->users as $user) {
        Attentance::create(['session_id' => $request->session_id, 'user_id' => $user]);
    }

    return redirect('/home');
});

