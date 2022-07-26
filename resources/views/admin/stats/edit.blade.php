@extends('admin.layouts.admin')

@section('title', trans('stats::admin.stats.title-edit') .': '.$stats->name)

@push('footer-scripts')
    <script src="{{ asset('vendor/sortablejs/Sortable.min.js') }}"></script>
    <script>
        const sortable = Sortable.create(document.getElementById('links'), {
            group: {
                name: 'packages',
                put: function (to, sortable, drag) {
                    if (!drag.classList.contains('stats-parent')) {
                        return true;
                    }

                    return !drag.querySelector('.link-parent .link-parent')
                        && drag.parentNode.id === 'links';
                },
            },
            animation: 150,
            handle: '.sortable-handle',
            onEnd: function (event) {
                axios.post('{{ route('stats.admin.links.update-order') }}', {
                    'links': serialize(sortable.el),
                })
                    .then(function (response) {
                        console.log(serialize(sortable.el))
                        console.log(response)
                    })
                    .catch(function (error) {
                        console.log(error)
                    })
            },
        });

        function serializeLink(link, preventNested = false) {
            return {
                id: link.dataset['linkId'],
            };
        }

        function serialize(links) {
            return [].slice.call(links.children).map(function (link) {
                return serializeLink(link);
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


        document.querySelectorAll('.link-remove').forEach(function (el) {
            addLinkListener(el);
        });

        document.getElementById('addLinkButton').addEventListener('click', function () {
            let input = '<div class="row g-0"><div class="col-auto"> <i class="bi bi-arrows-move sortable-handle"></i> </div>';
            input += '<div class="col-md-4">';
            input += '<input type="text" class="form-control" name="link[{index}][icon]" placeholder="{{ trans('messages.fields.icon') }}"></div>';
            input += '<div class="col-md-3"><div class="input-group">';
            input += '<input type="text" class="form-control" name="link[{index}][name]" placeholder="{{ trans('messages.fields.name') }}"></div></div>';
            input += '<div class="col-md-4"><div class="input-group">';
            input += '<input type="text" class="form-control" name="link[{index}][url]" placeholder="{{ trans('messages.fields.url') }}">';
            input += '<div class="input-group-append"><button class="btn btn-outline-danger link-remove" type="button">';
            input += '<i class="bi bi-trash-fill"></i></button></div></div></div></div>';

            const newElement = document.createElement('div');
            newElement.classList.add('link-parent')
            newElement.classList.add('sortable-dropdown')
            newElement.classList.add('link-parent')
            newElement.innerHTML = input;

            addLinkListener(newElement.querySelector('.link-remove'));

            document.getElementById('links').appendChild(newElement);
        });
        function addLinkListener(el) {
            el.addEventListener('click', function () {
                const element = el.parentNode.parentNode.parentNode.parentNode;
                element.parentNode.removeChild(element);
            });
        }

    </script>
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <h3>{{ trans('stats::admin.stats.title-edit') }}</h3>
            <form action="{{ route('stats.admin.stats.update',$stats)}}" method="POST" id="statsForm" enctype="multipart/form-data">
                @method('PUT')

                @include('admin.elements.editor', ['imagesUploadUrl' => route('admin.posts.attachments.store', $stats)])

                @include('stats::admin.stats._form')


                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
                </button>

                <a href="{{ route('stats.admin.stats.destroy', $stats) }}" class="btn btn-danger  float-right" data-confirm="delete">
                    <i class="bi bi-trash-fill"></i> {{ trans('messages.actions.delete') }}
                </a>

                <a href="{{ route('stats.admin.index') }}" class="btn btn-success float-right mr-3">
                    <i class="bi bi-arrow-left"></i> {{ trans('messages.actions.back') }}
                </a>
            </form>
        </div>
    </div>
@endsection
