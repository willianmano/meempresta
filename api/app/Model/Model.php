<?php

namespace ME\Model;

use Silex\Application;
use Doctrine\DBAL\Connection;

abstract class Model
{
    protected $conn;
    protected $rules;
    public $sequenceName;
    public $timestamps = true;

    abstract public function getTableName();

    public function __construct(Connection $conn)
    {
        $this->conn = $conn;

        $this->setRules();
    }

    public function validate($data)
    {
        if (empty($this->rules)) {
            return true;
        }

        $this->getRules()->assert((object)$data);

        return true;
    }

    protected function setRules()
    {
        $this->rules = null;
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function find($identifier)
    {
        return $this->conn->fetchAssoc(sprintf('SELECT * FROM %s WHERE id = ? LIMIT 1', $this->getTableName()), array((int) $identifier));
    }

    public function findBy(array $params, array $fields = null)
    {
        $sql = sprintf("SELECT * FROM %s WHERE 1 = 1", $this->getTableName());

        if (!is_null($fields)) {
            $sql = sprintf("SELECT ".implode(",", $fields)." FROM %s WHERE 1 = 1", $this->getTableName());
        }

        foreach (array_keys($params) as $field) {
            $sql .= " AND {$field} = :{$field}";
        }

        return $this->conn->fetchAssoc($sql, $params);
    }

    public function findAll(array $fields = null)
    {
        if (is_null($fields)) {
            return $this->conn->fetchAll(sprintf('SELECT * FROM %s', $this->getTableName()));
        }

        return $this->conn->fetchAll(sprintf('SELECT '.implode(",", $fields). ' FROM %s', $this->getTableName()));
    }

    public function findWhere($params)
    {
        $sql = sprintf("SELECT * FROM %s WHERE 1 = 1", $this->getTableName());

        foreach (array_keys($params) as $field) {
            $sql .= " AND {$field} = :{$field}";
        }

        $stmt = $this->conn->executeQuery($sql, $params);

        return $stmt->fetchAll();
    }

    public function queryAll($sql, array $params = null)
    {
        $stmt = $this->conn->prepare($sql);

        $stmt->execute($params);

        return $stmt->fetchAll();
    }

    public function query($sql, array $params = null)
    {
        $stmt = $this->conn->prepare($sql);

        $stmt->execute($params);

        return $stmt->fetch();
    }

    public function insert(array $data)
    {
        try {
            if ($this->timestamps) {
                $data['created_at'] = date('d-m-Y H:i:s');
                $data['updated_at'] = date('d-m-Y H:i:s');
            }

            $this->conn->beginTransaction();

            $this->conn->insert($this->getTableName(), $data);

            $this->conn->commit();

            return $this->conn->lastInsertId($this->sequenceName);
        } catch (\Exception $e) {
            $this->conn->rollBack();

            throw $e;
        }
    }

    public function update(array $data, array $identifier)
    {
        return $this->conn->update($this->getTableName(), $data, $identifier);
    }

    public function delete(array $identifier)
    {
        return $this->conn->delete($this->getTableName(), $identifier);
    }
}
