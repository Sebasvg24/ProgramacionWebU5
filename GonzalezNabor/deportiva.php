<?php
class Deportiva extends Orm {
    function __construct(PDO $conexion) {
        parent::__construct('id', 'deportiva', $conexion);
    }
}
?>