<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string $language_type
 * @property boolean $has_test
 * @property string $language_test
 * @property string $language_date
 * @property float $writing_test
 * @property float $reading_test
 * @property float $speaking_test
 * @property float $listening_test
 * @property string $writing
 * @property string $reading
 * @property string $speaking
 * @property string $listening
 */
class UserLanguageRequest extends FormRequest
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
            'language_type' => 'string',
            'has_test' => 'boolean|nullable',
            'language_test' => 'string|nullable',
            'language_date' => 'date|nullable',
            'writing_test' => 'numeric|nullable',
            'reading_test' => 'numeric|nullable',
            'speaking_test' => 'numeric|nullable',
            'listening_test' => 'numeric|nullable',
            'writing' => 'numeric|nullable',
            'reading' => 'numeric|nullable',
            'speaking' => 'numeric|nullable',
            'listening' => 'numeric|nullable',
        ];
    }
}
