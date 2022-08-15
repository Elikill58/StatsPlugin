<?php

namespace Azuriom\Plugin\PlayerStats\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\PlayerStats\Models\Stats;
use Azuriom\Plugin\PlayerStats\Models\Games;
use Azuriom\Plugin\PlayerStats\Requests\StatsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class StatsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Games::orderBy('position')->get();
        $statss = Stats::orderBy('position')->get();
        $pendingId = old('pending_id', Str::uuid());
        return view('playerstats::admin.stats.index', compact('games', 'statss', 'pendingId'));
    }


    /**
     * Update the order of the resources.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateOrder(Request $request)
    {
        $this->validate($request, [
            'statss' => ['required', 'array'],
        ]);

        $statss = $request->input('statss');

        $statsPosition = 1;
        $tmp = "";

        foreach ($statss as $stats) {
            $id = $stats['id'];
            $tmp = $tmp . " " . $id . " > " . $statsPosition . ",";
            Stats::whereKey($id)->update([
                'position' => $statsPosition++,
            ]);
        }
        return $tmp;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Azuriom\Plugin\PlayerStats\Requests\StatsRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StatsRequest $request)
    {
        $stats = Stats::create($request->validated());

        return redirect()->route('stats.admin.index')
            ->with('success', trans('stats::admin.stats.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \Azuriom\Plugin\Stats\Models\Stats $stats
     */
    public function edit(Stats $stat)
    {
        $games = Games::orderBy('position')->get();
        return view('playerstats::admin.stats.edit', [
            'stats' => $stat,
            'games' => $games
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Azuriom\Plugin\Stats\Requests\StatsRequest $request
     * @param \Azuriom\Plugin\Stats\Models\Stats          $category
     *
     * @return \Illuminate\Http\Response
     */
    public function update(StatsRequest $request, Stats $stat)
    {
        $input = [
            'linked' => $request->input('linked'),
            'timed_from' => $request->input('timed_from'),
            'prefix' => $request->input('prefix'),
            'suffix' => $request->input('suffix'),
        ];

        $stat->settings = $input;
        $stat->update($request->validated());

        return redirect()->route('playerstats.admin.index')
            ->with('success', trans('playerstats::admin.stats.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Azuriom\Plugin\Stats\Models\Stats $stats
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Stats $stat)
    {
        $stat->delete();

        return redirect()->route('playerstats.admin.index')
            ->with('success', trans('playerstats::admin.stats.deleted'));
    }
}
