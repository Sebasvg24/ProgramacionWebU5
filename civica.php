<?php
class Civica extends Orm {
    function __construct(PDO $conexion) {
        parent::__construct('id', 'civica', $conexion);
    }
}
?>