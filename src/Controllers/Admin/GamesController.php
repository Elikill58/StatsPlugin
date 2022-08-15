<?php
namespace Azuriom\Plugin\PlayerStats\Controllers\Admin;

use Azuriom\Http\Controllers\Controller;
use Azuriom\Plugin\PlayerStats\Models\Stats;
use Azuriom\Plugin\PlayerStats\Models\Games;
use Azuriom\Plugin\PlayerStats\Requests\GamesRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function import(Request $request) {
        $id = $request->id;
        $game = Games::where("id", "=", $id)->first();
        Stats::where("games_id", $id)->delete();
        $game->configDatabase(); // allow stats_database to be used
        // column key empty to prevent auto increment to be included
        $statsToCreate = array();
        $columns = DB::connection($game->getStatsDatabase())->select("SELECT * FROM information_schema.columns WHERE table_schema = ? AND table_name = ? AND column_key = ''", [ $game->getStatsDatabase(), $game->getStatsTable() ]);
        foreach($columns as $col) {
            $colName = $col->COLUMN_NAME;
            if($colName == "uuid")
                continue;
            Stats::create([
                'name' => ucfirst(strtolower($colName)),
                'settings' => null,
                'style' => 1,
                'stats_column' => $colName,
                'games_id' => $id,
                'position' => $col->ORDINAL_POSITION
            ]);
            /*array_push($statsToCreate, [
                'name' => $col->COLUMN_NAME,
                'settings' => null,
                'style' => 1,
                'stats_column' => $col->COLUMN_NAME,
                'games_id' => $id,
                'position' => $col->ORDINAL_POSITION
            ]);*/
        }
        //Stats::createMany($statsToCreate);
        return redirect()->route('playerstats.admin.games.show', compact('game'))
            ->with('success', trans('playerstats::admin.game.updated'));
    }
}