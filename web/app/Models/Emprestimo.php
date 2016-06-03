<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Emprestimo extends Model
{
    public $table = 'emprestimos';

    public $fillable = ['usuario_id', 'contato_id', 'tipo_emprestimo_id', 'titulo', 'obs', 'devolucao'];

    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuario');
    }
}
