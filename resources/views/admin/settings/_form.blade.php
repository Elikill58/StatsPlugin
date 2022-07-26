@csrf
<div class="card-body">
    <div class="mb-3">
        <div class="form-check  form-switch">
            <input type="checkbox" class="form-check-input" id="settingDescription" name="description"
                   @if($setting->settings()->settings->description ?? true) checked @endif>
            <label class="form-check-label"
                   for="settingDescription">{{ trans('stats::admin.setting.settings.description') }}</label>
        </div>
    </div>
    <div class="mb-3">
        <div class="form-check  form-switch">
            <input type="checkbox" class="form-check-input" id="settingEffect" name="effect"
                   @if($setting->settings()->settings->effect ?? true) checked @endif>
            <label class="form-check-label"
                   for="settingEffect">{{ trans('stats::admin.setting.settings.effect') }}</label>
        </div>
    </div>
</div>

