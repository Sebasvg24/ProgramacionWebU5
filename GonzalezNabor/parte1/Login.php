

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="Css/EstilosBanner.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
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
                    <h1 class="text-white">Actividades Extraescolares</h1>
                </li>
            </ul>
            <ul class="nav">
                <li class="nav-item ml-auto">
                    <a href="Index.php">
                        <h3 class="opc-menulog">Inicio</h3>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="Registro.php">
                        <h3 class="opc-menulog">Registrarse</h3>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="card custom-for mb-5">
                    <div class="card-header text-center text-white custom-forlog">
                        <h3>Iniciar Sesion</h3>
                    </div>
                    <div class="card-body">
                        <form action="CheckUsuario.php" method="post">
                            <div class="form-group">
                                <label><i class="bi bi-person-fill"></i> Usuario</label>
                                <input type="email" placeholder="Email" name="usrName" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label><i class="bi bi-lock-fill"></i> Contraseña</label>
                                <input type="password" placeholder="Password" name="usrPwd" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" class="btn btn-success btn-block" value="Iniciar sesión">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="text-white text-center footer-est py-3 mt-5">
        <br>Integrantes:<br>
        Gonzalez Nabor Melanie <br>
        Marin Rodriguez Citlalli <br>
        López Espino Arlette Ivonne <br>
        Gómez Flores Alberto Alejandro <br>
        Vargas Garcia Erick Sebastian<br><br>
    </footer>
</body>

</html>