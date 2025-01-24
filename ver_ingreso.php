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
        <h1>Contenido de la Tabla Ingreso</h1>

        <form method="GET" action="ver_ingreso.php">
            <label for="start_date">Fecha de Inicio:</label>
            <input type="date" name="start_date" id="start_date">
            <label for="end_date">Fecha de Fin:</label>
            <input type="date" name="end_date" id="end_date">
            <input type="submit" value="Filtrar">
        </form>

        <?php
        $conn = new mysqli("localhost", "root", "", "inventario");
    
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Número de filas por página
        $rows_per_page = isset($_POST['rows_per_page']) ? (int)$_POST['rows_per_page'] : 10; // Valor por defecto
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1; // Página actual

        // Calcular el inicio de la consulta
        $start_from = ($current_page - 1) * $rows_per_page;

        // Filtrar por rango de fechas
        $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
        $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

        // Consulta para contar el total de registros
        $total_sql = "SELECT COUNT(*) AS total FROM ingreso WHERE 1=1";
        
        if ($start_date) {
            $total_sql .= " AND Fecha >= '$start_date'";
        }
        if ($end_date) {
            $total_sql .= " AND Fecha <= '$end_date'";
        }

        $total_result = $conn->query($total_sql);
        $total_row = $total_result->fetch_assoc();
        $total_records = $total_row['total'];
        $total_pages = ceil($total_records / $rows_per_page); // Total de páginas

        // Consulta para obtener los registros de la página actual
        $sql = "SELECT * FROM ingreso WHERE 1=1";

        if ($start_date) {
            $sql .= " AND Fecha >= '$start_date'";
        }
        if ($end_date) {
            $sql .= " AND Fecha <= '$end_date'";
        }

        $sql .= " ORDER BY Fecha DESC LIMIT $start_from, $rows_per_page"; // Ordenar por fecha descendente
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<form method='POST' action='ver_ingreso.php'>
                    <label for='rows_per_page'>Filas por página:</label>
                    <select name='rows_per_page' onchange='this.form.submit()'>
                        <option value='5'" . ($rows_per_page == 5 ? ' selected' : '') . ">5</option>
                        <option value='10'" . ($rows_per_page == 10 ? ' selected' : '') . ">10</option>
                        <option value='20'" . ($rows_per_page == 20 ? ' selected' : '') . ">20</option>
                        <option value='50'" . ($rows_per_page == 50 ? ' selected' : '') . ">50</option>
                    </select>
                  </form>";

            echo "<table border='1'>
                    <tr>
                        <th>Código</th>
                        <th>Nombre del Producto</th>
                        <th>Marca</th>
                        <th>Número de Serie</th>
                        <th>Fecha</th>
                        <th>Unidad de Medida</th>
                        <th>Precio de Venta</th>
                        <th>Cantidad</th>
                        <th>QR</th>
                    </tr>";
                    
            while($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>" . $row["codigo"] . "</td>
                        <td>" . $row["NombreProducto"] . "</td>
                        <td>" . $row["Marca"] . "</td>
                        <td>" . $row["NumeroSerie"] . "</td>
                        <td>" . $row["Fecha"] . "</td>
                        <td>" . $row["UnidadMedida"] . "</td>
                        <td>" . $row["PrecioVenta"] . "</td>
                        <td>" . $row["Cantidad"] . "</td>
                        <td><img src='" . $row["QR"] . "' alt='Código QR' width='100' height='100'></td>
                    </tr>";
            }
            echo "</table>";
   
            // Paginación
            echo "<div class='pagination'>";
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<a href='ver_ingreso.php?page=$i&rows_per_page=$rows_per_page&start_date=$start_date&end_date=$end_date'>" . $i . "</a> ";
            }
            echo "</div>";
        } else {
            echo "No se encontraron registros.";
        }

        $conn->close();
        ?>
    </div>
    <script src="scripts.js"></script>
</body>
</html>