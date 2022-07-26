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
        <label class="form-label" for="descriptionInput">{{ trans('messages.fields.description') }}</label>

        <textarea class="form-control html-editor @error('description') is-invalid @enderror" id="descriptionInput"
                  name="description" rows="1">{{ old('description', $stats->description ?? '') }}</textarea>

        @error('description')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>

    <div class="mb-3">
        <label class="form-label" for="">Jeux</label>
        <select name="games[]" class="form-control" multiple="multiple">
            @foreach($games as $game)
                <option value="{{ $game->id }}" {{isset($stats) ?$stats->isSelected($game->id):""}}>
                    {{ $game->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

