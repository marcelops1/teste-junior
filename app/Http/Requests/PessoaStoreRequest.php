<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoaStoreRequest extends FormRequest
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
            'nome' => 'required|string',
            'sobrenome' => 'required|string',
            'cpf' => 'required|string|min:11|max:11|unique:pessoas',
            'celular' => 'required|string',
            'logradouro' => 'required|string',
            'cep' => 'required|string|min:8|max:8',
        ];
    }
}
