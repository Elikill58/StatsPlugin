@csrf
<div class="card-body">
    <h3>{{ trans('playerstats::admin.setting.settings.uuid_name') }}</h3>
    <div class="mb-3" style="display: flex;">
        <div class="form-left">
            <label class="form-label" for="settingDescription">{{ trans('install.database.database') }}</label>
            <input type="text" class="form-control" id="settingDatabase" name="database" required
                   value="{{ setting('playerstats.database') ?? '' }}">
        </div>
        <div class="form-right">
            <label class="form-label" for="settingEffect">{{ trans('playerstats::admin.setting.settings.table') }}</label>
            <input type="text" class="form-control" id="settingTable" name="table" required
                   value="{{ setting('playerstats.table') ?? '' }}">
        </div>
    </div>
    <div class="mb-3" style="display: flex;">
        <div class="form-left">
            <label class="form-label" for="settingEffect">{{ trans('playerstats::admin.setting.settings.column_uuid') }}</label>
            <input type="text" class="form-control" id="settingColumnUuid" name="column_uuid" required
               value="{{ setting('playerstats.column_uuid') ?? '' }}">
        </div>
        <div class="form-right">
            <label class="form-label" for="settingEffect">{{ trans('playerstats::admin.setting.settings.column_name') }}</label>
            <input type="text" class="form-control" id="settingColumnName" name="column_name" required
               value="{{ setting('playerstats.column_name') ?? '' }}">
        </div>
    </div>
    <div class="form-check form-switch">
        <input type="checkbox" class="form-check-input" id="settingUseStatsRoute" name="stats_route" @if(setting('playerstats.stats_route') ?? false) checked @endif>
        <label class="form-check-label" for="settingEffect">{{ trans('playerstats::admin.setting.settings.stats_route') }}</label>
    </div>
</div>

