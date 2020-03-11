<?php

namespace Modules\Subscribers\Http\Requests;

use \Illuminate\Foundation\Http\FormRequest;

class GroupsRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {

        switch($this->method()) {
            case 'POST':
            {
                return [
                    'code' => 'required|min:3',
                ];
            }
            case 'PUT':
            {
                return [
                    'code' => 'required|min:3',
                ];
            }
            default:break;
        }
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
}