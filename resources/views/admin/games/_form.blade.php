@csrf
<div class="card-body">
    <div class="mb-3">
        <label class="form-label" for="nameInput">{{ trans('messages.fields.name') }}</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput"
               name="name" value="{{ old('name', $game->name ?? '') }}" required>

        @error('name')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label" for="descInput">{{ trans('messages.fields.description') }}</label>
        <input type="text" class="form-control @error('description') is-invalid @enderror" id="descInput"
               name="description" value="{{ old('description', $game->description ?? '') }}">

        @error('description')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="mb-3">
        <div class="form-check form-switch">
            <input type="checkbox" class="form-check-input" id="showProfileInput" name="show_profile"
                    @if($game->show_profile ?? false) checked @endif>
            <label class="form-check-label" for="showProfileInput">{{ trans('playerstats::admin.game.show_profile') }}</label>

            @error('show_profile')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="form-check form-switch">
        <input type="checkbox" class="form-check-input" id="settingOwnDatabase" name="stats_own_database" onclick="showOwnDatabase()" @if($game->stats_own_database ?? false) checked @endif>
        <label class="form-check-label" for="settingOwnDatabase">{{ trans('playerstats::admin.setting.settings.own_database') }}</label>
    </div>
    <div class="mb-3" id="settingOwnDatabaseInformations">
        <div class="mb-3" style="display: flex;">
            <div class="form-left">
                <label class="form-label" for="dbInput">{{ trans('install.database.host') }}¹</label>
                <input type="text" class="form-control @error('stats_host') is-invalid @enderror" id="dbInput"
                       name="stats_host" value="{{ old('stats_host', $game->stats_host ?? '') }}">

                @error('stats_host')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="form-right">
                <label class="form-label" for="dbInput">{{ trans('install.database.port') }}¹</label>
                <input type="number" class="form-control @error('stats_port') is-invalid @enderror" id="dbInput"
                       name="stats_port" value="{{ old('stats_port', $game->stats_port ?? '') }}">

                @error('stats_port')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
        <div class="mb-3" style="display: flex;">
            <div class="form-left">
                <label class="form-label" for="dbInput">{{ trans('install.database.user') }}¹</label>
                <input type="text" class="form-control @error('stats_username') is-invalid @enderror" id="dbInput"
                       name="stats_username" value="{{ old('stats_username', $game->stats_username ?? '') }}">

                @error('stats_username')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
            <div class="form-right">
                <label class="form-label" for="dbInput">{{ trans('install.database.password') }}¹</label>
                <input type="text" class="form-control @error('stats_password') is-invalid @enderror" id="dbInput"
                       name="stats_password" value="{{ old('stats_password', $game->stats_password ?? '') }}">

                @error('stats_password')
                <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                @enderror
            </div>
        </div>
        <hr>
    </div>
    <div class="mb-3">
        <label class="form-label" for="dbInput">{{ trans('install.database.database') }}¹</label>
        <input type="text" class="form-control @error('stats_database') is-invalid @enderror" id="dbInput"
               name="stats_database" value="{{ old('stats_database', $game->stats_database ?? '') }}">

        @error('stats_database')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label" for="tableInput">{{ trans('playerstats::admin.game.table') }}</label>
        <input type="text" class="form-control @error('stats_table') is-invalid @enderror" id="tableInput"
               name="stats_table"
               value="{{ old('stats_table', $game->stats_table ?? '') }}" required>

        @error('stats_table')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label" for="uniqueColInput">{{ trans('playerstats::admin.game.unique_col') }}</label>
        <input type="text" class="form-control @error('stats_unique_col') is-invalid @enderror" id="uniqueColInput"
               name="stats_unique_col"
               value="{{ old('stats_unique_col', $game->stats_unique_col ?? '') }}" required>

        @error('stats_unique_col')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <p>¹{{ trans('playerstats::admin.game.empty_to_keep') }}</p>
</div>

@push('footer-scripts')
    <script>
        function showOwnDatabase() {
            let div = document.getElementById("settingOwnDatabaseInformations");
            if(div != null) {
                if(document.getElementById("settingOwnDatabase").checked)
                    div.style.display = null;
                else
                    div.style.display = "none";
            }
        }
        showOwnDatabase();
    </script>
@endpush