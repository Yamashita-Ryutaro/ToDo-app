<?php

namespace App\Http\Requests\Task;

use App\Http\Requests\Task\CreateTask;

class EditTask extends CreateTask
{
    /**
     * Get the validation rules that apply to the request.
     * バリデーションルールを定義するメソッド
     *
     * @return array
     */
    public function rules()
    {
        $rule = parent::rules();
        return $rule + [
            'status' => ['required', 'exists:task_statuses,id'],
        ];
    }

    /**
     * リクエストのnameなどの値を再定義するメソッド
     *
     * @return array<string>
     */
    public function attributes()
    {
        $attributes = parent::attributes();

        return $attributes + [
            'status' => '状態',
        ];
    }

    /**
     * FormRequestクラス単位でエラーメッセージを定義するメソッド
     *
     * @return array<string>
     */
    public function messages()
    {
        $messages = parent::messages();

        return $messages + [
            'status.exists' => ':attribute が無効です。',
        ];
    }
}