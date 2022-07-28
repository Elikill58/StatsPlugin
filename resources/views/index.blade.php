@extends('layouts.app')

@section('title', 'Stats')

@push('styles')
    <link href="{{ plugin_asset('stats', 'css/style.css') }} " rel="stylesheet">
@endpush

@section('content')
    <div class="row" id="stats">
        <div class="col-12 py-3">
            @if(app('request')->input('error') != null)
            <div class="card">
                <div class="card-body">
                    <p class="text-warning">{{ trans('stats::messages.error.' . app('request')->input('error')) }}</p>
                </div>
            </div>
            @endif
        </div>
        <div class="col-12">
            <form class="card">
                <div class="card-body">
                    <label class="form-label" for="settingEffect">{{ trans('messages.fields.name') }}</label>
                    <input type="text" class="form-control" id="playername" name="playername" required>
                </div>
                <div class="card-footer">
                    <button type="submit" value="submit request" class="btn btn-primary" onclick="return checkValidation()">
                        {{ trans('messages.actions.continue') }}
                        <span role="status"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function checkValidation() {
            window.location.href = './stats/' + document.getElementById('playername').value;
            return false;
        }
    </script>
@endpush