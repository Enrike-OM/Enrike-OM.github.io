<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $codigo_producto = $_POST['codigo_producto']; // Código del producto
    $numero_serie = $_POST['numero_serie']; // Número de serie
    $cantidad = $_POST['cantidad']; // Cantidad a salir
    $calidad = $_POST['calidad']; // Calidad del producto
    $datos_personal = $_POST['datos_personal']; // Datos del personal
    $fecha = $_POST['fecha']; // Fecha de la salida
    $hora = $_POST['hora']; // Hora de la salida
    $marca = $_POST['marca']; // Marca del producto

    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "inventario");

    // Verificar la conexión
    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    // Verificar si el producto existe en ingreso o reingreso
    $sql_ingreso = "SELECT * FROM ingreso WHERE codigo = ? OR NumeroSerie = ?";
    $stmt_ingreso = $conn->prepare($sql_ingreso);
    $stmt_ingreso->bind_param("ss", $codigo_producto, $numero_serie);
    $stmt_ingreso->execute();
    $result_ingreso = $stmt_ingreso->get_result();

    $sql_reingreso = "SELECT * FROM reingreso WHERE Codigo = ? OR NumeroSerie = ?";
    $stmt_reingreso = $conn->prepare($sql_reingreso);
    $stmt_reingreso->bind_param("ss", $codigo_producto, $numero_serie);
    $stmt_reingreso->execute();
    $result_reingreso = $stmt_reingreso->get_result();

    // Verificar si el producto existe
    if ($result_ingreso->num_rows > 0 || $result_reingreso->num_rows > 0) {
        // Generar un código de transacción único
        $codigo_transaccion = 'SAL-' . date('Ymd') . '-' . uniqid();

        // Inserción de la salida
        $sql = "INSERT INTO salida (CodigoSalida, codigo, Marca, Calidad, DatosPersonal, Fecha, Hora, Cantidad)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssis", $codigo_transaccion, $codigo_producto, $marca, $calidad, $datos_personal, $fecha, $hora, $cantidad);

        // Ejecutar la consulta y verificar el resultado
        if ($stmt->execute()) {
            echo "Salida de producto registrada correctamente. Código de transacción: $codigo_transaccion";
            sleep(2);
            header('Location: salida.php');
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "El producto no está registrado en ingreso o reingreso.";
    }

    // Cerrar la conexión
    $stmt_ingreso->close();
    $stmt_reingreso->close();
    $conn->close();
}
?>