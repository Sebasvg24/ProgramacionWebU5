<?php 
class Orm{
    protected $id;
    protected $table;
    protected $db;
    function __construct($id, $table,PDO $conn)
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

  function count()
  {

    return count($this->getAll());
  }

  function lastID()
  {
    $sql = "SELECT * FROM {$this->table} ORDER BY id DESC LIMIT 1";
    $stm = $this->db->prepare($sql);
    $stm->execute();
    return $stm->fetch();
  }

  function getById($id)
  {
    $sql = "SELECT * FROM {$this->table} WHERE id={$id}";
    $stm = $this->db->prepare($sql);
    try {
      $stm->execute();
      return $stm->fetch();
    } catch (PDOException $e) {
      echo "" . $e->getMessage() . "";
      return false;
    }
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
    foreach ($data as $key => $value) {
      $sql .= " {$key} = :{$key}, ";
    }

    // echo "<br>";
    // echo $sql;
    // echo "<br>";

    $fin = strrpos("$sql", ",");
    $sql = substr($sql, 0, $fin);
    $sql .= " WHERE id = :id";

    // echo $sql;
    // echo "<br>";

    $data['id'] = $id;
    $stm = $this->db->prepare($sql);

    $succes = false;
    try {
      $succes = $stm->execute($data);
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
    return $succes;
  }


  function insert($data)
  {
    $sql = "INSERT INTO {$this->table} (";
    foreach ($data as $key => $value) {
      $sql .= " {$key}, ";
    }
    $fin = strrpos("$sql", ",");
    $sql = substr($sql, 0, $fin);
    $sql .= ") VALUES (";
    foreach ($data as $key => $value) {
      $sql .= ":{$key}, ";
    }
    $fin = strrpos("$sql", ",");
    $sql = substr($sql, 0, $fin);
    $sql .= ")";

    echo "<br>";
    echo $sql;
    echo "<br>";

    $stm = $this->db->prepare($sql);

    $succes = false;
    try {
      $succes = $stm->execute($data);
    } catch (PDOException $ex) {
      echo $ex->getMessage();
    }
    return $succes;
  }

  public function validarUsuario($email) {
    try {
        $sql = "SELECT * FROM registro WHERE Correo = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); // Devuelve el usuario encontrado o null si no existe
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
        return null;
    }
}


}


?>