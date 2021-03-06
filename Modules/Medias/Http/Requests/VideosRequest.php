<?php

namespace Modules\Medias\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VideosRequest extends FormRequest
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
							'description' => 'string',
							'url' => 'url|required',
							'actif' => 'boolean',
						];
					}
				case 'PUT':
					{
						return [
							'title' => 'required|min:3',
							'description' => 'string',
							'url' => 'url',
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
