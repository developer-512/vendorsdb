<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreRoleRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => [
                'required', 'string',
            ],
            'permission.*'  => [
                'string',
            ],
            'permission'    => [
                'required',
                'array',
            ],
        ];
    }

    public function authorize()
    {
        return Gate::allows('user_access');
    }
}
