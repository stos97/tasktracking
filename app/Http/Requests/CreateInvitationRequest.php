<?php

namespace App\Http\Requests;

/**
 * Class CreateInvitationRequest
 *
 * @package App\Http\Requests
 */
class CreateInvitationRequest extends Request
{
    /**
     * @var string[]
     */
    protected $decode = [
        'project_id',
    ];

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
            'email'      => 'required',
            'project_id' => 'required|exists:projects,id',
        ];
    }
}
