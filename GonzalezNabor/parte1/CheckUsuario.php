<?php
session_start();

require_once 'Database.php';
require_once 'Orm.php';

$database = new Database();
$conn = $database->getConnection();

$orm = new Orm(null, 'registro', $conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'usrName', FILTER_SANITIZE_EMAIL);
    $password = $_POST['usrPwd'];

    // Validar usuario por correo electrónico
    $usuario = $orm->validarUsuario($email);

    if ($usuario) {
        // Comparar la contraseña ingresada con la almacenada (asumiendo que está en texto plano)
        if ($password === $usuario['Contraseña']) {
            // Inicio de sesión exitoso, establecer variables de sesión
            $_SESSION['usuario_id'] = $usuario['id_user'];
            $_SESSION['usuario_nombre'] = $usuario['Nombre'];
            $_SESSION['usuario_rol'] = $usuario['Rol'];

            // Redireccionar según el rol del usuario
            if ($usuario['Rol'] === 'administrador') {
                header('Location: Administrador.php');
                exit();
            } else if ($usuario['Rol'] === 'alumno') {
                header('Location: Alumno.php');
                exit();
            }
        } else {
            // Contraseña incorrecta
            echo '<div class="alert alert-danger text-center mt-3" role="alert">Contraseña incorrecta.</div>';
        }
    } else {
        // Usuario no encontrado
        echo '<div class="alert alert-danger text-center mt-3" role="alert">Usuario no encontrado.</div>';
    }
} else {
    // Si no es un envío POST, redireccionar al formulario de inicio de sesión
    header('Location: Login.php');
    exit();
}
?>
