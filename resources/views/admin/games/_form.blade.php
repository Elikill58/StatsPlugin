@csrf
<div class="card-body">
    <div class="mb-3">
        <label class="form-label" for="nameInput">{{ trans('messages.fields.name') }}</label>
        <input type="text" class="form-control @error('name') is-invalid @enderror" id="nameInput"
               name="name"
               value="{{ old('name', $game->name ?? '') }}" required>

        @error('name')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label" for="descInput">{{ trans('messages.fields.description') }}</label>
        <input type="text" class="form-control @error('description') is-invalid @enderror" id="descInput"
               name="description"
               value="{{ old('description', $game->description ?? '') }}">

        @error('description')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label" for="dbInput">{{ trans('messages.fields.stats_database') }}</label>
        <input type="text" class="form-control @error('stats_database') is-invalid @enderror" id="dbInput"
               name="stats_database"
               value="{{ old('stats_database', $game->stats_database ?? '') }}" required>

        @error('stats_database')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label" for="tableInput">{{ trans('messages.fields.stats_table') }}</label>
        <input type="text" class="form-control @error('stats_table') is-invalid @enderror" id="tableInput"
               name="stats_table"
               value="{{ old('stats_table', $game->stats_table ?? '') }}" required>

        @error('stats_table')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
    <div class="mb-3">
        <label class="form-label" for="uniqueColInput">{{ trans('messages.fields.stats_unique_col') }}</label>
        <input type="text" class="form-control @error('stats_unique_col') is-invalid @enderror" id="uniqueColInput"
               name="stats_unique_col"
               value="{{ old('stats_unique_col', $game->stats_unique_col ?? '') }}" required>

        @error('stats_unique_col')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
        @enderror
    </div>
</div>