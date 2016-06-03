<?php

namespace App\Repositories;

use Bosnadev\Repositories\Eloquent\Repository;
use DB;

class EmprestimoRepository extends Repository
{
    /**
     * Specify Model class name.
     *
     * @return string
     */
    public function model()
    {
        return \App\Models\Emprestimo::class;
    }

    public function getAllByUsuario($usuarioId)
    {
        $sql = "SELECT
                    e.*, c.nome as credor
                FROM emprestimos e
                INNER JOIN contatos c ON c.id = e.contato_id
                WHERE e.usuario_id = :usuarioid
                ORDER BY e.status";

        return DB::select($sql, ['usuarioid' => $usuarioId]);
    }

    public function getDevedores()
    {
        $sql = "SELECT
                    DISTINCT c.id, c.nome, c.telefone, c.email
                FROM emprestimos e
                INNER JOIN contatos c ON c.id = e.contato_id
                WHERE e.status <> 'fechado'";

        return DB::select($sql);
    }
}
