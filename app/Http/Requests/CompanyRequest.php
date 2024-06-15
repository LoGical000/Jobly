<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class CompanyRequest extends FormRequest
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
            'Date_of_Establishment' => ['required', 'string'],
            'employe_number' => ['required', 'integer'],
            'Commercial_Record' => ['required', 'string'],
            'company_name' => ['required', 'string'],
            'contact_phone' => ['required'],
            'industry' => ['required', 'string'],
            'company_website' => ['required', 'string'],
            'company_description' => ['required', 'string'],
            'contact_email' => ['required', 'string'],
            'contact_person' => ['required', 'string'],

        ];
    }
}
