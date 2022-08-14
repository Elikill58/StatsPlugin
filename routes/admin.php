<?php

use Azuriom\Plugin\PlayerStats\Controllers\Admin\AdminController;
use Azuriom\Plugin\PlayerStats\Controllers\Admin\SettingController;
use Azuriom\Plugin\PlayerStats\Controllers\Admin\GamesController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your plugin. These
| routes are loaded by the RouteServiceProvider of your plugin within
| a group which contains the "web" middleware group and your plugin name
| as prefix. Now create something great!
|
*/

Route::middleware('can:playerstats.admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::resource('stats', AdminController::class)->except('index');
    Route::post('stats/update-order', [AdminController::class, 'updateOrder'])->name('stats.update-order');

    Route::resource('games', GamesController::class);

    Route::post('setting', [SettingController::class, 'save'])->name('setting.update');
});
