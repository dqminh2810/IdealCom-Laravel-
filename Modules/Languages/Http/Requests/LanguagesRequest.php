<?php

namespace Modules\Languages\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LanguagesRequest extends FormRequest
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
						'code' => 'string|required',
						'name' => 'string|required',
						'native_name' => 'string|required',
						'actif' => 'boolean',
					];
				}
			case 'PUT':
				{
					return [
						'code' => 'string|required',
						'name' => 'string|required',
						'native_name' => 'string|required',
						'actif' => 'boolean',
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
