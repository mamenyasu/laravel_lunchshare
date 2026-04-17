<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'user_name' => ['required','string','max:100'],
            'shop_name' => ['required','string','max:100'],
            'pref' =>['nullable','string','max:255'],
            'city' =>['nullable','string','max:255'],
            'pref_city' => ['string'],
            'comment' => ['string','max:1000'],
            'delete_pass' => ['required','string','max:20','min:4'],
            'image' =>['required','image','mimes:jpeg,jpg,png,webp','max:8192'],
        ];
    }
    public function messages(){
        return[
            'user_name.max' => '名前は100文字以内で入力してください。',
            'shop_name.max' => '店名は100文字以内で入力してください。',
            'shop_name.required' => '店名を入力してください。',
            'comment.max' => 'コメントは1000文字以内で入力してください',
            'image.required' => '画像イメージを選択してください。',
            'image.image' => '指定されたファイルが画像ではありません。',
            'image.mimes' => '画像は jpeg, jpg, png, webp のいずれかを選択してください。',
            'image.max' => '画像サイズは8MB以内でアップロードしてください。',
            'delete_pass.required' => '削除パスワードを入力してください。',
            'delete_pass.max' =>'削除パスワードは4文字以上、20文字以内で入力してください。',
            'delete_pass.min' =>'削除パスワードは4文字以上、20文字以内で入力してください。',
        ];
    }




    protected function prepareForValidation(){
        $this->merge([
            'user_name' => ($this->user_name ?: '名無し'),
            'comment' => ($this->comment ?: ''),
            'pref_city' => ($this->pref ?? "") . ($this->city ?? "")
        ]);
    }
}
