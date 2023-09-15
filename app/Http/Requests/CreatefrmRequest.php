<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CreatefrmRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules()
    {
        return [
            'name_of_registrar' => ['required', 'string'],
            'date_received' => ['required'],
            'feedback_channel' => ['required','string'],
            'name_of_client' => ['required','string'],
            'type_of_client' => ['required','string'],
            'gender' => ['required','string'],
            'age' => ['required'],
            'province' => ['required'],
            'district' => ['required'],
            'tehsil' => ['required'],
            'union_counsil' => ['required'],
            'village' => ['required','string'],
            'pwd_clwd' => ['required'],
            'allow_contact' => ['required'],
            'feedback_description' => ['required','string'],
            'feedback_category' => ['required'],
            'theme' => ['required'],
            'feedback_activity' => ['required','string'],
            'feedback_referredorshared' => ['required'],
        ];
    }
}
