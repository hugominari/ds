<?php

namespace App\Http\Requests;

use App\Models\Post;
use App\Models\Social;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
	public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
	    switch($this->method())
	    {
		    case 'POST':
			    return [
				    'title' => 'required|string',
				    'description' => 'required',
				    'date' => 'required',
			    ];
			    break;
		
		    case 'GET':
		    case 'DELETE':
			    return [];
			    break;
		
		    case 'PUT':
		    case 'PATCH':
			    return [
                    'title' => 'required|string',
                    'description' => 'required',
                    'date' => 'required',
			    ];
			    break;
	    }
	
	    return [];
    }



	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'title.required' => 'Titulo é obrigatório',
			'description.required' => 'Descrição é obrigatório',
			'date.required' => 'Data é obrigatória',
		];
	}
}
