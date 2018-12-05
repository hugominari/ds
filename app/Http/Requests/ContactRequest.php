<?php

namespace App\Http\Requests;

use App\Models\Post;
use App\Models\Social;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ContactRequest extends FormRequest
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
            'email' => 'required|email',
            'subject' => 'required',
            'text' => 'required|string|min:10',
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
			'email.required' => 'Informe seu email.',
			'email.email' => 'Digite um email válido!',
			'subject.required' => 'Informe um assunto.',
			'text.required' => 'Digite uma mensagem.',
			'text.min' => 'Digite uma mensagem maior!',
		];
	}
}
