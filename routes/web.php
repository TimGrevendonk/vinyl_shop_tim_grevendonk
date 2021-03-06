<?php

use App\genre;
use App\Http\Controllers\ContactUsController;
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
Route::get("itunes", "ItunesController@itunes");
Route::get("contact-us", "ContactUsController@show");
// This post gives form content to the page.
Route::post("contact-us", "ContactUsController@sendEmail");

// longer notation used to pass data to view
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::redirect('/', '/admin/records');
    Route::resource('genres', 'Admin\GenreController');
        // Always place the get rout before the resource route.
    Route::get('genres2/queryGenres', 'Admin\Genre2Controller@queryGenres');
    Route::resource('genres2', 'Admin\Genre2Controller', ['parameters' => ['genres2' => 'genre']]);
    Route::resource('records', 'Admin\RecordController');
    Route::resource('users', 'Admin\UserController');
});

Route::middleware(['auth'])->prefix('user')->group(function () {
    Route::redirect('/', '/user/profile');
    Route::get('profile', 'User\ProfileController@edit');
    Route::post('profile', 'User\ProfileController@update');
    Route::get('password', 'User\PasswordController@edit');
    Route::post('password', 'User\PasswordController@update');
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


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
