<?php

namespace App\Http\Requests\Api\Auth;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class RegisteredUserRequest extends FormRequest
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
            'name' => [
                'required',
                'string',
                'min:3',
                'max:50'
            ],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                'unique:'.User::class
            ],
            'password' => [
                'required',
                'confirmed',
                'min:6',
                'max:20'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'name.string' => 'O campo nome deve ser uma string.',
            'name.min' => 'O campo nome deve ter no mínimo :min caracteres.',
            'name.max' => 'O campo nome deve ter no máximo :max caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.string' => 'O campo email deve ser uma string.',
            'email.lowercase' => 'O campo email deve ser uma string minúscula.',
            'email.email' => 'O campo email deve ser um email válido.',
            'email.max' => 'O campo email deve ter no máximo :max caracteres.',
            'email.unique' => 'O campo email já está em uso.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.confirmed' => 'O campo senha não confere com a confirmação.',
            'password.min' => 'O campo senha deve ter no mínimo :min caracteres.',
            'password.max' => 'O campo senha deve ter no máximo :max caracteres.',
        ];
    }
}
