<?php
$servername = "localhost";
$username = "root";
$senha = "";
$dbname = "studiopattyleao";

$conn = new mysqli($servername,$username,$senha,$dbname);

if($conn->connect_error) {
    die("Falha na conexão:" . $conn->connect_error);
}
 
?>