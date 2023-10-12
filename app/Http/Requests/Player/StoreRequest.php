<?php

namespace App\Http\Requests\Player;

use App\Rules\IsValidVocation;
use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'unique:players', 'string', 'max:32'],
            'vocation' => ['required', 'int', 'max:255', new IsValidVocation],
        ];
    }
}
