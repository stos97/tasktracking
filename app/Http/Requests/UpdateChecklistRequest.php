<?php

namespace App\Http\Requests;

/**
 * Class UpdateChecklistRequest
 *
 * @package App\Http\Requests
 */
class UpdateChecklistRequest extends Request
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
            'title' => 'required|min:2|max:30',
        ];
    }
}
