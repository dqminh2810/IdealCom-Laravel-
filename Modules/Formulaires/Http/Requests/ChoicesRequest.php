<?php

namespace Modules\Formulaires\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChoicesRequest extends FormRequest
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
						'field_id' => 'integer|required',
						'label' => 'string|required',
						'value' => 'alpha_dash|required',
						'selected' => 'boolean',
						'actif' => 'boolean',
					];
				}
			case 'PUT':
				{
					return [
						'field_id' => 'integer|required',
						'label' => 'string|required',
						'value' => 'alpha_dash|required',
						'selected' => 'boolean',
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
