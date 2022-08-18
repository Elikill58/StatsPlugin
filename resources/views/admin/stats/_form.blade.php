@csrf
<div class="card-body">
    @if(isset($playerstats))
        <input type="hidden" name="position" value="{{$playerstats->count() + 1}}">
    @endif
    <div class="mb-3">
        <label class="form-label" for="nameInput">{{ trans('messages.fields.name') }}</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput"
               name="name"
               value="{{ old('name', $playerstat->name ?? '') }}" required>

        @error('name')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="mb-3" style="display: flex;">
        <div class="form-left">
            <label class="form-label" for="">{{ trans('messages.fields.game') }}</label>
            <select name="games_id" id="gameSelect" class="form-control">
                @foreach($games as $game)
                    <option value="{{ $game->id }}" @if(isset($playerstat->games_id) && $playerstat->games_id == $game->id) selected @endif>
                        {{ $game->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-right">
            <label class="form-label" for="nameInput">{{ trans('playerstats::admin.stats.column') }}</label>
            <input type="text" class="form-control @error('stats_column') is-invalid @enderror" id="nameInput"
                   name="stats_column"
                   value="{{ old('stats_column', $playerstat->stats_column ?? '') }}" required>

            @error('stats_column')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>
    <div class="mb-3 flex">
        <div class="form-left">
            <label class="form-label" for="prefixInput">{{ trans('playerstats::admin.stats.prefix') }}</label>
            <input type="text" class="form-control" id="prefixInput"
                   name="prefix" value="{{ old('prefix', $playerstat->settings['prefix'] ?? '') }}">

            @error('prefix')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <div class="form-right">
            <label class="form-label" for="suffixInput">{{ trans('playerstats::admin.stats.suffix') }}</label>
            <input type="text" class="form-control @error('suffix') is-invalid @enderror" id="suffixInput"
                   name="suffix" value="{{ old('suffix', $playerstat->settings['suffix'] ?? '') }}">

            @error('suffix')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
    </div>

    <div class="mb-3">
        <label class="form-label" for="">{{ trans('playerstats::admin.stats.style.index') }}</label>
        <select name="style" id="selectedStyle" class="form-control" onfocus="focusStyle(this)" onchange="changeStyle(this)">
            @foreach (array(1 => 'basic', 2 => 'ratio', '3' => 'timed', '4' => 'rounded') as $styleId => $stylekey)
                <option value="{{ $styleId }}" @if(isset($playerstat->style) && $playerstat->style == $styleId) selected @endif>
                    {{ trans('playerstats::admin.stats.style.' . $stylekey) }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3" style="display: none;" id="style-2">
        <label class="form-label" for="linkedInput">{{ trans('playerstats::admin.stats.linked') }}</label>
        <input type="text" class="form-control" id="linkedInput"
               name="linked" value="{{ old('linked', $playerstat->settings['linked'] ?? '') }}">
    </div>
    <div class="mb-3" style="display: none;" id="style-3">
        <label class="form-label" for="timedFromInput">{{ trans('playerstats::admin.stats.timed_from') }}</label>
        <select name="timed_from" id="timedFromInput" class="form-control">
            @foreach (array('millisecond', 'second', 'minute', 'hour', 'day', 'month', 'year') as $timeKey)
                <option value="{{ $timeKey }}" @if(($playerstat->settings['timed_from'] ?? 'second') == $timeKey) selected @endif>
                    {{ trans('playerstats::admin.timed.' . $timeKey) }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3" style="display: none;" id="style-4">
        <label class="form-label" for="roundedAmountInput">{{ trans('playerstats::admin.stats.rounded_amount') }}</label>
        <input type="number" class="form-control" id="roundedAmountInput"
               name="rounded_amount" value="{{ old('rounded_amount', $playerstat->settings['rounded_amount'] ?? '0') }}">
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
                divOfStyle.style.display = null;
            }
            focusingStyle = element.value;
        }
        changeStyle(document.getElementById("selectedStyle"));
    </script>
@endpush