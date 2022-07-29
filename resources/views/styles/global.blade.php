<?php
$statsValues = $game->makeRequest($uuid);
if(count($statsValues) == 0) {
    echo trans('stats::messages.error.never-played');
} else {
    ?>
    @foreach ($statss as $stats)
        @if($stats->games_id == $game->id)
            <?php
            $val = $stats->getValue($statsValues);
            ?>
            @switch($stats->style ?? 1)
                @case('1')
                @include('stats::styles._basic')
                @break
                @case('2')
                @include('stats::styles._ratio')
                @break
                @case('3')
                @include('stats::styles._timed')
                @break
                @case('4')
                @include('stats::styles._presuffix')
                @break
            @endswitch
        @endif
    @endforeach
<?php } ?>