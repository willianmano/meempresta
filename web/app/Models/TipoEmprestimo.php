<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TipoEmprestimo extends Model
{
    public $table = 'tipos_emprestimos';

    public $fillable = ['nome', 'descricao'];
}
