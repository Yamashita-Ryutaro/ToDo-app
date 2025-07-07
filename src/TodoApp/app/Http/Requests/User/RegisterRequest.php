<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ];
    }

    /**
     * バリデーションエラー時の遷移先指定
     *
     * throw new HttpResponseException($response);
     */
    protected function failedValidation(Validator $validator)
    {
        // ルートパラメータからIDを取得
        $response = redirect()
            ->route('user.register')
            ->withErrors($validator)
            ->withInput();

        throw new HttpResponseException($response);
    }
}
