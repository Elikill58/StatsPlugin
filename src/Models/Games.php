<?php

namespace Azuriom\Plugin\PlayerStats\Models;

use Azuriom\Models\Traits\Attachable;
use Azuriom\Models\Traits\HasTablePrefix;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Games extends Model
{

    use Attachable;
    use HasTablePrefix;

    /**
     * The table prefix associated with the model.
     *
     * @var string
     */
    protected $prefix = 'playerstats_';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'show_profile', 'stats_own_database', 'stats_host', 'stats_port', 'stats_username', 'stats_password', 'stats_database', 'stats_table', 'stats_unique_col', 'position'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'show_profile' => 'boolean',
        'stats_own_database' => 'boolean',
        'position' => 'integer'
    ];

    /**
     * Get all of the stats for the game.
     */
    public function stats() {
        return Stats::where("games_id", $this->id)->orderBy('position', 'ASC');
    }

    public function isSelected($id) {
        return collect($ids)->contains($id) ? 'selected' : '';
    }

    public function isSet($smt) {
        return isset($smt) && $smt != null && $smt != '';
    }

    public function getGlobal($key) {
        return setting('playerstats.' . $key) ? setting('playerstats.' . $key) : config("database.connections." . config("database.default") . "." . $key);
    }

    public function getStatsHost() {
        return ($this->stats_own_database ? $this->stats_host : null) ?? $this->getGlobal("host");
    }

    public function getStatsPort() {
        return ($this->stats_own_database ? $this->stats_port : null) ?? $this->getGlobal("port");
    }

    public function getStatsUsername() {
        return ($this->stats_own_database ? $this->stats_username : null) ?? $this->getGlobal("username");
    }

    public function getStatsPassword() {
        return ($this->stats_own_database ? $this->stats_password : null) ?? $this->getGlobal("password");
    }

    public function getStatsDatabase() {
        return $this->stats_database ?? $this->getGlobal("database");
    }

    public function getStatsTable() {
        return $this->stats_table;
    }

    public function configDatabase() {
        $database = $this->getStatsDatabase();
        $dbType = config("database.default");
        config([
            'database.connections.' . $database . '.driver' => $dbType,
            'database.connections.' . $database . '.host' => $this->getStatsHost(),
            'database.connections.' . $database . '.port' => $this->getStatsPort(),
            'database.connections.' . $database . '.username' => $this->getStatsUsername(),
            'database.connections.' . $database . '.password' => $this->getStatsPassword(),
            'database.connections.' . $database . '.database' => $database
        ]);
    }

    public function makeRequest($uuid) {
        $this->configDatabase();
        $result = DB::connection($this->getStatsDatabase())->select("SELECT * FROM " . $this->stats_table . " WHERE " . $this->stats_unique_col . " = ? OR " . $this->stats_unique_col . " = ?", [$uuid, str_replace("-", "", $uuid)]);
        return isset($result) && count($result) > 0 ? json_decode(json_encode($result[0]), true) : $result;
    }
}
