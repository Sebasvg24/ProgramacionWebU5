<?php
require_once('conexion.php');
require_once('ORM.php');
require_once('deportiva.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $encontrado = $db->verificarDriver();

    if ($encontrado) {
        $cnn = $db->getConnection();
        $deportivaModelo = new Orm(null, 'deportiva', $cnn);

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
            header("Location: actualizarDeportiva.php?id={$actualizar['id']}&mensaje=" . urlencode($mensaje));
            exit;
        }

        if ($deportivaModelo->updateById($actualizar['id'], $actualizar)) {
            echo "<script>alert('Registro actualizado correctamente.'); window.location.href = 'vistaDeportiva.php';</script>";
            exit;
        } else {
            $mensaje = "Error al actualizar el registro.";
            header("Location: actualizarDeportiva.php?id={$actualizar['id']}&mensaje=" . urlencode($mensaje));
            exit;
        }
    } else {
        $mensaje = "Error al conectar con la base de datos.";
        header("Location: actualizarDeportiva.php?id={$actualizar['id']}&mensaje=" . urlencode($mensaje));
        exit;
    }
} else {
    $mensaje = "Método no permitido.";
    header("Location: actualizarDeportiva.php?id={$actualizar['id']}&mensaje=" . urlencode($mensaje));
    exit;
}
