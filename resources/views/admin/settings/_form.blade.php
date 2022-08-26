@csrf
<div class="card-body">
    <h3>{{ trans('playerstats::admin.setting.settings.uuid_name') }}</h3>
    <div class="mb-3 form-check form-switch">
        <input type="checkbox" class="form-check-input" id="settingOwnDatabase" name="own_database" onclick="showOwnDatabase()" @if(setting('playerstats.own_database') ?? false) checked @endif>
        <label class="form-check-label" for="settingOwnDatabase">{{ trans('playerstats::admin.setting.settings.own_database') }}</label>
    </div>
    <div class="mb-3" id="settingOwnDatabaseInformations">
        <div class="mb-3" style="display: flex;">
            <div class="form-left">
                <label class="form-label" for="settingHost">{{ trans('install.database.host') }}</label>
                <input type="text" class="form-control" id="settingHost" name="host" value="{{ setting('playerstats.host') ?? '' }}">
            </div>
            <div class="form-right">
                <label class="form-label" for="settingPort">{{ trans('install.database.port') }}</label>
                <input type="number" class="form-control" id="settingPort" name="port" value="{{ setting('playerstats.port') ?? '3306' }}">
            </div>
        </div>
        <div class="mb-3" style="display: flex;">
            <div class="form-left">
                <label class="form-label" for="settingUsername">{{ trans('install.database.user') }}</label>
                <input type="text" class="form-control" id="settingUsername" name="username" value="{{ setting('playerstats.username') ?? '' }}">
            </div>
            <div class="form-right">
                <label class="form-label" for="settingPassword">{{ trans('install.database.password') }}</label>
                <input type="text" class="form-control" id="settingPassword" name="password" value="{{ setting('playerstats.password') ?? '' }}">
            </div>
        </div>
        <hr>
    </div>
    <div class="mb-3" style="display: flex;">
        <div class="form-left">
            <label class="form-label" for="settingDescription">{{ trans('install.database.database') }}</label>
            <input type="text" class="form-control" id="settingDatabase" name="database" required
                   value="{{ setting('playerstats.database') ?? '' }}">
        </div>
        <div class="form-right">
            <label class="form-label" for="settingTable">{{ trans('playerstats::admin.setting.settings.table') }}</label>
            <input type="text" class="form-control" id="settingTable" name="table" required
                   value="{{ setting('playerstats.table') ?? '' }}">
        </div>
    </div>
    <div class="mb-3" style="display: flex;">
        <div class="form-left">
            <label class="form-label" for="settingColumnUuid">{{ trans('playerstats::admin.setting.settings.column_uuid') }}</label>
            <input type="text" class="form-control" id="settingColumnUuid" name="column_uuid" required
               value="{{ setting('playerstats.column_uuid') ?? '' }}">
        </div>
        <div class="form-right">
            <label class="form-label" for="settingColumnName">{{ trans('playerstats::admin.setting.settings.column_name') }}</label>
            <input type="text" class="form-control" id="settingColumnName" name="column_name" required
               value="{{ setting('playerstats.column_name') ?? '' }}">
        </div>
    </div>
    <div class="mb-3 form-check form-switch">
        <input type="checkbox" class="form-check-input" id="settingNavigation" name="navigation" @if(setting('playerstats.navigation') ?? false) checked @endif>
        <label class="form-check-label" for="settingNavigation">{{ trans('playerstats::admin.setting.settings.navigation') }}</label>
    </div>
    <div class="mb-3">
        <label class="form-label" for="siteHeadInput">{{ trans('playerstats::admin.setting.settings.site_head') }}</label>
        <select name="site_head" id="siteHeadInput" class="form-control">
            @foreach (array('McHeads' => 'https://mc-heads.net/avatar/:UUID:', 'Craftavatar' => 'https://crafatar.com/avatars/:UUID:') as $siteName => $siteUrl)
                <option value="{{ $siteUrl }}" @if((setting('playerstats.site_head') ?? 'https://mc-heads.net/avatar/:UUID:') == $siteUrl) selected @endif>
                    {{ $siteName }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="form-check form-switch">
        <input type="checkbox" class="form-check-input" id="settingUseStatsRoute" name="stats_route" @if(setting('playerstats.stats_route') ?? false) checked @endif>
        <label class="form-check-label" for="settingUseStatsRoute">{{ trans('playerstats::admin.setting.settings.stats_route') }}</label>
    </div>
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
