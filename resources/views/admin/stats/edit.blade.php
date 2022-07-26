@extends('admin.layouts.admin')

@section('title', trans('stats::admin.stats.title-edit') .': '.$stats->name)

@push('footer-scripts')
    <script src="{{ asset('vendor/sortablejs/Sortable.min.js') }}"></script>
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <h3>{{ trans('stats::admin.stats.title-edit') }}</h3>
            <form action="{{ route('stats.admin.stats.update', $stats)}}" method="POST" id="statsForm" enctype="multipart/form-data">
                @method('PUT')

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
