@push('styles')
    <link href="{{ plugin_asset('playerstats', 'css/style.css') }} " rel="stylesheet">
@endpush

@section('content')
    <div class="row" id="stats">
        @if(app('request')->input('error') != null)
            <div class="col-12 py-3">
                <div class="card">
                    <div class="card-body">
                        <p class="text-warning">{{ trans('playerstats::messages.error.' . app('request')->input('error')) }}</p>
                    </div>
                </div>
            </div>
        @endif
        <div class="col-12 padding-bottom">
            <div class="card">
                <div class="card-body rounded" style="display: flex;">
                    <label class="form-label" for="settingEffect" style="margin: auto;">{{ trans('messages.fields.name') }}</label>
                    <input type="text" class="form-control mx-3" id="playername" name="playername" required>
                    <a type="submit" value="submit request" class="btn btn-primary text-end" onclick="return checkValidation(document.getElementById('playername').value)">
                        {{ trans('messages.actions.continue') }}
                        <span role="status"></span>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-9">
            <div class="row padding-right">
                @foreach($games as $game)
                    @if($game->stats()->count() >= 1 && !$game->show_profile)
                        <div class="col-md-4 no-padding-right padding-bottom">
                            <div class="card shadow full-height">
                                <div class="card-header rounded text-center text-primary">
                                    <i class="bi bi-controller fs-1 mb-4"></i>

                                    <h2>{{ $game->name }}</h2>
                                    <p>{{ $game->description }}</p>
                                </div>
                                <div class="card-body rounded text-center text-primary">
                                    @include('playerstats::styles.global')
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                @if($games->count() == 0)
                    <div class="alert alert-warning" role="alert">
                        {{ trans('playerstats::messages.stats-empty') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="col-3 padding-right padding-bottom">
            <div class="card shadow full-height">
                <div class="card-header rounded text-center text-primary">
                    <img src="{{ str_replace(':UUID:', $uuid, setting('playerstats.site_head') ?? 'https://mc-heads.net/avatar/:UUID:') }}">
                    <h2>{{ $name }}</h2>
                </div>
                @foreach($games as $game)
                    @if($game->show_profile && $game->stats()->count() >= 1)
                        <div class="card-body rounded text-center text-primary">
                            @if($game->name != '' && $game->name != ' ')
                                <h2>{{ $game->name }}</h2>
                                <hr>
                            @endif
                            @include('playerstats::styles.global')
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
@endsection
