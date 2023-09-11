<?php

use App\Http\Controllers\BaseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransxmlController;




Route::get('/', function () {
    return view('welcome');
});

//Route::get('/xml-push', 'TransxmlController@pushxml');
Route::get('/xml-load', [TransxmlController::class, 'loadxml']);
Route::get('/xml-push', [TransxmlController::class, 'pushxml']);


Route::get('xml-upload', [BaseController::class, 'UploadXML'])->name('uploadxml');
Route::post('xml-upload', [BaseController::class, 'UploadXMLpost'])->name('uploadxml.post');
Route::get('xml-list', [BaseController::class, 'index'])->name('uploadxml.list');



