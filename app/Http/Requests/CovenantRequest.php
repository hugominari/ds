<?php

namespace App\Http\Requests;

use App\Models\Covenant;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CovenantRequest extends FormRequest
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
	        $covenant = Covenant::findOrFail($id);
    
        $covenantId = isset($covenant) ? ",{$covenant->id}" : null;
	
	    switch($this->method())
	    {
		    case 'POST':
			    return [
                    'name' => 'required|string|unique:covenants,name',
                    'url' => 'nullable|url|unique:covenants,url',
                    'description' => 'nullable',
			    ];
			    break;
		
		    case 'GET':
		    case 'DELETE':
			    return [];
			    break;
		
		    case 'PUT':
		    case 'PATCH':
			    return [
                    'name' => 'required|string|unique:covenants,name' . $covenantId,
                    'url' => 'nullable|url|unique:covenants,url' . $covenantId,
                    'description' => 'nullable'
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
			'name.unique' => 'Já existe um convênio com este nome',
			'url.required' => 'Url é obrigatória',
			'url.url' => 'Url inválida',
			'url.unique' => 'Já existe um convênio com este site',
		];
	}
}
