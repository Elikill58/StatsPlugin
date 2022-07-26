<?php

namespace Azuriom\Plugin\Stats\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Stats\Models\Setting;
use Azuriom\Plugin\Stats\Models\Stats;
use Azuriom\Plugin\Stats\Models\Games;

class StatsHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::first();
        $games = Games::get();
        $statss = Stats::get();
        return view('stats::index', compact('games', 'statss', 'settings'));
    }
}
