<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateContatosRequest extends Request
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
        $this->sanitize();

        return [
            'cpf' => 'required|min:11|unique:contatos',
            'nome' => 'required|min:3',
            'sexo' => 'required',
            'telefone' => 'required|min:9',
            'email' => 'required|email|unique:contatos'
        ];
    }

    public function sanitize()
    {
        $input = $this->all();

        $input['cpf'] = preg_replace("/[^0-9]+/", "", $input['cpf']);
        $input['telefone'] = preg_replace("/[^0-9]+/", "", $input['telefone']);

        $this->replace($input);
    }
}
