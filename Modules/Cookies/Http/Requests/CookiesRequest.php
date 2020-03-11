<?php

namespace Modules\Cookies\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CookiesRequest extends FormRequest
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
						'position' => 'required|string',
						'banner_color' => 'required|string',
						'banner_text' => 'required|string',
						'banner_text_color' => 'required|string',
						'button_color' => 'required|string',
						'button_text' => 'required|string',
						'button_text_color' => 'required|string',
						'link' => 'required|string',
						'actif' => 'boolean',
					];
				}
			case 'PUT':
				{
					return [
						'title' => 'required|required|min:3',
						'position' => 'required|string',
						'banner_color' => 'required|string',
						'banner_text' => 'required|string',
						'banner_text_color' => 'required|string',
						'button_color' => 'required|string',
						'button_text' => 'required|string',
						'button_text_color' => 'required|string',
						'link' => 'required|string',
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
