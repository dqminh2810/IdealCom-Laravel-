<?php

namespace Modules\Pages\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PagesRequest extends FormRequest
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
						'title' => 'required|min:3',
						'url' => 'unique:pages,url|url',
						'code' => 'required|string|min:3',
						'actif' => 'boolean',
					];
				}
			case 'PUT':
				{
					return [
						'title' => 'required|min:3',
						'url' => 'url',
						'code' => 'required|string|min:3',
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
