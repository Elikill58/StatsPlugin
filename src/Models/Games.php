<?php

namespace Azuriom\Plugin\Stats\Models;

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
    protected $prefix = 'stats_';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description', 'show_profile', 'stats_host', 'stats_port', 'stats_username', 'stats_password', 'stats_database', 'stats_table', 'stats_unique_col', 'position'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'show_profile' => 'boolean',
        'position' => 'integer'
    ];

    /**
     * Get all of the stats for the game.
     */
    public function stats()
    {
        return Stats::where("games_id", $this->id)->orderBy('position', 'ASC');
    }

    public function isSelected($id)
    {
        return collect($ids)->contains($id) ? 'selected' : '';
    }

    function isSet($smt) {
        return isset($smt) && $smt != null && $smt != '';
    }

    public function makeRequest($uuid) {
        config([
            'database.connections.' . $this->stats_database . '.driver' => 'mysql',
            'database.connections.' . $this->stats_database . '.host' => isSet($this->stats_host) ? $this->stats_host : env('DB_HOST', '127.0.0.1'),
            'database.connections.' . $this->stats_database . '.port' => isSet($this->stats_port) ? $this->stats_port : env('DB_PORT', '3306'),
            'database.connections.' . $this->stats_database . '.username' => isSet($this->stats_username) ? $this->stats_username : env('DB_USERNAME', 'root'),
            'database.connections.' . $this->stats_database . '.password' => isSet($this->stats_password) ? $this->stats_password : env('DB_PASSWORD', ''),
            'database.connections.' . $this->stats_database . '.database' => $this->stats_database
        ]);
        $result = DB::connection($this->stats_database)->select("SELECT * FROM " . $this->stats_table . " WHERE " . $this->stats_unique_col . " = ?", [$uuid]);
        return isset($result) && count($result) > 0 ? json_decode(json_encode($result[0]), true) : $result;
    }
}
