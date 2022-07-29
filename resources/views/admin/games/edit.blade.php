@extends('admin.layouts.admin')

@section('title', trans('playerstats::admin.game.title-edit') .' : '.$game->name)

@push('styles')
    <link href="{{ plugin_asset('playerstats', 'css/style.css') }} " rel="stylesheet">
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <h3>{{ trans('playerstats::admin.game.title-edit') }}</h3>
            <form action="{{ route('playerstats.admin.games.update',$game)}}" method="POST" id="statsForm">
                @include('playerstats::admin.games._form')
                @method('PUT')

                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
                </button>

                <a href="{{ route('playerstats.admin.games.destroy', $game) }}" class="btn btn-danger" data-confirm="delete">
                    <i class="bi bi-trash-fill"></i> {{ trans('messages.actions.delete') }}
                </a>
            </form>
        </div>
    </div>
@endsection