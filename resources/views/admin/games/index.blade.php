@extends('admin.layouts.admin')

@section('title', trans('playerstats::admin.game.title'))

@push('styles')
    <link href="{{ plugin_asset('playerstats', 'css/style.css') }} " rel="stylesheet">
@endpush

@push('footer-scripts')
    <script src="{{ asset('vendor/sortablejs/Sortable.min.js') }}"></script>
    <script>
        const sortable = Sortable.create(document.getElementById('games'), {
            group: {
                name: 'packages',
                put: function (to, sortable, drag) {
                    if (!drag.classList.contains('tag-parent')) {
                        return true;
                    }

                    return !drag.querySelector('.tag-parent .tag-parent')
                        && drag.parentNode.id === 'games';
                },
            },
            animation: 150,
            handle: '.sortable-handle',
            onEnd: function (event) {
                axios.post('{{ route('playerstats.admin.games.update-order') }}', {
                    'games': serialize(sortable.el)
                })
                    .then(function (response) {
                        console.log(response)
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            },
        });

        function serializeStats(game, preventNested = false) {
            return {
                id: game.dataset['gameId'],
            };
        }

        function serialize(games) {
            return [].slice.call(games.children).map(function (game) {
                return serializeStats(game);
            });
        }
    </script>
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
                                        {{$game->name}}
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