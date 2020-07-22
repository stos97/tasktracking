<?php

namespace App\Http\Requests;

/**
 * Class CreateTaskRequest
 *
 * @package App\Http\Requests
 */
class CreateTaskRequest extends Request
{
    /**
     * @var string[]
     */
    protected $decode = [
        'checklist_id',
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
            'title'        => 'required|min:3|max:20',
            'description'  => 'required|min:3|max:100',
            'checklist_id' => 'required|exists:checklists,id',
            'project_id'   => 'required|exists:projects,id',
        ];
    }
}
