<?php

namespace Modules\Formulaires\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FieldsRequest extends FormRequest
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
						'formulaire_id' => 'integer|required',
						'backoffice' => 'boolean|required',
						'label_bo' => 'string|required',
						'label_fo' => 'string|required',
						'type' => 'string|required',
						'placeholder' => 'string|nullable',
						'value' => 'string|required_if:type,hidden|nullable',
						'min' => 'numeric|nullable',
						'max' => 'numeric|nullable',
						'step' => 'numeric|nullable',
						'col' => 'integer|nullable',
						'rows' => 'integer|nullable',
						'accept' => 'string|nullable',
						'multiple' => 'boolean|nullable|required_if:type,select',
						'tag' => 'string|nullable|required_if:type,static',
						'class' => 'string|nullable',
						'error_messages' => 'string|nullable',
						'actif' => 'boolean|nullable',
					];
				}
			case 'PUT':
				{
					return [
						'name' => 'alpha_dash|required',
						'formulaire_id' => 'integer|required',
						'backoffice' => 'boolean|required',
						'label_bo' => 'string|required',
						'label_fo' => 'string|required',
						'type' => 'string|required',
						'placeholder' => 'string|nullable',
						'value' => 'string|required_if:type,hidden|nullable',
						'min' => 'numeric|nullable',
						'max' => 'numeric|nullable',
						'step' => 'numeric|nullable',
						'col' => 'integer|nullable',
						'rows' => 'integer|nullable',
						'accept' => 'string|nullable',
						'multiple' => 'boolean|nullable|required_if:type,select',
						'tag' => 'string|nullable|required_if:type,static',
						'class' => 'string|nullable',
						'error_messages' => 'string|nullable',
						'actif' => 'boolean|nullable',
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
