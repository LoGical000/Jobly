<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnnouncementRequest extends FormRequest
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
            'title' => ['required', 'string'],
            'type' => ['required','in:course,internship'],
            'start_date' => ['required', 'date'],
            'days' => ['required', 'string'],
            'time' => ['required','string'],
            'price' => ['required', 'string'],
            'duration' => ['required', 'string'],
        ];
    }
}
