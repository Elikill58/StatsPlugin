@extends('admin.layouts.admin')

@section('title', trans('playerstats::admin.title'))

@push('styles')
    <link href="{{ plugin_asset('playerstats', 'css/style.css') }} " rel="stylesheet">
@endpush

@section('content')
    <div class="card shadow mb-4">
        <div class="card-body">
            <h3>{{ trans('admin.nav.settings.settings') }}</h3>
            <form action="{{ route('playerstats.admin.setting.update') }}" method="POST">
                @include('playerstats::admin.settings._form')
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
                </button>
            </form>
        </div>
    </div>
@endsection