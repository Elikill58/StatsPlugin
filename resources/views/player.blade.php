@extends('layouts.app')

@section('title', 'Stats')

<?php
if (!is_string($uuid) || (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $uuid) !== 1)) {
    config([
        'database.connections.' . $settings->settings()->settings->database . '.driver' => 'mysql',
        'database.connections.' . $settings->settings()->settings->database . '.host' => isSet($settings->settings()->settings->host) ? $settings->settings()->settings->host : env('DB_HOST', '127.0.0.1'),
        'database.connections.' . $settings->settings()->settings->database . '.port' => isSet($settings->settings()->settings->port) ? $settings->settings()->settings->port : env('DB_PORT', '3306'),
        'database.connections.' . $settings->settings()->settings->database . '.username' => isSet($settings->settings()->settings->username) ? $settings->settings()->settings->username : env('DB_USERNAME', 'root'),
        'database.connections.' . $settings->settings()->settings->database . '.password' => isSet($settings->settings()->settings->password) ? $settings->settings()->settings->password : env('DB_PASSWORD', ''),
        'database.connections.' . $settings->settings()->settings->database . '.database' => $settings->settings()->settings->database
    ]);
    $result = DB::connection($settings->settings()->settings->database)->select("SELECT * FROM " . $settings->settings()->settings->table . " WHERE " . $settings->settings()->settings->column_name . " = ?", [$uuid]);
    $uuid = isset($result) && count($result) > 0 ? json_decode(json_encode($result[0]), true)[$settings->settings()->settings->column_uuid] : $uuid;
}
?>

@if($uuid == "test")
    <script>window.location = "{{ route('stats.index') }}?error=not-found";</script>
    <?php exit; ?>
@endif

@push('styles')
    <link href="{{ plugin_asset('stats', 'css/style.css') }} " rel="stylesheet">
@endpush

@section('content')
    <div class="row" id="stats">
        @foreach($games as $game)
            @if($game->stats()->count() >= 1)
                <div class="col-md-3">
                    <div class="card shadow">
                        <div class="card-header rounded text-center text-primary">
                            <i class="bi bi-controller fs-1 mb-3"></i>

                            <h2>{{ $game->name }}</h2>
                            <p>{{ $game->description }}</p>
                        </div>
                        <div class="card-body rounded text-center text-primary">
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
                                        @endswitch
                                    @endif
                                @endforeach
                            <?php } ?>
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
@endsection
