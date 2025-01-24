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

    <h1>Salidas de Productos</h1>

    <table border="1">
        <thead>
            <tr>
                <th>Código de Transacción</th>
                <th>Código del Producto</th>
                <th>Producto</th>
                <th>Marca</th>
                <th>Cantidad</th>
                <th>Calidad</th>
                <th>Datos del Personal</th>
                <th>Fecha</th>
                <th>Hora</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Conexión a la base de datos
            $conn = new mysqli("localhost", "root", "", "inventario");

            // Verificar la conexión
            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            // Consulta para obtener las salidas
            $sql = "SELECT CodigoSalida, codigo, Producto, Marca, Cantidad, Calidad, DatosPersonal, Fecha, Hora FROM salida";
            $result = $conn->query($sql);

            // Verificar si hay resultados
            if ($result->num_rows > 0) {
                // Salida de datos de cada fila
                while($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>" . htmlspecialchars($row['CodigoSalida']) . "</td>
                            <td>" . htmlspecialchars($row['codigo']) . "</td>
                            <td>" . htmlspecialchars($row['Producto']) . "</td>
                            <td>" . htmlspecialchars($row['Marca']) . "</td>
                            <td>" . htmlspecialchars($row['Cantidad']) . "</td>
                            <td>" . htmlspecialchars($row['Calidad']) . "</td>
                            <td>" . htmlspecialchars($row['DatosPersonal']) . "</td>
                            <td>" . htmlspecialchars($row['Fecha']) . "</td>
                            <td>" . htmlspecialchars($row['Hora']) . "</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='9'>No se encontraron salidas.</td></tr>";
            }

            // Cerrar la conexión
            $conn->close();
            ?>
    </div>
    <script src="scripts.js"></script>
</body>
</html>
