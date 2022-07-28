@csrf
<div class="card-body">
    <h3>{{ trans('stats::admin.setting.settings.uuid_name') }}</h3>
    <div class="mb-3" style="display: flex;">
        <div class="form-right">
            <label class="form-label" for="settingDescription">{{ trans('install.database.database') }}</label>
            <input type="text" class="form-control" id="settingDatabase" name="database" required
                   value="{{ old('database', $setting->settings()->settings->database ?? '') }}">
        </div>
        <div class="form-left">
            <label class="form-label" for="settingEffect">{{ trans('stats::admin.setting.settings.table') }}</label>
            <input type="text" class="form-control" id="settingTable" name="table" required
                   value="{{ old('table', $setting->settings()->settings->table ?? '') }}">
        </div>
    </div>
    <div class="mb-3" style="display: flex;">
        <div class="form-right">
            <label class="form-label" for="settingEffect">{{ trans('stats::admin.setting.settings.column_uuid') }}</label>
            <input type="text" class="form-control" id="settingColumnUuid" name="column_uuid" required
               value="{{ old('column_uuid', $setting->settings()->settings->column_uuid ?? '') }}">
        </div>
        <div class="form-left">
            <label class="form-label" for="settingEffect">{{ trans('stats::admin.setting.settings.column_name') }}</label>
            <input type="text" class="form-control" id="settingColumnName" name="column_name" required
               value="{{ old('column_name', $setting->settings()->settings->column_name ?? '') }}">
        </div>
    </div>
</div>

