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
            'personal_id' => 'required|string',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'start_date' => 'required|date',
            'gender' => 'required|string|in:male,female,undefined',
            'company_id' => 'required|integer|exists:companies,id',
            'workplace_id' => 'required|integer|exists:workplaces,id',
            'position_id' => 'required|integer|exists:positions,id',
            'country_id' => 'required|integer|exists:countries,id',
        ];
    }
}
