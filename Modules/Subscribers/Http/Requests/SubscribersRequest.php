<?php

namespace Modules\Subscribers\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscribersRequest extends FormRequest
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
                    'subscriber_name' => 'required|min:5',
                    'email' => 'email|email|required',
                ];
            }
            case 'PUT':
            {
                return [
                    'subscriber_name' => 'required|min:5',
                    'email' => 'email|required',
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