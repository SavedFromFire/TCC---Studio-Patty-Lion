<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio Patty Leão - Tratamentos, cortes, com zelo, carinho e cuidado</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/img/logo.png" />

</head>
<body>
<?php
if (!isset($_SESSION['codigo_verificacao'])) {
    header("Location: cadastro.php");
    exit();
}else{


if ($_SERVER["REQUEST_METHOD"] == "POST") {

   if($codigo_verificacao = $_SESSION['codigo_verificacao']){
    echo "'<h1>Seu código de verificação é:' .  $codigo_verificacao</h1>";

    header("Location:confirmar.php");
    exit();
   }else{
     ("Location:index.html");
     exit();

  }
}else{
echo "Erro de autenticação";
echo "<h1><a href='index.html'>Voltar ao início</a></h1>";
 }
}
?>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>
