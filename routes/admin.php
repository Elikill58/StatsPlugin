<?php

use Azuriom\Plugin\Stats\Controllers\Admin\AdminController;
use Azuriom\Plugin\Stats\Controllers\Admin\LinkController;
use Azuriom\Plugin\Stats\Controllers\Admin\SettingController;
use Azuriom\Plugin\Stats\Controllers\Admin\GamesController;
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

Route::middleware('can:stats.admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');

    Route::resource('stats', AdminController::class)->except('index');
    Route::post('stats/update-order', [AdminController::class, 'updateOrder'])->name('stats.update-order');

    Route::resource('games', GamesController::class);
    Route::post('games/update-order', [GamesController::class, 'updateOrder'])->name('games.update-order');

    Route::resource('settings', SettingController::class)->only('update');

    Route::resource('links', LinkController::class)->only('destroy');
    Route::post('links/update-order', [LinkController::class, 'updateOrder'])->name('links.update-order');
});
