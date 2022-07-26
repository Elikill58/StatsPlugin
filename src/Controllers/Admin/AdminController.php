<?php

namespace Azuriom\Plugin\Stats\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Stats\Models\Setting;
use Azuriom\Plugin\Stats\Models\Stats;
use Azuriom\Plugin\Stats\Models\Games;
use Azuriom\Plugin\Stats\Requests\StatsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class AdminController extends Controller
{

    /**
     * The storage path for uploaded images.
     *
     * @var string
     */
    protected $imagesPath = 'stats';

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Games::orderBy('position')->get();
        $statss = Stats::orderBy('position')->get();
        $setting = Setting::first();
        $pendingId = old('pending_id', Str::uuid());
        return view('stats::admin.stats.index', compact('games', 'statss', 'pendingId', 'setting'));
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

        foreach ($statss as $stats) {
            $id = $stats['id'];
            Stats::whereKey($id)->update([
                'position' => $statsPosition++,
            ]);
        }
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
     * @param \Azuriom\Plugin\stats\Requests\StatsRequest $request
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
    public function edit(Stats $stats)
    {
        return view('stats::admin.stats.edit', [
            'stats' => $stats,
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
    public function update(StatsRequest $request, Stats $stats)
    {

        $stats->update($request->validated());

        return redirect()->route('stats.admin.index')
            ->with('success', trans('stats::admin.stats.updated'));
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
    public function destroy(Stats $stats)
    {
        dump($stats);
        dd("??");
        $stats->delete();

        return redirect()->route('stats.admin.index')
            ->with('success', trans('stats::admin.stats.deleted'));
    }
}
