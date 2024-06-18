<?php
require_once('conexion.php');
require_once('ORM.php');
require_once('cultural.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $encontrado = $db->verificarDriver();

    if ($encontrado) {
        $cnn = $db->getConnection();
        $culturalModelo = new Orm(null, 'cultural', $cnn);

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
            header("Location: actualizarCultural.php?id={$actualizar['id']}&mensaje=" . urlencode($mensaje));
            exit;
        }

        if ($culturalModelo->updateById($actualizar['id'], $actualizar)) {
            echo "<script>alert('Registro actualizado correctamente.'); window.location.href = 'vistaCultural.php';</script>";
            exit;
        } else {
            $mensaje = "Error al actualizar el registro.";
            header("Location: actualizarCultural.php?id={$actualizar['id']}&mensaje=" . urlencode($mensaje));
            exit;
        }
    } else {
        $mensaje = "Error al conectar con la base de datos.";
        header("Location: actualizarCultural.php?id={$actualizar['id']}&mensaje=" . urlencode($mensaje));
        exit;
    }
} else {
    $mensaje = "Método no permitido.";
    header("Location: actualizarCultural.php?id={$actualizar['id']}&mensaje=" . urlencode($mensaje));
    exit;
}
