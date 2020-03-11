<?php

namespace Modules\Domains\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DomainsRequest extends FormRequest
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
						'code' => 'required|string',
						'name' => 'required|string',
						'display_name' => 'required|string',
						'extension' => 'required|string|max:10',
						'google_analytics' => 'nullable|string',
						'google_webmastertool' => 'nullable|string',
						'google_maps' => 'nullable|string',
					];
				}
			case 'PUT':
				{
					return [
						'code' => 'required|string',
						'name' => 'required|string',
						'display_name' => 'required|string',
						'extension' => 'required|string|max:10',
						'google_analytics' => 'nullable|string',
						'google_webmastertool' => 'nullable|string',
						'google_maps' => 'nullable|string',
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
