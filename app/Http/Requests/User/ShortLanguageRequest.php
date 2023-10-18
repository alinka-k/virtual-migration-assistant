<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $language_test
 * @property string $writing
 * @property string $reading
 * @property string $speaking
 * @property string $listening
 */
class ShortLanguageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'language_test' => 'string|nullable',
            'writing' => 'numeric|nullable',
            'reading' => 'numeric|nullable',
            'speaking' => 'numeric|nullable',
            'listening' => 'numeric|nullable',
        ];
    }
}
