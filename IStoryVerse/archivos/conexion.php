<?php
$servername = 'localhost';
$username = 'root';
$password = ''; // Tu contraseña, si aplica
$dbname = 'spring_auth';
$port = 3307; // El nuevo puerto que pusiste en XAMPP

$conn = new mysqli($servername, $username, $password, $dbname, $port);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
