@extends('admin.layouts.admin')

@section('title', trans('playerstats::admin.game.title'))

@push('styles')
    <link href="{{ plugin_asset('playerstats', 'css/style.css') }} " rel="stylesheet">
@endpush

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('playerstats.admin.games.store') }}" method="POST">
                        <h3>{{ trans('playerstats::admin.game.title') }}</h3>
                        @include('playerstats::admin.games._form')
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3>{{ trans('playerstats::admin.game.title-list') }}</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ trans('messages.fields.name') }}</th>
                                <th scope="col">{{ trans('messages.fields.action') }}</th>
                            </tr>
                            </thead>
                            <tbody class="sortable" id="games">
                            @forelse($games ?? [] as $game)
                                <tr class="sortable-dropdown tag-parent" data-game-id="{{ $game->id }}">
                                    <th scope="row">
                                        <div class="col-1">
                                            <i class="bi bi-arrows-move sortable-handle"></i>
                                        </div>
                                    </th>
                                    <td>
                                        <div class="badge" style="background-color: {{$game->color}}; color: white">{{$game->name}}</div>
                                    </td>
                                    <td>
                                        <a href="{{ route('playerstats.admin.games.show', $game) }}" class="mx-1"
                                           title="{{ trans('messages.actions.show') }}" data-toggle="tooltip"><i
                                                class="bi bi-eye-fill"></i></a>
                                        <a href="{{ route('playerstats.admin.games.edit', $game) }}" class="mx-1"
                                           title="{{ trans('messages.actions.edit') }}" data-toggle="tooltip"><i
                                                class="bi bi-pen-fill"></i></a>
                                        <a href="{{ route('playerstats.admin.games.destroy', $game) }}" class="mx-1"
                                           title="{{ trans('messages.actions.delete') }}" data-toggle="tooltip"
                                           data-confirm="delete"><i class="bi bi-trash-fill"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>Vous n'avez pas de jeux</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection