<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatefrmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'feedback_channel' => ['required','string'],
            'feedback_description' => ['required','string'],
            'feedback_referredorshared' => ['required'],
            'name_of_client' => ['required','string'],
            'gender' => ['required','string'],
            'age' => ['required'],
            'province' => ['required'],
            'district' => ['required'],
            'tehsil' => ['required'],
            'union_counsil' => ['required'],
            'village' => ['required','string'],
            'theme' => ['required'],
            'feedback_activity' => ['required','string'],
        ];
    }
}
