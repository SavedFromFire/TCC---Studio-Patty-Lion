<?php
session_start();?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio Patty Leão - Tratamentos, cortes, com zelo, carinho e cuidado</title>
    <link rel="stylesheet" href="assets/css/estilo_pg_codigo.css">
    <link rel="shortcut icon" href="assets/img/logo.png" />
</head>
    <div class="box">
        <div class="container">
    <h1>Enviar Código de Verificação</h1>
    <a class="btn" href="confirmar.php">Já recebi o código</a>
    <?php
require 'vendor/autoload.php'; // Carrega a biblioteca PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (!isset($_SESSION['user_email'])) {
    header("Location: cadastro.php");
    exit();
}

// Gera um código de verificação
$codigo_verificacao = rand(100000, 999999);
$_SESSION['codigo_verificacao'] = $codigo_verificacao;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

//criando um email a ser enviado
$mail = new PHPMailer(true);

try {
    // Configuração do servidor SMTP
    $mail->isSMTP();
    $mail->Host = 'sandbox.smtp.mailtrap.io';
    $mail->SMTPAuth = true;
    $mail->Port = 2525;
    $mail->Username = '541e870e09672d';
    $mail->Password = '9381cffbea7c8f';

    // Configuração do email
    $mail->setFrom('noreply@seusite.com', 'Seu Nome ou Empresa');
    $mail->addAddress($_SESSION['user_email']);
    $mail->Subject = 'Código de Verificação';
    $mail->Body = "Seu código de verificação é: $codigo_verificacao";

    // Envia o email
    $mail->send();
    echo "<p style='color: green;'>Código de verificação enviado para o seu email!</p>";
} catch (Exception $e) {
    echo "<p style='color: red;'>Erro ao enviar o código: {$mail->ErrorInfo}</p>";
}

?>
</div>
</div>
<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>



