<?php

require_once 'Database.php';
require_once 'Orm.php';


$database = new Database();
$conn = $database->getConnection();


$orm = new Orm(null, 'registro', $conn);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    

    if ($database->validarCorreo($email)) {
        echo "exists";
    } else {
        echo "not exists";
    }
}
?>
