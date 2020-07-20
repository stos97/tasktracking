<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class UserRegistrationRequest
 *
 * @package App\Http\Requests
 */
class UserRegistrationRequest extends FormRequest
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
            'name'     => 'required|min:2|max:30',
            'email'    => 'required|unique:users',
            'password' => 'required|min:6|confirmed',
            'username' => 'required|min:2|max:30',
        ];
    }
}
