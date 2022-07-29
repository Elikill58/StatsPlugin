<?php

namespace Azuriom\Plugin\Stats\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Azuriom\Http\Requests\Traits\ConvertCheckbox;

class GamesRequest extends FormRequest
{
    use ConvertCheckbox;

    /**
     * The checkboxes attributes.
     *
     * @var array
     */
    protected $checkboxes = [
        'show_profile',
    ];

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
            'show_profile' => ['filled', 'boolean'],
            'stats_database' => ['required', 'string', 'max:255'],
            'stats_table' => ['required', 'string', 'max:255'],
            'stats_unique_col' => ['required', 'string', 'max:255'],
        ];
    }
}