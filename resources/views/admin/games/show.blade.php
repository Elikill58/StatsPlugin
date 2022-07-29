@extends('admin.layouts.admin')

@section('title', trans('playerstats::admin.game.show'))

@push('styles')
    <link href="{{ plugin_asset('playerstats', 'css/style.css') }} " rel="stylesheet">
@endpush

@push('footer-scripts')
    <script src="{{ asset('vendor/sortablejs/Sortable.min.js') }}"></script>
    <script>
        const sortable = Sortable.create(document.getElementById('stats'), {
            group: {
                name: 'packages',
                put: function (to, sortable, drag) {
                    if (!drag.classList.contains('tag-parent')) {
                        return true;
                    }
                    return !drag.querySelector('.tag-parent .tag-parent')
                        && drag.parentNode.id === 'stats';
                },
            },
            animation: 150,
            handle: '.sortable-handle',
            onEnd: function (event) {
                axios.post("{{ route('playerstats.admin.stats.update-order') }}", {
                    'statss': serialize(sortable.el)
                })
                .then(function (response) {
                    console.log(response)
                })
                .catch(function (error) {
                    console.log(error)
                })
            },
        });
        function serializeTag(game, preventNested = false) {
            return {
                id: game.dataset['statsId'],
            };
        }
        function serialize(stats) {
            return [].slice.call(stats.children).map(function (game) {
                return serializeTag(game);
            });
        }
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3>{{ trans('playerstats::admin.game.index') }}</h3>
                    @include('playerstats::admin.games._form')
                    <a href="{{ route('playerstats.admin.games.edit', $game) }}" type="submit" class="btn btn-primary">
                        <i class="bi bi-save"></i> {{ trans('messages.actions.edit') }}
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3>{{ trans('playerstats::admin.stats.title-list') }}</h3>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ trans('messages.fields.name') }}</th>
                                <th scope="col">{{ trans('messages.fields.game') }}</th>
                                <th scope="col">{{ trans('playerstats::admin.stats.style.index') }}</th>
                                <th scope="col">{{ trans('messages.fields.action') }}</th>
                            </tr>
                            </thead>
                            <tbody class="sortable" id="stats">
                            <?php
                            $statss = $game->stats();
                            ?>
                            @if($statss->count() >= 1)
                                @foreach($statss->get() as $stats)
                                    <tr class="sortable-dropdown tag-parent" data-stats-id="{{ $stats->id }}">
                                        <th scope="row">
                                            <div class="col-1">
                                                <i class="bi bi-arrows-move sortable-handle"></i>
                                            </div>
                                        </th>
                                        <td>{{ $stats->name }}</td>
                                        <td>{{ $stats->gameName() }}</td>
                                        <td>{{ trans('playerstats::admin.stats.style.' . (array(1 => 'basic', 2 => 'ratio', 3 => 'timed', 4 => 'presuffix')[$stats->style])) }}</td>
                                        <td>
                                            <a href="{{ route('playerstats.admin.games.edit', $game) }}" class="mx-1"
                                               title="{{ trans('messages.actions.edit') }}" data-toggle="tooltip"><i
                                                    class="bi bi-pen-fill"></i></a>
                                            <a href="{{ route('playerstats.admin.games.destroy', $game) }}" class="mx-1"
                                               title="{{ trans('messages.actions.delete') }}" data-toggle="tooltip"
                                               data-confirm="delete"><i class="bi bi-trash-fill"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan=4>{{ trans('playerstats::admin.stats.none') }}</td>
                                </tr>
                            @endif
                            </tbody>
                        </table>
                        <a href="{{ route('playerstats.admin.index') }}" type="submit" class="btn btn-primary">
                            <i class="bi bi-pen-fill"></i>{{ trans('messages.actions.create') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer-scripts')
    <script>
        Array.from(document.getElementsByClassName("form-check-input")).forEach((element) => element.setAttribute('onclick', 'return false;'));
        Array.from(document.getElementsByClassName("form-control")).forEach((element) => element.readOnly = true);
    </script>
@endpush
