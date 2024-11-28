<?php session_start();
require_once "conectar.php";
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
    
    <div class="novoMenu">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="index.html" ><img class="logoImagem" src="assets/img/logo.png" alt="Studio" width="120px">
                </div>
                <nav>
                    <ul id="MenuItens">
                        <li class="navword"><a href="index.html">Início</a></li>
                        <li class="navword"><a  href="serviços.html">Serviços</a></li>
                        <li class="navword"><a  href="cadastro.html">Cadastre-se ou faça log-in</a></li>
                    </ul>
                </nav>
                <a href="https://wa.me/message/4YWF26SVIUX2J1" title="">
                    <img src="assets/img/agendar.png" class="agendar"alt="agendamento de serviços" width="80px" ></a>
                    <a href="login.php"><img src="<?php echo htmlspecialchars($fotoPerfil) . '?v=' . time(); ?>" class="perfil-usuario" alt=""></a>
                    <img src="assets/img/menu.png" alt="Menu Celular" class="menu-celular" onclick="menucelular()">
            </div>
        </div>
    </div>
<section class="secConta">
    <div class="minha-conta">
        <div class="container">

            <div class="linha">

                <div class="col-2">

                    <img class="imagem-banner" src="assets/img/modelo_cabelo.png" style="padding: 0;" alt="" width="100%">

                </div>

                <div class="col-2">
                    <div class="formulario-log">
                        <div class="btn-form">
                            <span>Entrar</span>
                            <hr id="Indicador">
                        </div>
                        <form action="login.php" method="post" id="CadastroSite" enctype="multipart/form-data">
                            <input type="text" name="nome" id="" placeholder="Nome completo" required>
                            <input type="email" name="email" id="" placeholder="E-mail de acesso" required>
                            <input type="password" name="senha" id="" placeholder="Digite sua senha" required>
                            <input type="submit" value="Entrar" style="border:0;" name="sendCad" class="btn">
                            <a href="cadastro.html">Não tem conta? <p style="color:darkblue">Cadastre-se</p></a>
                            <?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Verifica as credenciais
    $verify = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($verify);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($senha, $user['senha'])) {
            // Armazena o nome e email do usuário na sessão
            $_SESSION['user_nome'] = $user['nome'];
            $_SESSION['user_email'] = $user['email'];
            header("Location: usuario.php");
            exit();
        } else {
            echo "<p style='color: red;'>Senha incorreta.</p>";
        }
    } else {
        echo "<p style='color: red;'>Usuário não encontrado.</p>";
    }
    $stmt->close();
}
$conn->close();
?>
                        </form><br><br>
                        
                    </div>

                </div>

            </div>

        </div>
    </div>
</section>
<footer class="rodape">
            <div class="container">
               <div class="linha">
                   <div class="rodape-col-1">
                       <h3>Ver local do salão</h3>
                       <p>Google Maps - Seringal do Rio Verde, 132</p>
                       <div class="app-logo">
                           <a class="btn" href="https://maps.app.goo.gl/fxb17rg4fPBvtcwq9">Visualizar &#8594;</a>
                       </div>
                   </div>
   
                   <div class="rodape-col-2">
                          <p>Somos a equipe Studio Patty Leão, aqui oferecemos serviços de qualidade, com zelo, carinho, amor e dedicação. Siga nossas redes sociais:</p> 
                   </div>
                   <div class="rodape-col-3">
                       <h3>Endereço:</h3>
                       <ul>
                           <li>Cidade: São Paulo</li>
                           <li>Bairro: Jardim Nakamura</li>
                           <li>Rua: Seringal do Rio Verde, 132</li>
                       </ul>
                   </div>
                   <div class="rodape-col-4">
                   <h3>Redes Sociais</h3>
                   <ul>
                   <a href="https://wa.me/message/4YWF26SVIUX2J1" class="link-redes-sociais"><li>WhatsApp</li></a>
                   <a href="https:\\instagram.com" class="link-redes-sociais"><li>Instagram</li></a>
                   </ul>
                   </div>
               </div>
               <hr>
               <p class="direitos">
                   &#169;Direitos pertencentes a Studio Patty Leão
               </p>
            </div>
       </footer>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>