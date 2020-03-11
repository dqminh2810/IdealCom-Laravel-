<?php
namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfilsRequest extends FormRequest
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
                    'name' => 'required|min:5',
					'telephone' => 'string|nullable',
					'website' => 'url|nullable',
					'address' => 'string|nullable',
					'city' => 'string|nullable',
					'country' => 'string|nullable',
					'avatar' => 'image|nullable',
                ];
            }
            case 'PUT':
            {
                return [
					'name' => 'required|min:5',
					'telephone' => 'string|nullable',
					'website' => 'url|nullable',
					'address' => 'string|nullable',
					'city' => 'string|nullable',
					'country' => 'string|nullable',
					'avatar' => 'image|nullable',
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