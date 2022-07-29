<?php
namespace Azuriom\Plugin\Stats\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\Stats\Models\Stats;
use Azuriom\Plugin\Stats\Models\Games;
use Azuriom\Plugin\Stats\Requests\GamesRequest;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $games = Games::orderBy('position')->get();
        return view('playerstats::admin.games.index', compact('games'));
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
            'games' => ['required', 'array'],
        ]);

        $games = $request->input('games');

        $gamePosition = 1;

        foreach ($games as $game) {
            $id = $game['id'];
            Games::whereKey($id)->update([
                'position' => $gamePosition++,
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Games $game)
    {
        return view('playerstats::admin.games.show', compact('game'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Azuriom\Plugin\Stats\Requests\GamesRequest $gameRequest
     *
     * @return \Illuminate\Http\Response
     */
    public function store(GamesRequest $gameRequest)
    {
        Games::create($gameRequest->validated());

        return redirect()->route('playerstats.admin.games.index')
            ->with('success', trans('playerstats::admin.game.created'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Games $game)
    {
        return view('playerstats::admin.games.edit', compact('game'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(GamesRequest $request, Games $game)
    {
        $game->update($request->validated());
        return redirect()->route('playerstats.admin.games.index')
            ->with('success', trans('playerstats::admin.game.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \Azuriom\Plugin\Stats\Models\Games $game
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Exception
     */
    public function destroy(Games $game)
    {
        $statss = Stats::where("games_id", $game->id)->get();
        foreach ($statss as $stats) {
            $stats->delete();
        }
        $game->delete();

        return redirect()->route('playerstats.admin.games.index')
            ->with('success', trans('playerstats::admin.game.deleted'));
    }
}