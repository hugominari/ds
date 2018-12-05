<?php

namespace App\Http\Requests;

use App\Models\Post;
use App\Models\Social;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AttendanceRequest extends FormRequest
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
        return [
            'name' => 'required|string|min:3',
            'cpf' => 'required|min:11',
            'description' => 'required',
        ];
    }



	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [
			'name.required' => 'Digite seu nome.',
			'name.min' => 'Digite um nome válido!',
			'cpf.required' => 'Informe o CPF.',
			'cpf.min' => 'Digite um CPF válido!',
			'description.required' => 'Digite uma descrição.',
		];
	}
}
