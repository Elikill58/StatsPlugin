<?php

namespace Azuriom\Plugin\PlayerStats\Controllers;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\PlayerStats\Models\Stats;
use Azuriom\Plugin\PlayerStats\Models\Games;
use Illuminate\Http\Request;

class PlayerStatsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($uuid)
    {
        $games = Games::get();
        $statss = Stats::orderBy("position", "ASC")->get();
        return view('playerstats::player', compact('games', 'statss', 'uuid'));
    }

    public function own(Request $request)
    {
        $games = Games::get();
        $statss = Stats::orderBy("position", "ASC")->get();
        $user = $request->user();
        return view('playerstats::own', compact('games', 'statss', 'user'));
    }
}
