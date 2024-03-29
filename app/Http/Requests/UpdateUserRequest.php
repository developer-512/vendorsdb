<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;

class UpdateUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name'    => [
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
            'email'   => [
                'required',
                'unique:users,email,' . request()->route('user')->id,
            ],
            'roles.*' => [
                'integer',
            ],
            'roles'   => [
                'required',
            ],
        ];
    }

    public function authorize()
    {
        return Gate::allows('user_access');
    }
}
