
<?php
session_start();
include 'conectar.php'; // Conexão com o banco de dados
?>

    
<?php
// Verifica se o usuário está logado
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

// Obtém o e-mail do usuário logado
$user_email = $_SESSION['user_email'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirmar']) && $_POST['confirmar'] === 'Sim') {
        // Prepara a exclusão da conta no banco de dados
        $sql = "DELETE FROM user WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $user_email);

        if ($stmt->execute()) {
            session_unset(); // Remove as variáveis de sessão
            session_destroy(); // Encerra a sessão
            header("Location: index.html?mensagem=ContaExcluida");
            exit();
        } else {
            $erro = "Erro ao excluir a conta. Tente novamente.";
        }
    } else {
        // Redireciona para a página do usuário se a exclusão não for confirmada
        header("Location: usuario.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Conta</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="novoMenu">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="inicio.php"><img class="logoImagem" src="assets/img/logo.png" alt="Studio" width="120px"></a>
                </div>
                <nav>
                    <ul id="MenuItens">
                        <li class="navword"><a href="inicio.php">Início</a></li>
                        <li class="navword"><a href="serviços.html">Serviços</a></li>
                        <li class="navword"><a href="index.html">Logout</a></li>
                    </ul>
                </nav>
                <a href="https://wa.me/message/4YWF26SVIUX2J1" title="">
                    <img src="assets/img/agendar.png" class="agendar" alt="agendamento de serviços" width="80px"></a>
                    <img src="assets/img/menu.png" alt="Menu Celular" class="menu-celular" onclick="menucelular()">
            </div>
        </div>
    </div>
    <section class="secUser">
    <div class="container">
        <h1>Excluir Conta</h1>
        <p>Tem certeza de que deseja excluir sua conta? Esta ação não pode ser desfeita.</p>
        <?php if (isset($erro)) { echo "<p style='color: red;'>$erro</p>"; } ?>
        <form method="post">
            <button type="submit" name="confirmar" value="Sim" class="btn-confirm">Sim, excluir conta</button>
            <button type="submit" name="confirmar" value="Não" class="btn-cancel">Não, cancelar</button>
        </form>
    </div>
    <script src="assets/js/app.js"></script>
</section>
</body>
</html>