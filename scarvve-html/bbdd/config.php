<?php
$host = 'mysql-yehor.alwaysdata.net';
$dbname = 'yehor_uf3';
$username = 'yehor';
$password = '1407831h';

$mysqli = new mysqli($host, $username, $password, $dbname);
if ($mysqli->connect_error) {
    die("Error de conexión: " . $mysqli->connect_error);
}

$mysqli->set_charset("utf8mb4");
?>
