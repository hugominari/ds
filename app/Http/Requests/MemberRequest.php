<?php

namespace App\Http\Requests;

use App\Models\Member;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class MemberRequest extends FormRequest
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
	        $member = Member::findOrFail($id);
	    
	    $memberId = isset($member) ? ",{$member->id}" : null;
	
	    switch($this->method())
	    {
		    case 'POST':
			    return [
				    'name' => 'required|string',
				    'email' => "required|email|unique:members,email",
			    ];
			    break;
		
		    case 'GET':
		    case 'DELETE':
			    return [];
			    break;
		
		    case 'PUT':
		    case 'PATCH':
            return [
                    'name' => 'required|string',
                    'email' => "required|email|unique:members,email" . $memberId,
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
			'email.required' => 'Email é obrigatório',
			'email.unique' => 'Este email já esta sendo utilizado',
			'email.email' => 'Informe um email válido!',
		];
	}
}
