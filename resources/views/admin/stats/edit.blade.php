@extends('admin.layouts.admin')

@section('title', trans('playerstats::admin.stats.title-edit', ['name' => $playerstat->name]))

@push('footer-scripts')
    <script src="{{ asset('vendor/sortablejs/Sortable.min.js') }}"></script>
@endpush
@push('styles')
    <link href="{{ plugin_asset('playerstats', 'css/style.css') }} " rel="stylesheet">
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <h3>{{ trans('playerstats::admin.stats.title-edit', ['name' => $playerstat->name]) }}</h3>
            <form action="{{ route('playerstats.admin.playerstats.update', $playerstat) }}" method="POST" id="statsForm" enctype="multipart/form-data">
                @method('PUT')

                @include('playerstats::admin.stats._form')


                <button type="submit" class="btn btn-success">
                    <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
                </button>

                <a href="{{ route('playerstats.admin.playerstats.destroy', $playerstat) }}" class="btn btn-danger  float-right" data-confirm="delete">
                    <i class="bi bi-trash-fill"></i> {{ trans('messages.actions.delete') }}
                </a>

                <a href="{{ route('playerstats.admin.games.index') }}" class="btn btn-primary float-right mr-3">
                    <i class="bi bi-arrow-left"></i> {{ trans('messages.actions.back') }}
                </a>
            </form>
        </div>
    </div>
@endsection
