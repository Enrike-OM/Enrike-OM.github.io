<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro de Stock</title>
</head>
<body>
    <h1>Formulario de Registro de Stock</h1>
    <form action="procesar_stock.php" method="post">
        <label for="producto">Producto:</label><br>
        <input type="text" id="producto" name="producto" required><br><br>

        <label for="marca">Marca:</label><br>
        <input type="text" id="marca" name="marca" required><br><br>

        <input type="submit" value="Registrar Stock">
    </form>
</body>
</html>
