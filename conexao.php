<?php

$servername = "localhost";
$port = 3307;
$dbname = "php_crud";
$username = "root";
$password = "";

try {

    $conn = new PDO("mysql:host=$servername;port=$port;dbname=$dbname", $username, $password);

    // Definindo o erro do PDO para exceção
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // echo "Conexão feita com sucesso";

} catch (Exception $e) {

    echo "Falha na conexão: " . $e->getMessage();

}

?>