<?php

namespace Azuriom\Plugin\Stats\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Stats\Models\Setting;
use Azuriom\Plugin\Stats\Models\Stats;
use Azuriom\Plugin\Stats\Models\Games;

class PlayerStatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uuid)
    {
        $settings = Setting::first();
        $games = Games::get();
        $statss = Stats::orderBy("position", "ASC")->get();
        return view('stats::player', compact('games', 'statss', 'settings', 'uuid'));
    }
}
