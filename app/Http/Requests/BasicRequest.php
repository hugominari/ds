<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class BasicRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
	    $params = $this->route()->parameters();
	    $id = isset($params['id']) ? $params['id'] : $this->id;
	    $record = !empty($id) ? ",{$id}" : '';
	    
	    Log::debug($this->model);

    	switch($this->method())
	    {
		    case 'POST':
            case 'PUT':
            case 'PATCH':
		    	switch($this->model)
			    {
				    case 'websites':
					    return [
						    'name' => 'required|string|unique:websites,name' . $record,
						    'url' => 'required|url',
						    'type' => 'required|integer',
					    ];
				        break;
				    case 'feeds':
					    return [
						    'name' => 'required|string|unique:feeds,name' . $record,
                            'url' => 'required|string|url',
					    ];
				        break;
				    case 'positions':
					    return [
						    'name' => 'required|string|unique:positions,name' . $record,
                            'type' => 'required|integer',
					    ];
				        break;
				    case 'type_calls':
					    return [
						    'name' => 'required|string|unique:type_calls,name' . $record,
					    ];
				        break;
			    }
	        break;
		    	
		    case 'GET':
		    case 'DELETE':
		        return [];
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
            'name.required'                 => 'O nome é obrigatorio',
            'name.unique'                   => 'Já existe uma instancia com esse nome',
            'url.required'                  => 'Insira uma url!',
            'url.url'                       => 'Insita uma url válida!',
            'type.required'                 => 'Escolha um tipo',
        ];
    }
}
