<?php
error_reporting(E_ALL);
$servername = "localhost";
$database = "example";
$username = "userphp";
$password = "12345";
$link = mysqli_connect($servername, $username, $password, $database);
if ($link->connect_error){
die("Conexão com o banco falhou: " . $conn->connect_error);
}
?>
