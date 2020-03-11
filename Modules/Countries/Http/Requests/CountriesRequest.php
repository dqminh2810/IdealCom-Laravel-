<?php

namespace Modules\Countries\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CountriesRequest extends FormRequest
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
						'code' => 'required|string',
						'name' => 'required|string',
						'alpha2' => 'required|string|max:2|min:2',
						'alpha3' => 'required|string|max:3|min:3',
					];
				}
			case 'PUT':
				{
					return [
						'code' => 'required|string',
						'name' => 'required|string',
						'alpha2' => 'required|string|max:2|min:2',
						'alpha3' => 'required|string|max:3|min:3',
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
