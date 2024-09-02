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
            'state.personal_id' => 'required|string',
            'state.first_name' => 'required|string|max:255',
            'state.last_name' => 'required|string|max:255',
            'state.birth_date' => 'required|date',
            'state.start_date' => 'required|date',
            'state.gender' => 'required|string|in:male,female,undefined',
            'state.company_id' => 'required|integer|exists:companies,id',
            'state.workplace_id' => 'required|integer|exists:workplaces,id',
            'state.position_id' => 'required|integer|exists:positions,id',
            'state.country_id' => 'required|integer|exists:countries,id',
            'state.photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'state.personal_id.required' => 'The personal ID is required.',
            'state.first_name.required' => 'The first name is required.',
            'state.first_name.max' => 'The first name cannot exceed 255 characters.',
            'state.last_name.required' => 'The last name is required.',
            'state.last_name.max' => 'The last name cannot exceed 255 characters.',
            'state.birth_date.required' => 'The birth date is required.',
            'state.birth_date.date' => 'The birth date must be a valid date.',
            'state.start_date.required' => 'The start date is required.',
            'state.start_date.date' => 'The start date must be a valid date.',
            'state.gender.required' => 'The gender is required.',
            'state.gender.in' => 'The selected gender is invalid.',
            'state.company_id.required' => 'The company is required.',
            'state.company_id.exists' => 'The selected company is invalid.',
            'state.workplace_id.required' => 'The workplace is required.',
            'state.workplace_id.exists' => 'The selected workplace is invalid.',
            'state.position_id.required' => 'The position is required.',
            'state.position_id.exists' => 'The selected position is invalid.',
            'state.country_id.required' => 'The country is required.',
            'state.country_id.exists' => 'The selected country is invalid.',
            'state.photo.image' => 'The photo must be an image.',
            'state.photo.mimes' => 'The photo must be in jpeg, png, jpg, gif, or svg format.',
            'state.photo.max' => 'The photo must be less than 2 MB.',
        ];
    }
}
