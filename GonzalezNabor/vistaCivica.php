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
    <link rel="stylesheet" href="Css/EstilosBanner.css"
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/udm/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
   
    <link rel="stylesheet" href="css/modal.css">

<link rel="stylesheet" href="css/estilos.css">
<link rel="stylesheet" href="parte1/css/EstilosBanner.css">

</head>

<body>
<div class="container-fluid">
    <div class="jumbotron bg-image text-center py-5 mb-4" style="background-image: url('parte1/fotos/Atletismo.jpg');">
        <h1 class="mt-3 texto-uno">¡Alumnos, los invitamos a inscribirse y disfrutar de nuestra actividad extraescolares!</h1>
        <h2 class="mt-3 texto-dos">TODO ES UN BALANCE</h2>
    </div>
    <nav class="navbar navbar-dark custom-forlog">
    <ul class="nav mr-auto">
        <li class="nav-item">
            <img src="fotos/Logo.jpg" alt="mi logo" width="50px" height="50px">
        </li>
        <li class="nav-item">
        <a href="parte1/Index.php"><h1 class="text-white">Actividades Extraescolares</h1></a>
        </li>
    </ul>
    <ul class="nav">
                <li class="nav-item">
                    <h6 class="text-white">
                  Bienvenido <?php echo $Nombre_Sesion_Activa;?> (Administrador)
                    </h6>
                </li>
            </ul>

        
    </ul>
</nav>

    <div class="container">
        <?php
        require_once('getAll.php');

        $datos = obtenerDatos();

        if ($datos !== null) {
            $civicas = $datos['civicas'];
            // Mostrar actividades cívicas
            echo "<h1 class='civica'>ACTIVIDADES CIVICAS</h1>";
            echo "<table class='table table-striped'>";
            echo "<thead><tr>
                    <th>ID</th>
                    <th>Actividad</th>
                    <th>Instructor</th>
                    <th>Lunes</th>
                    <th>Martes</th>
                    <th>Miércoles</th>
                    <th>Jueves</th>
                    <th>Viernes</th>
                    <th>Acciones</th>
                  </tr></thead>";
            echo "<tbody>";
            foreach ($civicas as $civica) {
                echo "<tr id='fila{$civica['id']}'>
                        <td>{$civica['id']}</td>
                        <td>{$civica['actividad']}</td>
                        <td>{$civica['instructor']}</td>
                        <td>{$civica['lunes']}</td>
                        <td>{$civica['martes']}</td>
                        <td>{$civica['miercoles']}</td>
                        <td>{$civica['jueves']}</td>
                        <td>{$civica['viernes']}</td>
                       <td class='text-center'>
                            <div class='d-flex justify-content-center'>
                                <button class='btn btn-ver' onclick='verDetalles(". json_encode($civica) .")'>Ver</button>
                                <a href='actualizarCivica.php?id={$civica['id']}' class='btn btn-modificar'>Modificar</a>
                                <form method='post' action='eliminar_civica.php' id='formEliminar{$civica['id']}'>
                                    <input type='hidden' name='id' value='{$civica['id']}' />
                                    <button type='button' class='btn btn-eliminar' onclick='confirmarEliminacion({$civica['id']})'>Eliminar</button>
                                </form>
                            </div>
                        </td>
                      </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p>Error al conectar con la base de datos.</p>";
        }
        ?>
        <br>
        <a href="agregarCivica.php" class="btn btn-agregar">Agregar</a>
        <br>
        <a href="parte1/Administrador.php" class="btn-regresar">Regresar</a>
    </div>
        
    <footer class="text-white text-center footer-est py-3 mt-5">
            <br>Integrantes:<br>
            Gonzalez Nabor Melanie <br>
            Marin Rodriguez Citlalli <br>
            López Espino Arlette Ivonne <br>
            Gómez Flores Alberto Alejandro <br>
            Vargas Garcia Erick Sebastian<br><br>
        </footer>


    
      
        <div id="modalConfirmacion" class="modal">
            <div class="modal-content">
                <p>¿Seguro que desea eliminar este registro?</p>
                <div class="modal-buttons">
                    <button class="btn btn-cancelar-modal" onclick="cerrarModal()">Cancelar</button>
                    <button class="btn btn-eliminar" onclick="eliminarRegistro()">Eliminar</button>
                </div>
            </div>
        </div>

 
        <div id="modalMensajeEliminado" class="modal">
            <div class="modal-content">
                <p>Registro eliminado correctamente.</p>
                <div class="modal-buttons">
                    <button class="btn btn btn-cancelar-modal" onclick="cerrarMensajeEliminado()">Aceptar</button>
                </div>
            </div>
        </div>

   
        <div id="modalDetalles" class="modal">
            <div class="modal-content">
                <h4>Detalles de la Actividad</h4>
                <div id="detallesActividad"></div>
                <div class="modal-buttons">
                    <button class="btn btn btn-cancelar-modal" onclick="cerrarModalDetalles()">Cerrar</button>
                </div>
            </div>
        </div>

        <script>
  
        function confirmarEliminacion(id) {
            var modal = document.getElementById('modalConfirmacion');
            var form = document.getElementById('formEliminar' + id);
            modal.style.display = 'block';

          
            window.currentForm = form;
        }

 
        function cerrarModal() {
            var modal = document.getElementById('modalConfirmacion');
            modal.style.display = 'none';
        }

   
        function cerrarMensajeEliminado() {
            var modal = document.getElementById('modalMensajeEliminado');
            modal.style.display = 'none';
        }


        function eliminarRegistro() {
            if (window.currentForm) {
            
                var xhr = new XMLHttpRequest();
                xhr.open(window.currentForm.method, window.currentForm.action, true);
                xhr.onload = function () {
                    if (xhr.status >= 200 && xhr.status < 400) {
               
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                           
                            mostrarMensajeEliminado();
                            var fila = document.getElementById('fila' + response.id);
                            if (fila) {
                                fila.parentNode.removeChild(fila); // Eliminar la fila de la tabla
                            }
                        } else {
                           
                            alert('Error al eliminar el registro.');
                        }
                    } else {
                        
                        alert('Error al comunicarse con el servidor.');
                    }
                };
                xhr.onerror = function () {
                    
                    alert('Error de comunicación.');
                };
                xhr.send(new FormData(window.currentForm));
                cerrarModal(); 
            }
        }

      
        function mostrarMensajeEliminado() {
            var modal = document.getElementById('modalMensajeEliminado');
            modal.style.display = 'block';
        }

      
        function verDetalles(civica) {
            var modal = document.getElementById('modalDetalles');
            var detallesActividad = document.getElementById('detallesActividad');
            
            detallesActividad.innerHTML = '<p><strong>ID:</strong> ' + civica.id + '</p>' +
                                          '<p><strong>Actividad:</strong> ' + civica.actividad + '</p>' +
                                          '<p><strong>Instructor:</strong> ' + civica.instructor + '</p>' +
                                          '<p><strong>Lunes:</strong> ' + civica.lunes + '</p>' +
                                          '<p><strong>Martes:</strong> ' + civica.martes + '</p>' +
                                          '<p><strong>Miércoles:</strong> ' + civica.miercoles + '</p>' +
                                          '<p><strong>Jueves:</strong> ' + civica.jueves + '</p>' +
                                          '<p><strong>Viernes:</strong> ' + civica.viernes + '</p>';
                                          
            modal.style.display = 'block';
        }

   
        function cerrarModalDetalles() {
            var modal = document.getElementById('modalDetalles');
            modal.style.display = 'none';
        }
        </script>

</body>
</html>
