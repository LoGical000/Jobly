<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'age' => ['integer'],
            'resume' => ['string'],
            'experience' => ['string'],
            'education' => ['string'],
            'portfolio' => ['string'],
            'phone_number' => ['string'],
            'work_status' => ['string', 'in:working,student,not working'],
            'graduation_status' => ['string', 'in:graduated,Not graduated'],
        ];
    }
}
