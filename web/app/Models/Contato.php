<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    public $table = 'contatos';

    public $fillable = ['cpf', 'nome', 'sexo', 'telefone', 'email'];
}
