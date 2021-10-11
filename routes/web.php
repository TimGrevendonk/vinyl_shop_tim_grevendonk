<?php

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
Route::view('contact-us', 'contact');

// longer notation used to pass data to view
Route::prefix('admin')->group(function () {
    Route::redirect('/', '/admin/records');
    Route::get('records', 'Admin\RecordController@index');
});


    // longer notation for data inserts
//Route::get('/', function () {
//    return view('home');
//});

//Route::get('contact-us', function() {
//    return view('contact');
//});

