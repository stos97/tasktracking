<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class EditProfileRequest
 *
 * @package App\Http\Requests
 */
class EditProfileRequest extends FormRequest
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
            'username' => 'required|min:2|max:30',
            'password' => 'nullable|min:6|confirmed',
            'bio'      => 'nullable|min:10|max:200',

        ];
    }
}
