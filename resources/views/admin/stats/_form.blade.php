@csrf
<div class="card-body">
    @if(isset($statss))
        <input type="hidden" name="position" value="{{$statss->count() + 1}}">
    @endif
    <div class="mb-3">
        <label class="form-label" for="nameInput">{{ trans('messages.fields.name') }}</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput"
               name="name"
               value="{{ old('name', $stats->name ?? '') }}" required>

        @error('name')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label" for="nameInput">{{ trans('stats::admin.stats.column') }}</label>
        <input type="text" class="form-control @error('stats_column') is-invalid @enderror" id="nameInput"
               name="stats_column"
               value="{{ old('stats_column', $stats->stats_column ?? '') }}" required>

        @error('stats_column')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label" for="descriptionInput">{{ trans('messages.fields.description') }}</label>

        <textarea class="form-control html-editor @error('description') is-invalid @enderror" id="descriptionInput"
                  name="description" rows="1">{{ old('description', $stats->description ?? '') }}</textarea>

        @error('description')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label" for="">{{ trans('stats::admin.stats.style.index') }}</label>
        <select name="style" id="selectedStyle" class="form-control">
            @foreach (array(1 => 'basic', 2 => 'ratio') as $styleId => $stylekey)
                <option value="{{ $styleId }}" @if(isset($stats->style) && $stats->style == $styleId) selected @endif>
                    {{ trans('stats::admin.stats.style.' . $stylekey) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label" for="">{{ trans('messages.fields.game') }}</label>
        <select name="games_id" id="gameSelect" class="form-control">
            @foreach($games as $game)
                <option value="{{ $game->id }}">
                    {{ $game->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

