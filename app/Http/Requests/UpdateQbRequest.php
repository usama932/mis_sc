<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQbRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

  
    public function rules(): array
    {
        return [
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
            'qbs_not_fully_met' => ['required','numeric'],
            'score_out' => ['required','numeric'],
            'activity_description' => ['required','string'],
          
        ];
    }
}
