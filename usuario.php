<?php
session_start();
require("conectar.php");
if (!isset($_SESSION['user_nome']) || !isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}
$nome = $_SESSION['user_nome'];
$userEmail = $_SESSION['user_email'];

// Consulta para obter a foto do perfil do usuário
$sql = "SELECT nome, email, celular, endereco, descricao, foto_perfil FROM user WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "Usuário não encontrado. Verifique se está logado.";
    exit();
}

$fotoPerfil = !empty($user['foto_perfil']) ? $user['foto_perfil'] : 'assets/img/padrao.png'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    
    <!-- Navbar -->
    <div class="novoMenu">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="inicio.php" ><img class="logoImagem" src="assets/img/logo.png" alt="Studio" width="120px">
                </div>
                <nav>
                    <ul id="MenuItens">
                        <li class="navword"><a href="inicio.php">Início</a></li>
                        <li class="navword"><a  href="serviços.php">Serviços</a></li>
                        <li class="navword"><a  href="index.html">logout</a></li>
                    </ul>
                </nav>
                <a href="https://wa.me/message/4YWF26SVIUX2J1" title="">
                    <img src="assets/img/agendar.png" class="agendar"alt="agendamento de serviços" width="80px" ></a>
                    <img src="assets/img/menu.png" alt="Menu Celular" class="menu-celular" onclick="menucelular()">
            </div>
        </div>
    </div>

    <!-- Conteúdo da Página de Usuário -->
    <section class="secUser minha-conta">
        <div class="container">
            <div class="box-user">
                <div class="linha">
                          <div class="col-3">
                            <div class="infoUser">
                            <h2>Bem-vindo, <?php echo htmlspecialchars($user['nome']); ?></h2>
                            <h3>Email:</h3><h4> <?php echo htmlspecialchars($userEmail); ?></h4>

                            <h3>Número de telefone: </h3><h4><?php echo htmlspecialchars($user['celular']); ?></h4>
                            <h3>Endereço: </h3><h4><?php echo htmlspecialchars($user['endereco']); ?></h4>
                            <hr>
                            <h3>Descrição:</h3> <h4><?php echo htmlspecialchars($user['descricao'])?></h4><br><br>
                            <a href="editar-perfil.php" class="btn">Editar Perfil</a>
                        </div>
                        </div>
                         <div class="col-3">
                           <a href="editar-perfil.php"><img class="img-user" src="<?php echo htmlspecialchars($fotoPerfil) . '?v=' . time(); ?>" alt="Foto de Perfil" width="150px"></a> 
                        </div>
                        
                </div> 
            </div>
        </div>
    </sectison>
    <section class="secEspacamento">
        <br>
    </section>
    <!-- Secções Adicionais -->
    <section class="secAgendar"><br><br>
        <div class="container">
            <h2 class="titulo">Configurações da Conta</h2>
            <div class="linha">
                <div class="col-4">
                    <h4>Segurança</h4>
                    <h5>Atualizar senha e outras configurações de segurança.</h5><br>
                    <a href="sair.php" style="background-color: rgb(111, 162, 191);" class="btn">Gerenciar</a>
                </div>
                <div class="col-4">
                    <h4>Serviços</h4>
                    <h5>Agende já seus serviços no salão!</h5>
                    <br>
                    <a href="agende.php" style="background-color: rgb(111, 162, 191);" class="btn">Gerenciar</a>
                </div>
                <div class="col-4">
                    <h4>Excluir Conta</h4>
                    <h5>Excluir a sua conta.</h5><br>
                    <a href="excluir-conta.php" style="background-color: rgb(111, 162, 191);" class="btn">Acessar</a>
                </div>
            </div>
        </div>
    </section>


    
    <!-- Rodapé -->
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
