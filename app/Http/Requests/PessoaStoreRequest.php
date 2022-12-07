<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\rules\cpfValidate;

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
            'nome' => 'required',
            'sobrenome' => 'required',
            'cpf' => ['required', 'unique', new cpfValidate],
            'celular' => 'required|unique',
            'logradouro' => 'required',
            'cep' => 'required|cep',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'O campo :attribute é obrigatório!',
            'cpf.unique' => ':attribute já cadastrado no sistema!',
        ];
    }
}
