<?php

require_once 'Database.php';


$database = new Database();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = filter_input(INPUT_POST, 'usrName', FILTER_SANITIZE_STRING);
    $app = filter_input(INPUT_POST, 'usrAp', FILTER_SANITIZE_STRING);
    $apm = filter_input(INPUT_POST, 'usrAm', FILTER_SANITIZE_STRING);
    $correo = filter_input(INPUT_POST, 'usrEmail', FILTER_SANITIZE_EMAIL);
    $pswwd = $_POST['usrPwd'];
    $rol = $_POST['usrRol'];


    if ($database->insertarRegistro($nombre, $app, $apm, $correo, $pswwd, $rol)) {
        header('Location: RegistroExitoso.php');
    } else {
        echo "Error al insertar registro.";
    }
}
?>

