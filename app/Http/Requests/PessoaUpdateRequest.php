<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\rules\cpfValidate;

class PessoaUpdateRequest extends FormRequest
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
            'nome' => 'required',
            'sobrenome' => 'required',
            'cpf' => ['required','unique:pessoas', new cpfValidate, 'alpha_num', 'numeric'],
            'celular' => 'required|unique:pessoas',
            'logradouro' => 'required',
            'cep' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório!',
            'unique' => ':attribute já cadastrado no sistema!',
            'alpha_num' => 'Digite apenas os números do seu CPF!',
            'numeric'=> 'Digite apenas os números do seu CPF!'
        ];
    }

}
