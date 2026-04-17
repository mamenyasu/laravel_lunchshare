<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
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
            'post_delete_pass'=>['required','min:4','max:20']
        ];
    }
    public function messages(){
        return[
            'post_delete_pass.required' =>'削除パスワードが未入力です。',
            'post_delete_pass.min' =>'削除パスワードは4文字以上、20文字以内で入力してください。',
            'post_delete_pass.max' =>'削除パスワードは4文字以上、20文字以内で入力してください。',
        ];
    }
}
