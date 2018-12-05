<?php

namespace App\Http\Requests;

use App\Models\Member;
use App\Models\MemberMandatory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MandatoryRequest extends FormRequest
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
	        $mandatory = MemberMandatory::findOrFail($id);
    
        $mandatoryId = isset($mandatory) ? ",{$mandatory->id}" : null;
	
	    switch($this->method())
	    {
		    case 'POST':
			    return [
				    'name' => "required|unique:mandatory,name" . $mandatoryId,
				    'date_start' => 'required',
				    'date_end' => 'required',
				    'directors' => "required",
				    'fiscals' => "required",
			    ];
			    break;
		
		    case 'GET':
		    case 'DELETE':
			    return [];
			    break;
		
		    case 'PUT':
		    case 'PATCH':
            return [
                    'name' => "required|unique:mandatory,name" . $mandatoryId,
                    'date_start' => 'required',
                    'date_end' => 'required',
                    'directors' => "required",
                    'fiscals' => "required",
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
			'directors.required' => 'Monte a Diretoria',
			'fiscals.required' => 'Monte o Conselho Fiscal',
			'date_start.required' => 'Informe a data de início',
			'date_end.required' => 'Informe a data de término',
			'date_start.date' => 'Este campo deve ser uma data',
			'date_end.date' => 'Este campo deve ser uma data',
			'date_end.before' => 'A data de término deve ser maior que a data de início',
		];
	}
}
