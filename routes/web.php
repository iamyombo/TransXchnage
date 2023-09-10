<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransxmlController;




Route::get('/', function () {
    return view('welcome');
});

//Route::get('/xml-push', 'TransxmlController@pushxml');
Route::get('/xml-load', [TransxmlController::class, 'loadxml']);
Route::get('/xml-push', [TransxmlController::class, 'pushxml']);
