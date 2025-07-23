<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Admin\UpdateAdminMstRequest;

class UpdateAdminMailKeyMstRequest extends UpdateAdminMstRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            'keys.*' => 'required|string|max:20',
        ]);
    }
}
