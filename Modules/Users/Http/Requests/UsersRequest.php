<?php

namespace Modules\Users\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsersRequest extends FormRequest
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
						'email' => 'unique:users,email|email|required',
						'password' => 'required|min:6',
						'actif' => 'boolean',
						'roles' => 'array',
					];
				}
			case 'PUT':
				{
					return [
						'name' => 'required|min:5',
						'email' => 'email|required',
						'password' => '',
						'actif' => 'boolean',
						'roles'=> 'array',
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
