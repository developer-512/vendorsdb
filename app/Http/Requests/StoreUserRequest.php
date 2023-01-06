<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class StoreUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'     => [
                'string',
                'required',
            ],
            'position'     => [
                'string',
            ],
            'company'     => [
                'string',
            ],
            'phone'     => [
                'string',
            ],
            'email'    => [
                'required',
                'unique:users',
            ],
            'password' => [
                'required',
            ],
            'roles.*'  => [
                'integer',
            ],
            'roles'    => [
                'required',
            ],
        ];
    }

    public function authorize()
    {
        return Gate::allows('user_access');
    }
}
