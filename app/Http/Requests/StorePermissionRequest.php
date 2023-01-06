<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StorePermissionRequest extends FormRequest
{
    public function rules()
    {
        return [
            'title' => [
                'required', 'string',
                'unique:permissions'
            ]
        ];
    }

    public function authorize()
    {
        return Gate::allows('user_access');
    }
}
