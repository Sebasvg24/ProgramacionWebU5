<?php

require_once 'Database.php'; 

class usuarios extends Orm {
    private $database;

    function __construct(Database $database)
    {
        parent::__construct('ID','usuarios',$database->getConnection());
        $this->database = $database;
    }

    function validaLogin($data){
        $sql = "SELECT * FROM {$this->table} WHERE ".$data;
        $stm = $this->db->prepare($sql);
        try {
            $stm->execute();
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
        return $stm->fetch();
    }

    function insertarRegistro($nombre, $apellidoP, $apellidoM, $correo, $contrasena, $rol)
    {
        return $this->database->insertarRegistro($nombre, $apellidoP, $apellidoM, $correo, $contrasena, $rol);
    }
    
}

?>
