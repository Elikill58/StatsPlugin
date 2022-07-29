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
    <div class="mb-3" style="display: flex;">
        <div class="form-left">
            <label class="form-label" for="">{{ trans('messages.fields.game') }}</label>
            <select name="games_id" id="gameSelect" class="form-control">
                @foreach($games as $game)
                    <option value="{{ $game->id }}" @if(isset($stats->games_id) && $stats->games_id == $game->id) selected @endif>
                        {{ $game->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-right">
            <label class="form-label" for="nameInput">{{ trans('stats::admin.stats.column') }}</label>
            <input type="text" class="form-control @error('stats_column') is-invalid @enderror" id="nameInput"
                   name="stats_column"
                   value="{{ old('stats_column', $stats->stats_column ?? '') }}" required>

            @error('stats_column')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label" for="">{{ trans('stats::admin.stats.style.index') }}</label>
        <select name="style" id="selectedStyle" class="form-control" onfocus="focusStyle(this)" onchange="changeStyle(this)">
            @foreach (array(1 => 'basic', 2 => 'ratio') as $styleId => $stylekey)
                <option value="{{ $styleId }}" @if(isset($stats->style) && $stats->style == $styleId) selected @endif>
                    {{ trans('stats::admin.stats.style.' . $stylekey) }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3" style="display: none;" id="style-2">
        <label class="form-label" for="nameInput">{{ trans('stats::admin.stats.linked') }}</label>
        <input type="text" class="form-control" id="nameInput"
               name="linked" value="{{ old('linked', $stats->settings['linked'] ?? '') }}">
    </div>
</div>

@push('footer-scripts')
    <script>
        var focusingStyle = 0;

        function focusStyle(element) {
            focusingStyle = element.value;
        }

        function changeStyle(element) {
            let divOfOldStyle = document.getElementById("style-" + focusingStyle);
            if(divOfOldStyle != null) {
                divOfOldStyle.style.display = 'none';
            }
            let divOfStyle = document.getElementById("style-" + element.value);
            if(divOfStyle != null) {
                divOfStyle.style.display = 'block';
            }
            focusingStyle = element.value;
        }
        changeStyle(document.getElementById("selectedStyle"));
    </script>
@endpush