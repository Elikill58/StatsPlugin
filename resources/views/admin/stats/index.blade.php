@extends('admin.layouts.admin')

@section('title', trans('playerstats::admin.title'))

@push('styles')
    <link href="{{ plugin_asset('playerstats', 'css/style.css') }} " rel="stylesheet">
@endpush

@push('footer-scripts')
    <script src="{{ asset('vendor/sortablejs/Sortable.min.js') }}"></script>
    <script>
        const sortable = Sortable.create(document.getElementById('statss'), {
            group: {
                name: 'packages',
                put: function (to, sortable, drag) {
                    if (!drag.classList.contains('stats-parent')) {
                        return true;
                    }

                    return !drag.querySelector('.stats-parent .stats-parent')
                        && drag.parentNode.id === 'statss';
                },
            },
            animation: 150,
            handle: '.sortable-handle',
            onEnd: function (event) {
                axios.post('{{ route('playerstats.admin.stats.update-order') }}', {
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

        function serializeStats(stats, preventNested = false) {

            return {
                id: stats.dataset['statsId'],
            };
        }

        function serialize(statss) {
            return [].slice.call(statss.children).map(function (stats) {
                return serializeStats(stats);
            });
        }
    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-12 my-3">
            @include('playerstats::admin.settings.index')
        </div>
        <div class="col-xl-6 my-3">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3>{{ trans('playerstats::admin.stats.title') }}</h3>
                    <form action="{{ route('playerstats.admin.stats.store') }}" method="POST" id="statsForm"  enctype="multipart/form-data">
                        <input type="hidden" name="pending_id" value="{{ $pendingId }}">

                        @include('admin.elements.editor', ['imagesUploadUrl' => route('admin.posts.attachments.pending', $pendingId)])

                        @include('playerstats::admin.stats._form')

                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-xl-6 my-3">
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
                                <th scope="col">{{ trans('messages.fields.action') }}</th>
                            </tr>
                            </thead>
                            <tbody class="sortable" id="statss">
                            @forelse($statss ?? [] as $stats)
                                <tr class="sortable-dropdown stats-parent" data-stats-id="{{ $stats->id }}">
                                    <th scope="row">
                                        <div class="col-1">
                                            <i class="bi bi-arrows-move sortable-handle"></i>
                                        </div>
                                    </th>
                                    <td>{{$stats->name}}</td>
                                    <td>{{ $stats->gameName() }}</td>
                                    <td>
                                        <a href="{{ route('playerstats.admin.stats.edit', $stats) }}" class="mx-1"
                                           title="{{ trans('messages.actions.edit') }}" data-toggle="tooltip"><i
                                                class="bi bi-pen-fill"></i></a>
                                        <a href="{{ route('playerstats.admin.stats.destroy', $stats) }}" class="mx-1"
                                           title="{{ trans('messages.actions.delete') }}" data-toggle="tooltip"
                                           data-confirm="delete"><i class="bi bi-trash-fill"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td>Vous n'avez crée aucune stats</td>
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
