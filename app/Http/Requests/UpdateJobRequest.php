<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateJobRequest extends FormRequest
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
            'title' => 'required|max:255',
            'category_id' => 'required|max:50|integer',
            'job_type_id' => 'required|max:50|integer',
            'vacancy' => 'required|max:50',
            'min_salary' => 'required|max:50',
            'max_salary' => 'required|max:50',
            // 'location' => 'required|max:255',
            'description' => 'required|max:9000',
            'benifits' => 'required|max:9000',
            'responsibility' => 'max:6000',
            'qualifications' => 'max:6000',
            'experience' => 'nullable',
            'keywords' => 'required|max:255',
            'company_name' => 'required|max:255',
            'company_location' => 'required|max:255',
            'company_website' => 'required|max:255|active_url'
        ];
    }
}
