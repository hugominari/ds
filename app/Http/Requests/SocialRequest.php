<?php

namespace App\Http\Requests;

use App\Models\Social;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class SocialRequest extends FormRequest
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
	    $params = $this->route()->parameters();
	    $id = isset($params['id']) ? $params['id'] : '';
	    
	    if(!empty($id))
	        $social = Social::findOrFail($id);
	    
	    $socialId = isset($social) ? ",{$social->id}" : null;
	
	    switch($this->method())
	    {
		    case 'POST':
			    return [
				    'name' => 'required|string|unique:socials,name',
				    'url' => 'required|url',
				    'icon' => 'required|string|unique:socials,icon',
			    ];
			    break;
		
		    case 'GET':
		    case 'DELETE':
			    return [];
			    break;
		
		    case 'PUT':
		    case 'PATCH':
			    return [
				    'name' => 'required|string|unique:socials,name' . $socialId,
				    'url' => 'required|url',
				    'icon' => 'required|string|unique:socials,icon' . $socialId,
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
			'name.required' => 'Nome é obrigatório',
			'name.unique' => 'Já existe uma rede com este nome',
			'url.required' => 'Url é obrigatória',
			'url.url' => 'Url inválida',
			'icon.required' => 'Escolha um icone',
			'icon.unique' => 'Já existe uma rede com este icone',
		];
	}
}
