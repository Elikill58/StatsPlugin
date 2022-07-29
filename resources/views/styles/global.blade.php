<?php
$statsValues = $game->makeRequest($uuid);
if(count($statsValues) == 0) {
    echo trans('playerstats::messages.error.never-played');
} else {
    ?>
    @foreach ($statss as $stats)
        @if($stats->games_id == $game->id)
            <?php
            $val = $stats->getValue($statsValues);
            ?>
            @switch($stats->style ?? 1)
                @case('1')
                @include('playerstats::styles._basic')
                @break
                @case('2')
                @include('playerstats::styles._ratio')
                @break
                @case('3')
                @include('playerstats::styles._timed')
                @break
                @case('4')
                @include('playerstats::styles._presuffix')
                @break
            @endswitch
        @endif
    @endforeach
<?php } ?>