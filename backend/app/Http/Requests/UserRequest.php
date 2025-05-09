<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'email' => "required|string|email|max:255|unique:users,id,{$this->route('id')}",
            'birth_date' => 'required|date_format:Y-m-d|before:today',
            'cpf' => 'required|string|cpf|unique:users',
        ];

        if (filled($this->googleId)) {
            $rules = [
                'googleId' => 'required|string|exists:users,google_id',
            ];
        }

        return $rules;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'googleId' => $this->route('googleId'),
        ]);
    }
}
