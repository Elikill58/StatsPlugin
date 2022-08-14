<?php

namespace Azuriom\Plugin\PlayerStats\Models;

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
    protected $prefix = 'playerstats_';

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

    public function toVisualTime($val) {
        $SECONDS = 1;
        $MINUTES = $SECONDS * 60;
        $HOURS = $MINUTES * 60;
        $DAYS = $HOURS * 24;
        $MONTHS = $DAYS * 30;
        $YEARS = $MONTHS * 12;
        $oldVal = $val;
        $val = $this->convertToSeconds($val);
        $time = "";

        foreach (array($YEARS => 'year', $MONTHS => 'month', $DAYS => 'day', $HOURS => 'hour', $MINUTES => 'minute', $SECONDS => 'second') as $timeValue => $timeKey) {
            if($val >= $timeValue) {
                $trad = trans('playerstats::messages.timed.' . $timeKey);
                $reduced = 0;
                while($val >= $timeValue) {
                    $val -= $timeValue;
                    $reduced++;
                }
                if($trad != '')
                    $time = ($time == '' ? '' : $time . ' ') . $reduced . $trad;
            }
        }
        return $time;
    }

    public function convertToSeconds($val) {
        $from = $this->settings['timed_from'] ?? 'second';
        if($from == "millisecond")
            return $val / 1000;

        $SECONDS = 1;
        $MINUTES = $SECONDS * 60;
        $HOURS = $MINUTES * 60;
        $DAYS = $HOURS * 24;
        $MONTHS = $DAYS * 30;
        $YEARS = $MONTHS * 12;

        foreach (array($YEARS => 'year', $MONTHS => 'month', $DAYS => 'day', $HOURS => 'hour', $MINUTES => 'minute', $SECONDS => 'second') as $timeValue => $timeKey) {
            if ($from == $timeKey)
                return $val * $timeValue;
        }
        return $val;
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
