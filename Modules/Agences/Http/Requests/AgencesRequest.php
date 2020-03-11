<?php

namespace Modules\Agences\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AgencesRequest extends FormRequest
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
						'name' => 'string|required',
						'web_agence' => 'boolean|required',
						'address' => 'string|nullable',
						'complement' => 'string|nullable',
						'zip_code' => 'string|nullable|max:10',
						'city' => 'string|nullable',
						'country_id' => 'integer|nullable',
						'website' => 'string|nullable',
						'email' => 'email|nullable',
						'actif' => 'boolean|nullable',
					];
				}
			case 'PUT':
				{
					return [
						'name' => 'string|required',
						'web_agence' => 'boolean|required',
						'address' => 'string|nullable',
						'complement' => 'string|nullable',
						'zip_code' => 'string|nullable|max:10',
						'city' => 'string|nullable',
						'country_id' => 'integer|nullable',
						'website' => 'string|nullable',
						'email' => 'email|nullable',
						'actif' => 'boolean|nullable',
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
