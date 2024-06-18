
<?php
session_start();

// Verificar si el usuario está autenticado y es administrador
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
        </ul>
    
        <ul class="nav">
        <li class="nav-item">
            <h6>
            Bienvenido <?php echo $Nombre_Sesion_Activa;?> (Administrador)
            </h6>
        </li>
    </ul>


    </nav>
    <div class="container">
        <?php
        require_once('getAll.php');

        $datos = obtenerDatos();

        if ($datos !== null) {
            $deportivas = $datos['deportivas'];

            // Mostrar actividades deportivas
            echo "<table class='table table-striped'>";
            echo "<h1 class='deportiva'><b> ACTIVIDADES DEPORTIVAS </b></h1>";
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
            foreach ($deportivas as $deportiva) {
                echo "<tr id='fila{$deportiva['id']}'>
                        <td>{$deportiva['id']}</td>
                        <td>{$deportiva['actividad']}</td>
                        <td>{$deportiva['instructor']}</td>
                        <td>{$deportiva['lunes']}</td>
                        <td>{$deportiva['martes']}</td>
                        <td>{$deportiva['miercoles']}</td>
                        <td>{$deportiva['jueves']}</td>
                        <td>{$deportiva['viernes']}</td>
                        <td class='text-center'>
                            <div class='d-flex justify-content-center'>
                                <button class='btn btn-ver' onclick='verDetalles(". json_encode($deportiva) .")'>Ver</button>
                                <a href='actualizarDeportiva.php?id={$deportiva['id']}' class='btn btn-modificar'>Modificar</a>
                                <form method='post' action='eliminar_deportiva.php' id='formEliminar{$deportiva['id']}'>
                                    <input type='hidden' name='id' value='{$deportiva['id']}' />
                                    <button type='button' class='btn btn-eliminar' onclick='confirmarEliminacion({$deportiva['id']})'>Eliminar</button>
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
        <a href="agregarDeportiva.php" class="btn btn-agregar">Agregar</a>
        <br>
        <a href="parte1/Administrador.php" class="btn-regresar">Regresar</a>
    </div>

        <div><footer class="text-white text-center footer-est py-3 mt-5">
            <br>Integrantes:<br>
            Gonzalez Nabor Melanie <br>
            Marin Rodriguez Citlalli <br>
            López Espino Arlette Ivonne <br>
            Gómez Flores Alberto Alejandro <br>
            Vargas Garcia Erick Sebastian<br><br>
        </footer></div>
        
        


        <!-- Modal de confirmación -->
        <div id="modalConfirmacion" class="modal">
            <div class="modal-content">
                <p>¿Seguro que desea eliminar este registro?</p>
                <div class="modal-buttons">
                    <button class="btn btn-cancelar-modal" onclick="cerrarModal()">Cancelar</button>
                    <button class="btn btn-eliminar" onclick="eliminarRegistro()">Eliminar</button>
                </div>
            </div>
        </div>

        <!-- Modal de mensaje de eliminación correcta -->
        <div id="modalMensajeEliminado" class="modal">
            <div class="modal-content">
                <p>Registro eliminado correctamente.</p>
                <div class="modal-buttons">
                    <button class="btn btn btn-cancelar-modal" onclick="cerrarMensajeEliminado()">Aceptar</button>
                </div>
            </div>
        </div>

        <!-- Modal de detalles -->
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
        // Función para mostrar el modal de confirmación
        function confirmarEliminacion(id) {
            var modal = document.getElementById('modalConfirmacion');
            var form = document.getElementById('formEliminar' + id);
            modal.style.display = 'block';

            // Almacenar el formulario actual para enviarlo en caso de confirmación
            window.currentForm = form;
        }

        // Función para cerrar el modal de confirmación
        function cerrarModal() {
            var modal = document.getElementById('modalConfirmacion');
            modal.style.display = 'none';
        }

        // Función para cerrar el modal de mensaje eliminado
        function cerrarMensajeEliminado() {
            var modal = document.getElementById('modalMensajeEliminado');
            modal.style.display = 'none';
        }

        // Función para eliminar el registro si se confirma
        function eliminarRegistro() {
            if (window.currentForm) {
                // Enviar el formulario
                var xhr = new XMLHttpRequest();
                xhr.open(window.currentForm.method, window.currentForm.action, true);
                xhr.onload = function () {
                    if (xhr.status >= 200 && xhr.status < 400) {
                        // Éxito en la eliminación
                        var response = JSON.parse(xhr.responseText);
                        if (response.success) {
                            // Mostrar mensaje de eliminado correctamente
                            mostrarMensajeEliminado();
                            var fila = document.getElementById('fila' + response.id);
                            if (fila) {
                                fila.parentNode.removeChild(fila); // Eliminar la fila de la tabla
                            }
                        } else {
                            // Mostrar mensaje de error
                            alert('Error al eliminar el registro.');
                        }
                    } else {
                        // Mostrar mensaje de error
                        alert('Error al comunicarse con el servidor.');
                    }
                };
                xhr.onerror = function () {
                    // Mostrar mensaje de error
                    alert('Error de comunicación.');
                };
                xhr.send(new FormData(window.currentForm));
                cerrarModal(); // Cerrar el modal de confirmación
            }
        }

        // Función para mostrar el modal de mensaje de eliminación correcta
        function mostrarMensajeEliminado() {
            var modal = document.getElementById('modalMensajeEliminado');
            modal.style.display = 'block';
        }

        // Función para mostrar detalles de la actividad
        function verDetalles(deportiva) {
            var modal = document.getElementById('modalDetalles');
            var detallesActividad = document.getElementById('detallesActividad');
            
            detallesActividad.innerHTML = '<p><strong>ID:</strong> ' + deportiva.id + '</p>' +
                                          '<p><strong>Actividad:</strong> ' + deportiva.actividad + '</p>' +
                                          '<p><strong>Instructor:</strong> ' + deportiva.instructor + '</p>' +
                                          '<p><strong>Lunes:</strong> ' + deportiva.lunes + '</p>' +
                                          '<p><strong>Martes:</strong> ' + deportiva.martes + '</p>' +
                                          '<p><strong>Miércoles:</strong> ' + deportiva.miercoles + '</p>' +
                                          '<p><strong>Jueves:</strong> ' + deportiva.jueves + '</p>' +
                                          '<p><strong>Viernes:</strong> ' + deportiva.viernes + '</p>';
                                          
            modal.style.display = 'block';
        }

        // Función para cerrar el modal de detalles
        function cerrarModalDetalles() {
            var modal = document.getElementById('modalDetalles');
            modal.style.display = 'none';
        }
        </script>


    </div>
</div>
</body>
</html>
