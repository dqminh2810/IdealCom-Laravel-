<?php

namespace Modules\Roles\Http\Requests;

use App\Role;
use Illuminate\Foundation\Http\FormRequest;

class PermissionsRequest extends FormRequest
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
						'name' => 'unique:roles,name|alpha_dash|required|min:3',
						'display_name' => 'string|nullable',
						'description' => 'string|nullable',
						'actif' => 'boolean',
						];
				}
			case 'PUT':
				{
					return [
						'name' => 'alpha_dash|required|min:3',
						'display_name' => 'string|nullable',
						'description' => 'string|nullable',
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
