<?php

namespace Modules\Formulaires\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AnswersRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
		switch ($this->method()) {
			case 'POST':
				{
					return [
						'formulaire_id' => 'integer|required',
					];
				}
			case 'PUT':
				{
					return [
						'formulaire_id' => 'integer|required',
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
