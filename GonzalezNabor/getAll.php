<?php
require_once('conexion.php');
require_once('ORM.php');
require_once('cultural.php');
require_once('deportiva.php');
require_once('civica.php');

function obtenerDatos() {
    $db = new DataBase();
    $encontrado = $db->verificarDriver();

    if ($encontrado) {
        $cnn = $db->getConnection();
        $culturalModelo = new Cultural($cnn);
        $deportivaModelo = new Deportiva($cnn);
        $civicaModelo = new Civica($cnn);

        $culturales = $culturalModelo->getAll();
        $deportivas = $deportivaModelo->getAll();
        $civicas = $civicaModelo->getAll();
        return [
            'culturales' => $culturales,
            'deportivas' => $deportivas,
            'civicas' => $civicas
        ];
    } else {
        return null;
    }
}

function printData($data, $title) {
    print ("================================================<br>");
    print ($title . "<br>");
    print ("================================================<br>");
    foreach ($data as $registro) { 
        print ("ID: " . $registro['id'] . "<br>");
        print ("ACTIVIDAD: " . $registro['actividad'] . "<br>");
        print ("INSTRUCTOR: " . $registro['instructor'] . "<br>");
        print ("LUNES: " . $registro['lunes'] . "<br>");
        print ("MARTES: " . $registro['martes'] . "<br>");
        print ("MIÉRCOLES: " . $registro['miercoles'] . "<br>");
        print ("JUEVES: " . $registro['jueves'] . "<br>");
        print ("VIERNES: " . $registro['viernes'] . "<br>");
        print ("------------------------------------------------<br>");
    }
}
?>
