<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CheckAvailabilityRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'check_in_date' => 'required|date',
            'check_out_date' => 'required|date|after:check_in_date'
        ];
    }

    public function messages()
    {
        return [
            'check_in_date.required' => 'Check-in date is required.',
            'check_in_date.date' => 'Check-in date must be a valid date.',
            'check_out_date.required' => 'Check-out date is required.',
            'check_out_date.date' => 'Check-out date must be a valid date.',
            'check_out_date.after' => 'Check-out date must be after the check-in date.'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $response = response()->json([
            'errors' => $validator->errors()
        ], 400);

        throw new HttpResponseException($response);
    }
}
