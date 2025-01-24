<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stock Actual</title>
</head>
<body>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $producto = $_POST['producto'];
        $marca = $_POST['marca'];
    
        $conn = new mysqli("localhost", "root", "", "inventario");
    
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }
    
        $sql = "INSERT INTO Stock (Producto, Marca) VALUES ('$producto', '$marca')";
    
        if ($conn->query($sql) === TRUE) {
            echo "Stock registrado correctamente.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    ?>

</body>
</html>