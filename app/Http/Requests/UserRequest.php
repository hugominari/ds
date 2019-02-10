<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserRequest extends FormRequest
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
        $currentUser = Auth::user();
	    $params = $this->route()->parameters();
	    $id = isset($params['id']) ? $params['id'] : '';
	    
	    if(!empty($id))
	        $user = User::findOrFail($id);
	    
	    $userId = isset($user) ? ",{$user->id}" : null;
	    $discardPerms = (isset($user->id) && ($currentUser->id == $user->id));
	    
	    switch($this->method())
	    {
		    case 'POST':
			    return [
				    'name' => 'required|string',
				    'username' => "required|regex:/^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/|unique:users,username",
				    'password' => 'required|min:8|confirmed',
				    'profile' => 'required|numeric',
				    'permissions' => 'required|array',
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
				    'username' => "required|regex:/^[a-zA-Z][a-zA-Z0-9-_\.]{1,20}$/|unique:users,username{$userId}",
				    // 'password' => 'required|min:8|confirmed',
				    'profile' => 'required|numeric',
				    'permissions' => !$discardPerms ? 'required|array' : 'nullable',
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
			'username.required' => 'Nome de usuário é obrigatório',
			'username.unique' => 'Nome de usuário já esta sendo utilizado',
			'username.regex' => 'Nome de usuário é invalido',
			'password.required' => 'Senha é obrigatório',
			'password.min' => 'Senha deve conter no minimo 8 digitos',
			'password.confirmed' => 'Você precisa confirmar sua senha',
			'profile.required' => 'Perfil é obrigatório',
			'permissions.required' => 'Selecione as permissoes do usuario',
		];
	}
}
