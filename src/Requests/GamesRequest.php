<?php

namespace Azuriom\Plugin\PlayerStats\Requests;

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
        'stats_own_database'
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
            'show_profile' => ['nullable', 'boolean'],
            'stats_own_database' => ['nullable', 'boolean'],
            'stats_host' => ['nullable', 'string', 'max:255'],
            'stats_port' => ['nullable', 'integer', 'min:10'],
            'stats_username' => ['nullable', 'string'],
            'stats_password' => ['nullable', 'string'],
            'stats_database' => ['required', 'string', 'max:255'],
            'stats_table' => ['required', 'string', 'max:255'],
            'stats_unique_col' => ['required', 'string', 'max:255'],
        ];
    }
}