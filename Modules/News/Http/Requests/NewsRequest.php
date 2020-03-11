<?php

namespace Modules\News\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsRequest extends FormRequest
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
                    'en-title' => 'string|required|min:3',
                    'en-resume' => 'string|required|min:3',
                    'en-content' => 'string|required|min:3',
                    'fr-title' => 'string|required|min:3',
                    'fr-resume' => 'string|required|min:3',
                    'fr-content' => 'string|required|min:3',
                ];
            }
            case 'PUT':
            {
                return [
                    'en-title' => 'string|required|min:3',
                    'en-resume' => 'string|required|min:3',
                    'en-content' => 'string|required|min:3',
                    'fr-title' => 'string|required|min:3',
                    'fr-resume' => 'string|required|min:3',
                    'fr-content' => 'string|required|min:3',
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
