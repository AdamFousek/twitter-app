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

Route::get('/', function () {
    return view('index');
});

Route::get('/settings/', [\App\Http\Controllers\SettingController::class, 'index'])->name('settings');
Route::post('/settings/update/{setting}', [\App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');

Route::get('/api/', [\App\Http\Controllers\ApiController::class, 'index'])->name('api.index');
