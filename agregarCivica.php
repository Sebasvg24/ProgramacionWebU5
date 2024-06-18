<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <title>Registro de Actividades Civicas</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body class="paaagina-registro">
    <div class="registro-container">
        <h1 class="registro-titulo">REGISTRAR ACTIVIDAD CIVICA</h1>
        <?php if (isset($_GET['mensaje'])): ?>
            <p><?php echo htmlspecialchars($_GET['mensaje']); ?></p>
        <?php endif; ?>
        <form class="registro-formulario" action="insertCivica.php" method="post">
            <label class="registro-etiqueta" for="actividad">Actividad:</label>
            <input class="registro-input" type="text" id="actividad" name="actividad" required>
            
            <label class="registro-etiqueta" for="instructor">Instructor:</label>
            <input class="registro-input" type="text" id="instructor" name="instructor" required>
            
            <label class="registro-etiqueta" for="lunes">Lunes:</label>
            <input class="registro-input" type="text" id="lunes" name="lunes">
            
            <label class="registro-etiqueta" for="martes">Martes:</label>
            <input class="registro-input" type="text" id="martes" name="martes">
            
            <label class="registro-etiqueta" for="miercoles">Miércoles:</label>
            <input class="registro-input" type="text" id="miercoles" name="miercoles">
            
            <label class="registro-etiqueta" for="jueves">Jueves:</label>
            <input class="registro-input" type="text" id="jueves" name="jueves">
            
            <label class="registro-etiqueta" for="viernes">Viernes:</label>
            <input class="registro-input" type="text" id="viernes" name="viernes">
            
            <button class="registro-boton" type="submit">Registrar</button>
        </form>
        <a href="vistaCivica.php" class="boton-regresar">Regresar</a>
    </div>
</body>
</html>



    