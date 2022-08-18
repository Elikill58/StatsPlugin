@extends('layouts.app')

<?php
$database = setting('playerstats.database');
$dbType = config("database.default");
config([
    'database.connections.' . $database . '.driver' => $dbType,
    'database.connections.' . $database . '.host' => setting('playerstats.host') ? setting('playerstats.host') : config("database.connections." . $dbType . ".host"),
    'database.connections.' . $database . '.port' => setting('playerstats.port') ? setting('playerstats.port') : config("database.connections." . $dbType . ".port"),
    'database.connections.' . $database . '.username' => setting('playerstats.username') ? setting('playerstats.username') : config("database.connections." . $dbType . ".username"),
    'database.connections.' . $database . '.password' => setting('playerstats.password') ? setting('playerstats.password') : config("database.connections." . $dbType . ".password"),
    'database.connections.' . $database . '.database' => $database
]);
$result = null;
if(preg_match('/^\{?[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}\}?$/', strtoupper($uuid)) || preg_match('/^\{?[A-Z0-9]{32}\}?$/', strtoupper($uuid))) { // valid UUID or cropped one
    $result = DB::connection($database)->select("SELECT * FROM " . setting("playerstats.table") . " WHERE " . setting("playerstats.column_uuid") . " = ?", [$uuid]);
} else {
    $result = DB::connection($database)->select("SELECT * FROM " . setting("playerstats.table") . " WHERE " . setting("playerstats.column_name") . " = ?", [$uuid]);
}
if(isset($result) && count($result) > 0) {
    $dbResult = json_decode(json_encode($result[0]), true);
    $uuid = $dbResult[setting("playerstats.column_uuid")];
    $name = $dbResult[setting("playerstats.column_name")];
} else {
    $name = $uuid;
}
?>

@section('title', trans('playerstats::messages.title-player', [ 'name' => $name ]))

@if($uuid == null)
    <script>window.location = "{{ route('playerstats.index') }}?error=not-found";</script>
    <?php exit; ?>
@endif

@push('styles')
    <link href="{{ plugin_asset('playerstats', 'css/style.css') }} " rel="stylesheet">
@endpush

@section('content')
    <div class="row" id="stats">
        <div class="col-9">
            <div class="row padding-right">
                @foreach($games as $game)
                    @if($game->stats()->count() >= 1 && !$game->show_profile)
                        <div class="col-md-4 no-padding-right padding-bottom">
                            <div class="card shadow full-height">
                                <div class="card-header rounded text-center text-primary">
                                    <i class="bi bi-controller fs-1 mb-4"></i>

                                    <h2>{{ $game->name }}</h2>
                                    <p>{{ $game->description }}</p>
                                </div>
                                <div class="card-body rounded text-center text-primary">
                                    @include('playerstats::styles.global')
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @if($games->count() == 0)
                    <div class="alert alert-warning" role="alert">
                        {{ trans('playerstats::messages.stats-empty') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-3 padding-right padding-bottom">
            <div class="card shadow full-height">
                <div class="card-header rounded text-center text-primary">
                    <img src="{{ str_replace(':UUID:', $uuid, setting('playerstats.site_head') ?? 'https://mc-heads.net/avatar/:UUID:') }}">
                    <h2>{{ $name }}</h2>
                </div>
                @foreach($games as $game)
                    @if($game->show_profile && $game->stats()->count() >= 1)
                        <div class="card-body rounded text-center text-primary">
                            @if($game->name != '' && $game->name != ' ')
                                <h2>{{ $game->name }}</h2>
                                <hr>
                            @endif
                            @include('playerstats::styles.global')
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
