<?php

namespace Azuriom\Plugin\Stats\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StatsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'        => ['required', 'string', 'max:50'],
            'description' => ['nullable', 'string', 'max:255'],
            'style'       => ['required', 'integer', 'min:1'],
            'stats_column'=> ['required', 'string', 'max:255'],
            'games_id'    => ['nullable', 'exists:stats_games,id'],
        ];
    }
}
