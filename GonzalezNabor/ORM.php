<?php
class Orm
{
    protected $id;
    protected $table;
    protected $db;
    function __construct($id, $table, PDO $conn)
    {
        $this->id = $id;
        $this->table = $table;
        $this->db = $conn;
    }
    function getAll()
    {
        $sql = "SELECT * FROM {$this->table}";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetchAll();
    }
    function getById($id)
    {
        $sql = "SELECT * FROM {$this->table} WHERE id={$id}";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        return $stm->fetch();
    }
    function deleteById($id)
    {
        $succes = false;
        $sql = "DELETE FROM {$this->table} WHERE id={$id}";
        $stm = $this->db->prepare($sql);
        $stm->execute();
        if ($stm->rowCount() > 0)
            $succes = true;
        return $succes;
    }
    function updateById($id, $data)
    {
        $sql = "UPDATE {$this->table} SET ";
        $set = [];
        foreach ($data as $key => $value) {
            if ($key !== 'id') {
                $set[] = "{$key} = :{$key}";
            }
        }
        $sql .= implode(', ', $set);
        $sql .= " WHERE id = :id";

        $data['id'] = $id;
        $stm = $this->db->prepare($sql);

        $success = false;
        try {
            $success = $stm->execute($data);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $success;
    }
    function insert($data)
    {
        $fields = implode(', ', array_keys($data));
        $placeholders = ':' . implode(', :', array_keys($data));
        $sql = "INSERT INTO {$this->table} ({$fields}) VALUES ({$placeholders})";

        $stm = $this->db->prepare($sql);

        foreach ($data as $key => $value) {
            $stm->bindValue(":{$key}", $value);
        }

        $success = false;
        try {
            $success = $stm->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $success;
    }
}
