<?php

use App\genre;
use App\Record;
use App\User;
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
// to go to static page (shorter notation)
Route::view('/', 'home');
Route::get('shop', 'ShopController@index');
Route::get('shop/{id}', 'ShopController@show');
Route::get('shop_alt', 'shopController@show_alt');
Route::view('contact-us', 'contact');
Route::get("itunes", "ItunesController@itunes");

// longer notation used to pass data to view
Route::prefix('admin')->group(function () {
    Route::redirect('/', '/admin/records');
    Route::get('records', 'Admin\RecordController@index');
});

//ter illustratie
Route::prefix('api')->group(function() {
    Route::get('users', function(){
        return User::get();
    });
    // go to genre.php and add the function public function records() {...}
    Route::get('records', function(){
        return Record::with('genre')->get();
    });
    Route::get('genres', function(){
        return genre::with('records')->get();
    });
});




// longer notation for data inserts
//Route::get('/', function () {
//    return view('home');
//});

//Route::get('contact-us', function() {
//    return view('contact');
//});

