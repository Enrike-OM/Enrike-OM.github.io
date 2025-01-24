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
    <h1>Contenido de la Tabla Reingreso</h1>

    <?php
    $conn = new mysqli("localhost", "root", "", "inventario");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM Reingreso";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Código</th>
                    <th>Nombre del Producto</th>
                    <th>Marca</th>
                    <th>Número de Serie</th>
                    <th>Precio de Venta</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                </tr>";

        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["Codigo"] . "</td>
                    <td>" . $row["NombreProducto"] . "</td>
                    <td>" . $row["Marca"] . "</td>
                    <td>" . $row["NumeroSerie"] . "</td>
                    <td>" . $row["PrecioVenta"] . "</td>
                    <td>" . $row["Estado"] . "</td>
                    <td>" . $row["Fecha"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No hay registros en la tabla Reingreso.";
    }

    $conn->close();
    ?>
    </div>
    <script src="scripts.js"></script>
</body>
</html>