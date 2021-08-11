<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

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

Route::get('/', function (Request $request) {
    return view('dashboard', [
        'clients' => $request->user()->clients
    ]);
})->middleware(['auth'])->name('dashboard');

Route::get('/welcome', function(){
    return view('welcome');
});


require __DIR__.'/auth.php';


Route::get('redirect', function () {
    

    $query = http_build_query([
        'client_id' => '1',
        'redirect_uri' => 'http://localhost:8000/callback',
        'response_type' => 'code',
        'scope' => '',
    ]);

    return redirect('http://localhost:8000/oauth/authorize?' . $query);
})->name('get.token');


Route::get('/callback', function (Request $request) {
    return view('callback', [
        'response' => $request->code
    ]);
});
