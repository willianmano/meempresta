<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateEmprestimosRequest extends Request
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
            'contato_id' => 'required',
            'tipo_emprestimo_id' => 'required',
            'titulo' => 'required|min:3',
            'devolucao' => 'required'
        ];
    }
}
