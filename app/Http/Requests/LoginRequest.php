<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email' => ['required','email','max:100'],
            'password' => ['required','max:20','min:4'],
        ];
    }
    public function messages():array{
        return[
            'email.required' => 'メールアドレスを入力してください。',
            'email.max' => 'メールアドレスは100文字以内で入力してください。',
            'email.email' =>'入力内容がメール形式ではありません。',
            'password.required' => 'パスワードを入力してください。。',
            'password.max' =>'パスワードは4文字以上、20文字以内で入力してください。',
            'password.min' =>'パスワードは4文字以上、20文字以内で入力してください。',
        ];

    }
}
