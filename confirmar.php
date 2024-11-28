<?php
session_start();

// Ativar mensagens de erro para depuração
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['codigo_verificacao'])) {
    header("Location: enviar_codigo.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo_inserido = $_POST['codigo'];

    // Verifica se o código corresponde
    if ($codigo_inserido == $_SESSION['codigo_verificacao']) {
        unset($_SESSION['codigo_verificacao']);
        header("Location: usuario.php");
        exit();
    } else {
        $erro = "Código incorreto. Tente novamente.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Código</title>
    <link rel="stylesheet" href="assets/css/estilo_pg_codigo.css">
    <link rel="shortcut icon" href="assets/img/logo.png" />
</head>
<body>
    <div class="box">
        <div class="container">
            
        
    <h1>Confirmação de Código</h1>
    <p>Digite o código de verificação enviado para o seu email.</p>

    <?php if (isset($erro)) echo "<p style='color: red;'>$erro</p>"; ?>

    <form method="POST" action="">
        <label for="codigo">Código de Verificação:</label>
        <input type="text" id="codigo" name="codigo" required>
        <button class="btn" style="border: 0;" type="submit">Confirmar</button>
    </form>
</div>
    </div>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>
