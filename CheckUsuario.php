<?php

require_once 'Database.php';
require_once 'Orm.php';


$database = new Database();
$conn = $database->getConnection();


$orm = new Orm(null, 'registro', $conn);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = filter_input(INPUT_POST, 'usrName', FILTER_SANITIZE_EMAIL);
    $password = $_POST['usrPwd']; 

    
    $usuario = $orm->validarUsuario($email);

 
    if ($usuario) {
        echo "Usuario encontrado: " . $usuario['Correo'] . "<br>";
       
        echo "Contraseña almacenada: " . $usuario['Contraseña'] . "<br>";
        echo "Contraseña ingresada (sin hash): " . $password . "<br>";
    } else {
        echo "Usuario no encontrado para el correo: " . $email . "<br>";
    }

   
    if ($usuario && isset($usuario['Contraseña']) && $password === $usuario['Contraseña']) {
        
        if ($usuario['Rol'] === 'administrador') {
           
            header('Location: Administrador.php');
            exit;
        } else if ($usuario['Rol'] === 'alumno') {
           
            header('Location: Alumno.php');
            exit;
        }
    } else {
        
        echo '<div class="alert alert-danger text-center mt-3" role="alert">Usuario o contraseña incorrectos.</div>';
    }
}
?>
