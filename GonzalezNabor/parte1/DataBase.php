<?php

class Database
{
    private $connection;

    public function __construct()
    {
        $this->getConnection();
    }
 
    public function verificarDriver()
    {
        $miArray = PDO::getAvailableDrivers();
        $encontrado = false;
        foreach ($miArray as $n) {
            if ($n == 'mysql') {
                $encontrado = true;
                break;
            }
        }
        return $encontrado;
    }

    public function getConnection()
    {
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ];

        $dsn = "mysql:host=localhost;dbname=extraescolaresdb"; 
        $user = "root";
        $password = "";

        try {
            $this->connection = new PDO($dsn, $user, $password, $options);
            $this->connection->exec("SET CHARACTER SET UTF8");
        } catch (PDOException $e) {
            echo "Error de conexión: " . $e->getMessage();
            die();
        }

        return $this->connection;
    }

    public function insertarRegistro($nombre, $app, $apm, $correo, $pswwd, $rol)
    {
        try {
            $sql = "INSERT INTO registro (Nombre, ApellidoP, ApellidoM, Correo, Contraseña, Rol) VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$nombre, $app, $apm, $correo, $pswwd, $rol]);
            return true; 
        } catch (PDOException $e) {
            echo "Error al insertar registro: " . $e->getMessage();
            return false; 
        }
    }

    public function validarCorreo($correo) {
        try {
   
            $sql = "SELECT Correo FROM registro WHERE Correo = :correo";
            $stmt = $this->connection->prepare($sql);
            
           
            $stmt->execute(['correo' => $correo]);
            
           
            if ($stmt->fetch()) {
                return true; 
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
}
?>
