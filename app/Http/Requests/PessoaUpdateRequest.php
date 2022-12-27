<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'nome' => 'nullable|string',
            'sobrenome' => 'nullable|string',
            'cpf' => 'nullable|string|min:11|max:11',
            'celular' => 'nullable|string',
            'logradouro' => 'nullable|string',
            'cep' => 'nullable|string|min:8|max:8',
        ];
    }
}
