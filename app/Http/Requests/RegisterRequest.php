<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name' => ['required','string','max:255'],
            'email' =>['required','string','email','max:255','unique:users',],
            'password'=>['required','string','min:4','max:20','confirmed'],
        ];
    }

    public function messages(){
        return [
            'name.required' => 'ユーザー名は必須です。',
            'name.max' => 'ユーザー名は255文字以内で入力してください。',

            'email.required' => 'メールアドレスは必須です。',
            'email.email'=> 'メールアドレスの形式が正しくありません。',
            'email.max' => 'メールアドレスは255文字以内で入力してください。',
            'email.unique' => 'このメールアドレスは既に登録されています。',

            'password.required' => 'パスワードは必須です。',
            'password.min' => 'パスワードは4文字以上20文字以内で入力してください。',
            'password.max' => 'パスワードは4文字以上20文字以内で入力してください。',
            'password.confirmed' => 'パスワードと確認用パスワードが一致しません。',
        ];
    }
}
