<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'name' => ['required','max:100'],
            'email' =>['required','email','max:100'],
            'text' =>['required','max:1000'],
        ];
    }

    public function messages(){
        return[
            'name.required' => '名前を入力してください。',
            'name.max' => '名前は100文字以内で入力してください。',
            'email.required' => 'メールアドレスを入力してください。',
            'email.email' => '入力内容がメール形式ではありません。',
            'email.max' => 'メールアドレスは100文字以内で入力してください。',
            'text.required' => '問い合わせ内容を入力してください。',
            'text.max' => '問い合わせ内容は1000文字以内で入力してください。',
        ];
    }
}
