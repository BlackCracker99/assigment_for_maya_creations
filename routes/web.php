<?php

use App\Http\Controllers\InquaryController;
use App\Http\Controllers\locationController;
use App\Models\locations;
use App\Models\Inquary;
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
    $locations = locations::all();
    return view('welcome' , compact("locations"));
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    $locations = locations::all();
    return view('dashboard' , compact("locations"));
})->name('dashboard');

Route::middleware(['auth:sanctum', 'verified'])->get('/inquaries', function () {
    $inquaries = Inquary::all();
    return view('inquaries' , compact("inquaries"));
})->name('inquaries');

Route::post('send-inquary', [InquaryController::class, 'store']);

Route::post('add-location',[locationController::class,'store'])
->name('add_location');

Route::get('search-location',[locationController::class,'search'])
->name('search_location');
