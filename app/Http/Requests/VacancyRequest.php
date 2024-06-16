<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VacancyRequest extends FormRequest
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
            'description' => 'required',
            'image' => 'required',
            'job_type' => 'required',
            'requirements' => 'required',
            'salary_range' => 'required',
            'application_deadline' => 'required',
            'status' => 'required',
            'jops_section_id' => 'required',
            'user_id' => 'required',
        ];
    }
}
