<?php

namespace Azuriom\Plugin\Stats\Models;


use Azuriom\Models\Traits\Attachable;
use Azuriom\Models\Traits\HasImage;
use Azuriom\Models\Traits\HasTablePrefix;
use Azuriom\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Games extends Model
{

    use Attachable;
    use HasImage;
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
    protected $fillable = ['name', 'description', 'stats_database', 'stats_table', 'stats_unique_col', 'position'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'position' => 'integer'
    ];

    /**
     * Get all of the stats for the game.
     */
    public function stats()
    {
        return Stats::where("games_id", $this->id);
    }

    function isSelected($id)
    {
        return collect($ids)->contains($id) ? 'selected' : '';
    }
}
