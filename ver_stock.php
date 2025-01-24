<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Actual</title>
</head>
<body>
    <h1></h1>

    <?php
    $conn = new mysqli("localhost", "root", "", "inventario");

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $sql = "SELECT * FROM StockCalculado";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<table border='1'>
                <tr>
                    <th>Producto</th>
                    <th>Marca</th>
                    <th>Cantidad Final</th>
                </tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>" . $row["Producto"] . "</td>
                    <td>" . $row["Marca"] . "</td>
                    <td>" . $row["CantidadFinal"] . "</td>
                  </tr>";
        }
        echo "</table>";
    } else {
        echo "No hay registros en la tabla de stock.";
    }

    $conn->close();
    ?>

</body>
</html>
