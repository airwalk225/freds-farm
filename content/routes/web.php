<?php
use Illuminate\Http\Request;
use App\Http\Controllers;
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

Route::get('/submit', function() {
    return view('submit');
});

Route::post('/submit', function (Request $request) {
    $data = $request->validate([
        'milk_volume' => 'required|string|max:100',
        'breed' => 'required|string|max:50',
        'age' => 'required|numeric|min:1',
    ]);

    $cow = tap(new App\cows($data))->save();

    return redirect('/');
});

Route::post('addDailyMilking', 'DailyMilkController@DailyMilker');

Route::get('/cows', function (){
    $cows = \App\cows::all();

    return view('cows', ['cows' => $cows]);
});

Route::post('/cows', function() {
    $data = $request->validate([
        'milk_volume' => 'required|float|min:1'
    ]);

    $cow = tap(new App\daily_milk($data))->save();

    return redirect('/cows');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
