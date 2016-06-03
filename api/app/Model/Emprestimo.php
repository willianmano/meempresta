<?php

namespace ME\Model;

class Emprestimo extends Model
{
    /**
     * Retorna o nome da tabela do modelo
     *
     * @return string
     */
    public function getTableName()
    {
        return 'emprestimos';
    }

    public function getAllEmprestimos()
    {
        $sql = "SELECT e.id, e.titulo, e.devolucao, c.nome, te.nome, IF(e.status = 'aberto', false, true) as devolvido
                FROM emprestimos e
                INNER JOIN contatos c ON c.id = e.contato_id
                INNER JOIN tipos_emprestimos te ON te.id = e.tipo_emprestimo_id";

        return $this->queryAll($sql);
    }

    public function mudarStatus($idEmprestimo, $novoStatus)
    {
        return $this->update(['status' => $novoStatus], ['id' => $idEmprestimo]);
    }
}
