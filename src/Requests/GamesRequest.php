<?php

namespace Azuriom\Plugin\Stats\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GamesRequest extends FormRequest
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
            'stats_database' => ['required', 'string', 'max:255'],
            'stats_table' => ['required', 'string', 'max:255'],
            'stats_unique_col' => ['required', 'string', 'max:255'],
        ];
    }
}