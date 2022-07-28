<?php

namespace Azuriom\Plugin\Stats\Models;

use Azuriom\Models\Traits\Attachable;
use Azuriom\Models\Traits\HasTablePrefix;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Stats extends Model
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
    protected $fillable = ['name', 'settings', 'style', 'stats_column', 'games_id', 'position'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'position' => 'integer',
        'settings' => 'array',
    ];

    /**
     * Get the game that owns the stats.
     */
    public function game()
    {
        return Games::where('id', $this->games_id)->first();
    }

    /**
     * Get the name of game that owns the stats.
     */
    public function gameName()
    {
        $g = Games::where('id', $this->games_id)->first();
        return $g ? $g->name : "-";
    }

    public function getValue($sql)
    {
        if(isset($sql[$this->stats_column])) {
            return $sql[$this->stats_column];
        }
        return "?";
    }

    public function setSettingsAttribute($array)
    {
        $this->attributes['settings'] = json_encode($array);
    }

    function isSelected($id)
    {
        if(!isset($ids)) {
            return '';
        }
        return collect($ids)->contains($id) ? 'selected' : '';
    }
}
