@extends('layouts.app')

@section('title', 'Stats')

@push('styles')
    <link href="{{ plugin_asset('stats', 'css/style.css') }} " rel="stylesheet">
@endpush

@section('content')
    <div class="row mt-5" id="stats">
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
                            @foreach($statss as $stats)
                                @if($stats->games_id == $game->id)
                                    <p>{{ $stats->name }}</p>
                                @endif
                            @endforeach
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
