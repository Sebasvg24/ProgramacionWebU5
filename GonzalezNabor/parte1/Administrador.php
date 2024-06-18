<?php
session_start();


if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_rol'] !== 'administrador') {
    header('Location: Login.php');
    exit;
}

$Nombre_Sesion_Activa = isset($_SESSION['usuario_nombre']) ? $_SESSION['usuario_nombre'] : 'Invitado';
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Css/EstilosBanner.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../parte1/css/estilos.css">
    <link rel="stylesheet" href="../parte1/css/EstilosBanner.css">
    
</head>

<body>
    <div class="container-fluid">
        <div class="jumbotron bg-image text-center py-5 mb-4" style="background-image: url('fotos/Atletismo.jpg');">
            <h1 class="mt-3 texto-uno">¡Alumnos, los invitamos a inscribirse y disfrutar de nuestra actividad extraescolares!</h1>
            <h2 class="mt-3 texto-dos">TODO ES UN BALANCE</h2>
        </div>
        <nav class="navbar navbar-dark custom-forlog">
            <ul class="nav mr-auto">
                <li class="nav-item">
                    <img src="fotos/Logo.jpg" alt="mi logo" width="50px" height="50px">
                </li>
                <li class="nav-item">
                    <a href="Index.php"><h1 class="text-white">Actividades Extraescolares</h1></a>
                </li>
            </ul>
            <ul class="nav">
                <li class="nav-item">
                    <h6 class="text-white">
                  Bienvenido <?php echo $Nombre_Sesion_Activa;?> (Administrador)
                    </h6>
                </li>
            </ul>
        </nav>

        <!-- Contenido de la página -->
        <div class="container-fluid">
            <br>
            <center>
                <a href="../vistaCultural.php" class="boton-actividades">Vista Actividades Culturales</a>
                <a href="../vistaDeportiva.php" class="boton-actividades">Vista Actividades Deportivas</a>
                <a href="../vistaCivica.php" class="boton-actividades">Vista Actividades Cívicas</a>
            </center>
        </div>

        <div class="container-fluid" id="logodown">
            <br>
            <center><img src="fotos/logo.jpg" width="600px" height="400px" ></center>
        </div>

        <footer class="text-white text-center footer-est py-3 mt-5">
            <br>Integrantes:<br>
            Gonzalez Nabor Melanie <br>
            Marin Rodriguez Citlalli <br>
            López Espino Arlette Ivonne <br>
            Gómez Flores Alberto Alejandro <br>
            Vargas Garcia Erick Sebastian<br><br>
        </footer>
    </div>
</body>

</html>
