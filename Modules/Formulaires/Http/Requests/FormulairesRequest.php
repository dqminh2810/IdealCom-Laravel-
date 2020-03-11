<?php

namespace Modules\Formulaires\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FormulairesRequest extends FormRequest
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
						'uuid' => 'required|alpha_dash',
						'title' => 'required|string',
						'name_from' => 'string|nullable',
						'email_from' => 'email|nullable',
						'email_to' => 'email|nullable',
						'email_to_cc' => 'string|nullable',
						'actif' => 'boolean',
					];
				}
			case 'PUT':
				{
					return [
						'uuid' => 'required|alpha_dash',
						'title' => 'required|string',
						'name_from' => 'string|nullable',
						'email_from' => 'email|nullable',
						'email_to' => 'email|nullable',
						'email_to_cc' => 'string|nullable',
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
