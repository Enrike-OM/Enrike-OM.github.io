<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Control de Inventario</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    
    <?php include 'menu.php'; ?>
    <div id="content">
        <button id="toggle-button" onclick="toggleMenu()">
            <i class="fas fa-bars"></i> Menu
        </button><br><br><br><br>
        <h1>Formulario de Registro de Salida</h1>
        <form action="procesar_salida.php" method="post">
            <label for="codigo_producto">Código del Producto:</label><br>
            <input type="text" id="codigo_producto" name="codigo_producto" required><br><br>

            <label for="numero_serie">Número de Serie:</label><br>
            <input type="text" id="numero_serie" name="numero_serie" required><br><br>

            <label for="marca">Marca:</label><br>
            <input type="text" id="marca" name="marca" required><br><br>

            <label for="cantidad">Cantidad:</label><br>
            <input type="number" id="cantidad" name="cantidad" required><br><br>

            <label for="calidad">Calidad:</label><br>
            <select id="calidad" name="calidad" required>
                <option value="ingreso">Ingreso</option>
                <option value="reingreso">Reingreso</option>
            </select><br><br>

            <label for="datos_personal">Datos del Personal:</label><br>
            <input type="text" id="datos_personal" name="datos_personal" required><br><br>

            <label for="fecha">Fecha:</label><br>
            <input type="date" id="fecha" name="fecha" required><br><br>

            <label for="hora">Hora:</label><br>
            <input type="time" id="hora" name="hora" required><br><br>

            <input type="submit" value="Registrar Salida">
        </form>
    </div>
    <script src="scripts.js"></script>
</body>
</html>