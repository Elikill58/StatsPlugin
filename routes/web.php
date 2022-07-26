<?php

use Azuriom\Plugin\Stats\Controllers\StatsHomeController;
use Azuriom\Plugin\Stats\Controllers\PlayerStatsController;
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

Route::get('/', [StatsHomeController::class, 'index'])->name('index');
Route::get('/{uuid?}', [PlayerStatsController::class, 'index'])->name('index');
