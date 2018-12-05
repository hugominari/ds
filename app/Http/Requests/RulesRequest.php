<?php

namespace App\Http\Requests;

use App\Models\Social;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class RulesRequest extends FormRequest
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
				    'file' => 'required',
				    'text' => 'required|string',
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
			'file.required' => 'Arquivo é obrigatório',
			'text.required' => 'Descrição é obrigatória',
		];
	}
}
