<?php

namespace Modules\Roles\Http\Requests;

use App\Role;
use Illuminate\Foundation\Http\FormRequest;

class RolesRequest extends FormRequest
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
						'permissions' => 'array',
						];
				}
			case 'PUT':
				{
					return [
						'name' => 'alpha_dash|required|min:3',
						'display_name' => 'string|nullable',
						'description' => 'string|nullable',
						'actif' => 'boolean',
						'permissions' => 'array',
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
