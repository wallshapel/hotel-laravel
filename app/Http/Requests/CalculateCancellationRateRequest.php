<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class CalculateCancellationRateRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Cambia esto según tus necesidades de autorización
    }

    public function rules()
    {
        return [
            'room_code' => 'required|string',
            'season_name' => 'required|string',
            'checkin_date' => 'required|date',
            'checkout_date' => 'required|date|after:checkin_date',
            'num_people' => 'required|integer|min:1',
        ];
    }

    public function messages()
    {
        return [
            'room_code.required' => 'Room code is required.',
            'season_name.required' => 'Season name is required.',
            'checkin_date.required' => 'Check-in date is required.',
            'checkin_date.date' => 'Check-in date must be a valid date.',
            'checkout_date.required' => 'Check-out date is required.',
            'checkout_date.date' => 'Check-out date must be a valid date.',
            'checkout_date.after' => 'Check-out date must be after the check-in date.',
            'num_people.required' => 'Number of people is required.',
            'num_people.integer' => 'Number of people must be an integer.',
            'num_people.min' => 'Number of people must be at least 1.'
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
