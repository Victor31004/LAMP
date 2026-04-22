<?php
//Datos de conexion (debe coincidir con docker-compose.yml
$host = "db";
$dbname = "mi_base";
$user = "usuario";
$password = "password123";

//Intentar conexión 
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error){
    die("<p style='color:red'> Error de Conexión: " . $conn->connect_error . "</p>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stack LAMP con Docker</title>
    <style>
        body {font-family: Arial, sans-serif; max-width: 600px; margin: 40px auto; padding: 20px;}
        .ok {color: green; font-weight: bold;}
        .info {background: #f0f0f0; padding: 10px; border-radius: 6px;}
    </style>
</head>
<body>
    <h1>Stack LAMP en Docker</h1>

    <p class="ok"> Conexión a MySQL exitosa</p>

    <div class="info">
        <strong>Servidor MySQL:</strong> <?= $conn->host_info ?>
        <strong>Base de Datos:</strong> <?= $dbname ?>
        <strong>Version PHP:</strong> <?= phpversion() ?>
        <strong>Versión MySQL:</strong> <?= $conn->server_info ?>
    </div>

    <?php
    //Crear tabla de prueba si no existe
    $conn->query("CREATE TABLE IF NOT EXISTS mensajes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        texto VARCHAR(255) NOT NULL,
        fecha TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
        )");

    //Insertar un registro de prueba
    $conn->query("INSERT INTO mensajes (texto) VALUES ('Hola desde PHP + Docker!')");

    //Leer registro
    $result = $conn->query("SELECT * FROM mensajes ORDER BY fecha DESC LIMIT 5");
    ?>

    <h2>Ultimos mensajes en la BD:</h2>
    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse:collapse;">
        <tr style="background:#ddd">
            <th>ID</th><th>Texto</th><th>Fecha</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= htmlspecialchars($row['texto'])?></td>
                <td><?= $row['fecha'] ?></td>
            </tr>
            <?php endwhile; ?>
    </table>

    <?php $conn->close(); ?>
</body>
</html>