<?php

namespace Azuriom\Plugin\PlayerStats\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\PlayerStats\Models\Stats;
use Azuriom\Plugin\PlayerStats\Models\Games;

class StatsHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Games::get();
        $statss = Stats::get();
        return view('playerstats::index', compact('games', 'statss'));
    }
}
