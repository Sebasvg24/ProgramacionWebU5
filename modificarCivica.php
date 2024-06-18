<?php
require_once('conexion.php');
require_once('ORM.php');
require_once('civica.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $encontrado = $db->verificarDriver();

    if ($encontrado) {
        $cnn = $db->getConnection();
        $civicaModelo = new Orm(null, 'civica', $cnn);

        $actualizar = [
            'id' => $_POST['id'],
            'actividad' => $_POST['actividad'],
            'instructor' => $_POST['instructor'],
            'lunes' => $_POST['lunes'],
            'martes' => $_POST['martes'],
            'miercoles' => $_POST['miercoles'],
            'jueves' => $_POST['jueves'],
            'viernes' => $_POST['viernes']
        ];

        if (empty($actualizar['actividad']) || empty($actualizar['instructor'])) {
            $mensaje = "Error: Los campos 'actividad' e 'instructor' son obligatorios.";
            header("Location: actualizarCivica.php?id={$actualizar['id']}&mensaje=" . urlencode($mensaje));
            exit;
        }

        if ($civicaModelo->updateById($actualizar['id'], $actualizar)) {
            echo "<script>alert('Registro actualizado correctamente.'); window.location.href = 'vistaCivica.php';</script>";
            exit;
        } else {
            $mensaje = "Error al actualizar el registro.";
            header("Location: actualizarCivica.php?id={$actualizar['id']}&mensaje=" . urlencode($mensaje));
            exit;
        }
    } else {
        $mensaje = "Error al conectar con la base de datos.";
        header("Location: actualizarCivica.php?id={$actualizar['id']}&mensaje=" . urlencode($mensaje));
        exit;
    }
} else {
    $mensaje = "Método no permitido.";
    header("Location: actualizarCivica.php?id={$actualizar['id']}&mensaje=" . urlencode($mensaje));
    exit;
}
