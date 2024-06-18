<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Modificar Actividades Culturales</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="pagina-registro">
    <?php if (isset($_GET['mensaje'])) : ?>
        <p><?php echo htmlspecialchars($_GET['mensaje']); ?></p>
    <?php endif; ?>
    <div class="registro-container">
        <h1 class="registro-titulo">ACTUALIZAR ACTIVIDAD CULTURAL</h1>
        <?php
        require_once('conexion.php');
        require_once('ORM.php');
        require_once('cultural.php');

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            $db = new Database();
            $encontrado = $db->verificarDriver();

            if ($encontrado) {
                $cnn = $db->getConnection();
                $culturalModelo = new Orm($id, 'cultural', $cnn);
                $registro = $culturalModelo->getById($id);

                if ($registro) {
        ?>
                    <form class="registro-formulario" action="modificarCultural.php" method="post">
                        <input type="hidden" name="id" value="<?php echo $registro['id']; ?>">
                        <label class="registro-etiqueta" for="actividad">Actividad:</label>
                        <input class="registro-input" type="text" id="actividad" name="actividad" value="<?php echo htmlspecialchars($registro['actividad']); ?>" required>

                        <label class="registro-etiqueta" for="instructor">Instructor:</label>
                        <input class="registro-input" type="text" id="instructor" name="instructor" value="<?php echo htmlspecialchars($registro['instructor']); ?>" required>

                        <label class="registro-etiqueta" for="lunes">Lunes:</label>
                        <input class="registro-input" type="text" id="lunes" name="lunes" value="<?php echo htmlspecialchars($registro['lunes']); ?>">

                        <label class="registro-etiqueta" for="martes">Martes:</label>
                        <input class="registro-input" type="text" id="martes" name="martes" value="<?php echo htmlspecialchars($registro['martes']); ?>">

                        <label class="registro-etiqueta" for="miercoles">Miércoles:</label>
                        <input class="registro-input" type="text" id="miercoles" name="miercoles" value="<?php echo htmlspecialchars($registro['miercoles']); ?>">

                        <label class="registro-etiqueta" for="jueves">Jueves:</label>
                        <input class="registro-input" type="text" id="jueves" name="jueves" value="<?php echo htmlspecialchars($registro['jueves']); ?>">

                        <label class="registro-etiqueta" for="viernes">Viernes:</label>
                        <input class="registro-input" type="text" id="viernes" name="viernes" value="<?php echo htmlspecialchars($registro['viernes']); ?>">

                        <button class="registro-boton" type="submit">Actualizar</button>
                    </form>
        <?php
                } else {
                    echo "<p>Registro no encontrado.</p>";
                }
            } else {
                echo "<p>Error al conectar con la base de datos.</p>";
            }
        } else {
            echo "<p>ID de registro no especificado.</p>";
        }
        ?>
        <a href="vistaCultural.php" class="boton-regresar">Regresar</a>
    </div>
</body>

</html>