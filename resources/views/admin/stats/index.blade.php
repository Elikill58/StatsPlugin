@extends('admin.layouts.admin')

@section('title', trans('stats::admin.title'))

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
                axios.post('{{ route('stats.admin.stats.update-order') }}', {
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

        document.getElementById('statsForm').addEventListener('submit', function () {
            let i = 0;
            document.getElementById('links').querySelectorAll('.link-parent').forEach(function (el) {
                el.querySelectorAll('input').forEach(function (input) {
                    input.name = input.name.replace('{index}', i.toString());
                });
                i++;
            });
        });

        function addLinkListener(el) {
            el.addEventListener('click', function () {
                const element = el.parentNode.parentNode.parentNode.parentNode;

                element.parentNode.removeChild(element);
            });
        }

        document.querySelectorAll('.link-remove').forEach(function (el) {
            addLinkListener(el);
        });

        document.getElementById('addLinkButton').addEventListener('click', function () {
            let input = '<div class="row g-0"><div class="col-md-4">';
            input += '<input type="text" class="form-control" name="link[{index}][icon]" placeholder="{{ trans('messages.fields.icon') }}"></div>';
            input += '<div class="col-md-4"><div class="input-group">';
            input += '<input type="text" class="form-control" name="link[{index}][name]" placeholder="{{ trans('messages.fields.name') }}"></div></div>';
            input += '<div class="col-md-4"><div class="input-group">';
            input += '<input type="text" class="form-control" name="link[{index}][url]" placeholder="{{ trans('messages.fields.url') }}">';
            input += '<div class="input-group-append"><button class="btn btn-outline-danger link-remove" type="button">';
            input += '<i class="bi bi-trash-fill"></i></button></div></div></div></div></div>';

            const newElement = document.createElement('div');
            newElement.classList.add('link-parent')
            newElement.classList.add('sortable-dropdown')
            newElement.classList.add('link-parent')
            newElement.innerHTML = input;

            addLinkListener(newElement.querySelector('.link-remove'));

            document.getElementById('links').appendChild(newElement);
        });

    </script>
@endpush

@section('content')
    <div class="row">
        <div class="col-12 my-3">
            @include('stats::admin.settings.index')
        </div>
        <div class="col-xl-6 my-3">
            <div class="card shadow mb-4">
                <div class="card-body">
                    <h3>{{ trans('stats::admin.stats.title') }}</h3>
                    <form action="{{ route('stats.admin.stats.store') }}" method="POST" id="statsForm"  enctype="multipart/form-data">
                        <input type="hidden" name="pending_id" value="{{ $pendingId }}">

                        @include('admin.elements.editor', ['imagesUploadUrl' => route('admin.posts.attachments.pending', $pendingId)])

                        @include('stats::admin.stats._form')

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
                    <h3>{{ trans('stats::admin.stats.title-list') }}</h3>
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
                                    <td>{{ dump($stats) }}</td>
                                    <td>
                                        <a href="{{ route('stats.admin.stats.edit', $stats) }}" class="mx-1"
                                           title="{{ trans('messages.actions.edit') }}" data-toggle="tooltip"><i
                                                class="bi bi-pen-fill"></i></a>
                                        <a href="{{ route('stats.admin.stats.destroy', $stats) }}" class="mx-1"
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
