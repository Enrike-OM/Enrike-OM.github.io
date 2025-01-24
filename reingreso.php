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
    <h1>Formulario de Registro de Reingreso</h1>
    <form action="procesar_reingreso.php" method="post">
        <label for="codigo">Código:</label><br>
        <input type="text" id="codigo" name="codigo" required><br><br>

        <label for="nombre_producto">Nombre del Producto:</label><br>
        <input type="text" id="nombre_producto" name="nombre_producto" required><br><br>

        <label for="marca">Marca:</label><br>
        <input type="text" id="marca" name="marca" required><br><br>

        <label for="numero_serie">Número de Serie:</label><br>
        <input type="text" id="numero_serie" name="numero_serie" required><br><br>

        <label for="precio_venta">Precio de Venta:</label>
        <input type="number" id="precio_venta" name="precio_venta" step="0.01" min="0.01" required><br><br>

        <label for="estado">Estado:</label>
        <select id="estado" name="estado" required>
            <option value="bueno">Bueno</option>
            <option value="regular">Regular</option>
            <option value="malo">Malo</option>
        </select><br><br>

        <label for="fecha">Fecha:</label><br>
        <input type="date" id="fecha" name="fecha" required><br><br>

        <input type="submit" value="Registrar Reingreso">
    </form>
    </div>
    <script src="scripts.js"></script>
</body>
</html>
