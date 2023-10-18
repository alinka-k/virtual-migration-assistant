<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class CompilationRequest extends FormRequest
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
            'percent' => 'required|numeric',
            'canProfileBeEvaluated' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'percent' => 'Please Refresh page and try again.',
            'canProfileBeEvaluated' => 'Please Refresh page and try again.',
        ];
    }
}
