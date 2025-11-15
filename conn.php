<?php
// Configuración de conexión local en XAMPP
$host = "localhost";       // Servidor local
$user = "root";            // Usuario por defecto en XAMPP
$pass = "";                // Contraseña por defecto (vacía)
$db   = "db_a6f79d_apsys"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($host, $user, $pass, $db);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

echo "¡Conexión local exitosa!";
?>
