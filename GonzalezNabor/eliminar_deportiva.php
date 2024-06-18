<?php

if (isset($_POST['id'])) {
    $id = $_POST['id'];


    require_once('conexion.php');
    require_once('ORM.php');
    require_once('deportiva.php');

    $db = new DataBase();
    $encontrado = $db->verificarDriver();

    if ($encontrado) {
        $cnn = $db->getConnection();
        $deportivaModelo = new Deportiva($cnn);


        $eliminado = $deportivaModelo->deleteById($id);

        if ($eliminado) {

            echo json_encode(['success' => true, 'id' => $id]);
        } else {

            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID no recibido para eliminar.']);
}
?>
