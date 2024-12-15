<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Validation\Rules\Password;
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
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.string' => 'O campo e-mail deve ser uma string.',
            'email.lowercase' => 'O campo e-mail deve ser uma string minúscula.',
            'email.email' => 'O campo e-mail deve ser um endereço de e-mail válido.',
            'email.max' => 'O campo e-mail deve ter no máximo :max caracteres.',
            'email.unique' => 'O campo e-mail já está em uso.',
            'password.required' => 'O campo senha é obrigatório.',
            'password.confirmed' => 'O campo senha não confere com a confirmação.',
            'password.min' => 'O campo senha deve ter no mínimo :min caracteres.',
            'password.max' => 'O campo senha deve ter no máximo :max caracteres.',
        ];
    }
}
