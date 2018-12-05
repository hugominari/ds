<?php

namespace App\Http\Requests;

use App\Models\Social;
use App\Models\Website;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class WebsiteRequest extends FormRequest
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
	        $site = Website::findOrFail($id);
    
        $siteId = isset($site) ? ",{$site->id}" : null;
	
	    switch($this->method())
	    {
		    case 'POST':
			    return [
                    'name' => 'required|string|unique:websites,name',
                    'url' => 'required|url|unique:websites,url',
                    'type' => 'required|integer',
			    ];
			    break;
		
		    case 'GET':
		    case 'DELETE':
			    return [];
			    break;
		
		    case 'PUT':
		    case 'PATCH':
			    return [
                    'name' => 'required|string|unique:websites,name' . $siteId,
                    'url' => 'required|url|unique:websites,url' . $siteId,
                    'type' => 'required|integer',
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
			'type.required' => 'Escolha um tipo de site',
			'type.integer' => 'Escolha um tipo de site',
		];
	}
}
