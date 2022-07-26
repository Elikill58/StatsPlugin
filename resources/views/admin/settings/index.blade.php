<div class="card shadow mb-4">
    <div class="card-body">
        <h3>{{ trans('stats::admin.setting.title') }}</h3>
        <form action="{{ route('stats.admin.settings.update', $setting) }}" method="POST">
            @method('PUT')

            @include('stats::admin.settings._form')
            <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> {{ trans('messages.actions.save') }}
            </button>
        </form>
    </div>
</div>
