<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @property boolean $has_friend_mb
 * @property boolean $has_relatives
 * @property array $relatives
*/
class UserCanadianRelativesRequest extends FormRequest
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
        return  [
            'has_friend_mb' => 'boolean',
            'has_relatives' => 'boolean',
            'relatives.*.relationship' => 'string|nullable',
            'relatives.*.canadian_status' => 'string|nullable',
            'relatives.*.province' => 'string|nullable',
            'relatives.*.residency_duration' => 'string|nullable',
        ];
    }
}
