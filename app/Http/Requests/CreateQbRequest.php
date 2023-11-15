<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class CreateQbRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'date_visit' => ['required'],
            'accompanied_by' => ['required','string'],
            'type_of_visit' => ['required','string'],
            'province' => ['required'],
            'district' => ['required'],
            'tehsil' => ['required'],
            'union_counsil' => ['required'],
            'village' => ['required'],
            'project_type' => ['required','string'],
            'project_name' => ['required','string'],
            'monitoring_type' => ['required','string'],
            'qb_not_applicable' => ['required','numeric'],
            'qbs_fully_met' => ['required','numeric'],
            'activity_description' => ['required','string'],
          
        ];
    }
}
