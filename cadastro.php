<?php
session_start();
include 'conectar.php';
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
                    <a href="login.php"><img src="assets/img/padrao.png" class="perfil-usuario" alt=""></a>
                    <img src="assets/img/menu.png" alt="Menu Celular" class="menu-celular" onclick="menucelular()">
            </div>
        </div>
    </div>
    <div class="container">
        <div class="linha">
            <div class="col-2">

            
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $celular = $_POST['celular'];
    $endereco = $_POST['endereco'];
    $descricao = $_POST['descricao'];
    // Hash da senha
    $hashed_password = password_hash($senha, PASSWORD_DEFAULT);

    // Verifica se o email já está cadastrado
    $sql = "SELECT * FROM user WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<h1 style='font-family: Poppins;'>Email já registrado! Tente outro.</h1><a class='btn' href='index.html'>Voltar ao início</a>";

    } else {
        // Insere no banco de dados
        $sql = "INSERT INTO user (nome, email, senha, celular, endereco, descricao) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssiss", $nome, $email, $hashed_password, $celular, $endereco, $descricao);

        if ($stmt->execute()) {
            // Salva o email na sessão
            $_SESSION['user_nome'] = $nome;
            $_SESSION['user_email'] = $email;
            $_SESSION['user_senha'] = $senha;
            $_SESSION['user_celular'] = $celular;
            $_SESSION['user_endereco'] = $endereco;
            $_SESSION['user_descricao'] = $descricao;
            header("Location: enviar_codigo.php");
            exit();
        } else {
            echo "Erro ao cadastrar. Tente novamente.";
        }
    }

    $stmt->close();
}
$conn->close();
?>
    </div>
    <div class="col-2">
        <img src="assets/img/modelo-erro.png" alt="">
    </div>
  </div>
</div>
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