<?php

namespace App\Http\Requests;

/**
 * Class UpdateTaskRequest
 *
 * @package App\Http\Requests
 */
class UpdateTaskRequest extends Request
{
    /**
     * @var string[]
     */
    protected $decode = [
        'checklist_id',
        'users.*',
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
            'title'        => 'required|min:3|max:20',
            'description'  => 'required|min:3|max:100',
            'checklist_id' => 'required|exists:checklists,id',
            'users'        => 'array',
            'users.*'      => 'exists:users,id',
        ];
    }
}
