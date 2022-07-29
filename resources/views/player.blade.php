@extends('layouts.app')

<?php
$set = $settings->settings()->settings;
config([
    'database.connections.' . $set->database . '.driver' => 'mysql',
    'database.connections.' . $set->database . '.host' => isSet($set->host) ? $set->host : env('DB_HOST', '127.0.0.1'),
    'database.connections.' . $set->database . '.port' => isSet($set->port) ? $set->port : env('DB_PORT', '3306'),
    'database.connections.' . $set->database . '.username' => isSet($set->username) ? $set->username : env('DB_USERNAME', 'root'),
    'database.connections.' . $set->database . '.password' => isSet($set->password) ? $set->password : env('DB_PASSWORD', ''),
    'database.connections.' . $set->database . '.database' => $set->database
]);
$isValidUUID = preg_match('/^\{?[A-Z0-9]{8}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{4}-[A-Z0-9]{12}\}?$/', strtoupper($uuid));
$result = DB::connection($set->database)->select("SELECT * FROM " . $set->table . " WHERE " . ($isValidUUID ? $set->column_uuid : $set->column_name) . " = ?", [$uuid]);
if(isset($result) && count($result) > 0) {
    $dbResult = json_decode(json_encode($result[0]), true);
    $uuid = $dbResult[$set->column_uuid];
    $name = $dbResult[$set->column_name];
} else {
    $name = $uuid;
}
?>

@section('title', trans('stats::messages.title-player', [ 'name' => $name ]))

@if($uuid == null)
    <script>window.location = "{{ route('stats.index') }}?error=not-found";</script>
    <?php exit; ?>
@endif

@push('styles')
    <link href="{{ plugin_asset('stats', 'css/style.css') }} " rel="stylesheet">
@endpush

@section('content')
    <div class="row" id="stats">
        <div class="col-9">
            <div class="row gapped">
                @foreach($games as $game)
                    @if($game->stats()->count() >= 1 && !$game->show_profile)
                        <div class="col-md-3">
                            <div class="card shadow">
                                <div class="card-header rounded text-center text-primary">
                                    <i class="bi bi-controller fs-1 mb-3"></i>

                                    <h2>{{ $game->name }}</h2>
                                    <p>{{ $game->description }}</p>
                                </div>
                                <div class="card-body rounded text-center text-primary">
                                    @include('stats::styles.global')
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @if($games->count() == 0)
                    <div class="alert alert-warning" role="alert">
                        {{ trans('stats::messages.stats-empty') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-3">
            <div class="card shadow">
                <div class="card-header rounded text-center text-primary">
                    <img src="https://crafatar.com/avatars/{{ $uuid }}">
                    <h2>{{ $name }}</h2>
                    <p class="profile-uuid">{{ $uuid }}</p>
                </div>
                @foreach($games as $game)
                    @if($game->show_profile && $game->stats()->count() >= 1)
                        <div class="card-body rounded text-center text-primary">
                            @if($game->name != '' && $game->name != ' ')
                                <h2>{{ $game->name }}</h2>
                                <hr>
                            @endif
                            @include('stats::styles.global')
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
