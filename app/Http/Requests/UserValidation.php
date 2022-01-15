<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Symfony\Contracts\Service\Attribute\Required;

class UserValidation extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name'                      => 'required|regex:/^[a-zA-Z0-9-]+$/|min:6',
            'email'                     => 'required|email',
            'password'                  => 'required|regex:/^[a-zA-Z0-9-]+$/|min:6',
            //passwordと確認用が一緒であることをバリデートする。
            'password_confirmation'     => 'required|regex:/^[a-zA-Z0-9-]+$/|min:6|same:password'
        ];
    }

    public function messages()
    {
        return [
            'regex' => ':attributeは英数字で入力してください'
        ];
    }
}
