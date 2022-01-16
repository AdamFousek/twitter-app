<?php declare(strict_types=1);

use App\Http\Controllers\ApiController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\SettingController;
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

Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/tweets', [IndexController::class, 'tweets'])->name('tweets');

Route::get('/settings/', [SettingController::class, 'index'])->name('settings');
Route::post('/settings/update/{setting}', [SettingController::class, 'update'])->name('settings.update');

Route::get('/api/', [ApiController::class, 'index'])->name('api.index');
