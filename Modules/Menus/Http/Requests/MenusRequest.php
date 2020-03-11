<?php

namespace Modules\Menus\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenusRequest extends FormRequest
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
						'name' => 'alpha_dash|required',
						'display_name' => 'string|required',
						'home' => 'boolean',
						'actif' => 'boolean',
					];
				}
			case 'PUT':
				{
					return [
						'name' => 'alpha_dash|required',
						'display_name' => 'string|required',
						'home' => 'boolean',
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
