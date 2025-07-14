<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminNotificationMstRequest extends UpdateAdminMstRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'is_mandatory.*' => 'required|boolean',
        ]);
    }
}
