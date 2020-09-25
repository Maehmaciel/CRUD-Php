<?php
error_reporting(E_ALL);
$servername = "localhost";
$database = "example";
$username = "";
$password = "";
$link = mysqli_connect($servername, $username, $password, $database);
if ($link->connect_error){
die("Conexão com o banco falhou: " . $conn->connect_error);
}
?>