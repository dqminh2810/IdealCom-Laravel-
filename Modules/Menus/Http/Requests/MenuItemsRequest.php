<?php

namespace Modules\Menus\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuItemsRequest extends FormRequest
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
						'menu_id' => 'integer|required',
						//'left' => 'integer|required',
						//'right' => 'integer|required',
						//'parent_id' => 'integer|required',
						'hidden' => 'boolean|required',
						'readonly' => 'boolean|required',
						'url' => 'url|nullable',
						'target' => 'string|required',
						'actif' => 'boolean',
					];
				}
			case 'PUT':
				{
					return [
						'name' => 'alpha_dash|required',
						'display_name' => 'string|required',
						'menu_id' => 'integer|required',
						//'left' => 'integer|required',
						//'right' => 'integer|required',
						//'parent_id' => 'integer|required',
						'hidden' => 'boolean|required',
						'readonly' => 'boolean|required',
						'url' => 'url|nullable',
						'target' => 'string|required',
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
