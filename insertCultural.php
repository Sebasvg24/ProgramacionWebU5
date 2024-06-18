<?php
require_once('conexion.php');
require_once('ORM.php');
require_once('cultural.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $encontrado = $db->verificarDriver();

    if ($encontrado) {
        $cnn = $db->getConnection();
        $culturalModelo = new Cultural($cnn);

        $insertar = [
            'actividad' => $_POST['actividad'],
            'instructor' => $_POST['instructor'],
            'lunes' => $_POST['lunes'],
            'martes' => $_POST['martes'],
            'miercoles' => $_POST['miercoles'],
            'jueves' => $_POST['jueves'],
            'viernes' => $_POST['viernes']
        ];

        if (empty($insertar['actividad']) || empty($insertar['instructor'])) {
            echo "<script>alert('Error: Los campos \"actividad\" e \"instructor\" son obligatorios.');</script>";
        } else {
            if ($culturalModelo->insert($insertar)) {
                echo "<script>alert('Registro añadido'); window.location.href = 'agregarCultural.php';</script>";
                exit;
            } else {
                echo "<script>alert('Error al añadir el registro');</script>";
            }
        }
    } else {
        echo "<script>alert('Error al conectar con la base de datos.');</script>";
    }
} else {
    echo "<script>alert('Método no permitido.');</script>";
}
