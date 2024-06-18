<?php
// Verificar si se recibió el ID del formulario
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    // Incluir los archivos necesarios
    require_once('conexion.php');
    require_once('ORM.php');
    require_once('cultural.php');

    // Conectar a la base de datos y obtener instancia del modelo
    $db = new DataBase();
    $encontrado = $db->verificarDriver();

    if ($encontrado) {
        $cnn = $db->getConnection();
        $culturalModelo = new Cultural($cnn);

        // Intentar eliminar el registro
        $eliminado = $culturalModelo->deleteById($id);

        if ($eliminado) {
            // Registro eliminado correctamente
            echo json_encode(['success' => true, 'id' => $id]);
        } else {
            // No se pudo eliminar el registro
            echo json_encode(['success' => false]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'ID no recibido para eliminar.']);
}
?>
