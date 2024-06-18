<?php
class Cultural extends Orm {
    function __construct(PDO $conexion) {
        parent::__construct('id', 'cultural', $conexion);
    }
}
?>