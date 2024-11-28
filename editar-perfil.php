<?php
session_start();
require_once 'conectar.php';
?>     
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio Patty Leão - Editar Perfil</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/img/logo.png" />
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

<!-- Seção de exibição dos dados do usuário --> 
    <section class="secUser">
    <div class="container"><br><br>
    <?php
// Certifique-se de incluir o arquivo correto de conexão

// Verifica se o usuário está logado
if (!isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

// Dados da sessão
$userEmail = $_SESSION['user_email']; // Garante que o valor é obtido da sessão

$sql = "SELECT id, nome, email, celular, endereco, descricao, foto_perfil FROM user WHERE email = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Erro ao preparar a consulta: " . $conn->error);
}

$stmt->bind_param("s", $userEmail);

if (!$stmt->execute()) {
    die("Erro ao executar a consulta: " . $stmt->error);
}

$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Usuário não encontrado.");
}

$user = $result->fetch_assoc();

$stmt->bind_param("s", $userEmail);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Usuário não encontrado ou erro na consulta.");
}

// Verifica se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {            
    $novoNome = $_POST['nome'] ?? '';
    $novaSenha = $_POST['senha'] ?? '';
    $novoCelular = $_POST['celular'] ?? '';
    $novoEndereco = $_POST['endereco'] ?? '';
    $novaDescricao = $_POST['descricao'] ?? '';
    $confirmarSenha = $_POST['confirmar'] ?? '';
    $fotoPerfil = $user['foto_perfil'] ?? 'uploads/padrao.png'; // Define um padrão para a foto

    
    // Verifica se há uma nova foto para upload
    if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] == UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['foto_perfil']['name'], PATHINFO_EXTENSION);
        $fotoPerfil = 'uploads/perfil_' . uniqid() . '.' . $extensao;
        move_uploaded_file($_FILES['foto_perfil']['tmp_name'], $fotoPerfil);
    }

    // Monta a consulta SQL dinamicamente
    $sql = "UPDATE user SET nome = ?, celular = ?, endereco = ?, descricao = ?, foto_perfil = ?";
    $params = [$novoNome, $novoCelular, $novoEndereco, $novaDescricao, $fotoPerfil];
    $types = "sssss"; // Tipos para bind_param (todas strings inicialmente)

$confirm = "senha confirmada com sucesso!";
if($confirmarSenha === $novaSenha){
    // Inclui a senha se fornecida
    if (!empty($novaSenha)) {
        $hashedSenha = password_hash($novaSenha, PASSWORD_DEFAULT);
        $sql .= ", senha = ?";
        $params[] = $hashedSenha;
        $types .= "s"; 
        ?><script type='text/javascript'>
      alert('Senha trocada com sucesso!')
      </script><?php
    }else if($confirmarSenha != $novaSenha){
      ?><script type='text/javascript'>
      alert('Senhas são diferentes!')
      </script><?php
    }
}
    $sql .= " WHERE email = ?";
    $params[] = $userEmail;
    $types .= "s"; 

   
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        die("Erro ao preparar a consulta: " . $conn->error);
    }

    $stmt->bind_param($types, ...$params);

    
    if ($stmt->execute()) {
        echo "<h4>Perfil atualizado com sucesso!</h4>";
    } else {
        echo "<p>Erro ao atualizar perfil: " . $stmt->error . "</p>";
    }

    $stmt->close();
}

?>
            <!-- Formulário de edição de foto, senha e nome -->
        <div class="linha"> 
            <div class="col-2">
                <div id="FormEdit" class="formulario-edit">
                <h1 style="color: #000000;">Editar Perfil</h1>
                <!-- Formulário de Edição de Perfil -->
                
                <form action="editar-perfil.php" method="POST" enctype="multipart/form-data">
                    <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($user['nome']); ?>" placeholder="Novo nome de usuário" required>
                    <input type="password" id="senha" name="senha" placeholder="Nova senha" >

                    <input type="password" id="senha" name="confirmar" placeholder="Confirmar senha">
                    <input type="text" name="endereco" value="<?php echo htmlspecialchars($user['endereco']); ?>" placeholder="Novo endereço">
                    <input type="text" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" placeholder="Novo email">    

                    <input type="tel" name="celular" value="<?php echo htmlspecialchars($user['celular']); ?>" data-mask="(00)00000-0000" data-mask-selectonfocus="true" placeholder="n° de telefone - (xx) xxxxx-xxxx">
                    <textarea name="descricao" class="area-input" placeholder="Descreva quem é você com poucas palavras" id=""><?php echo htmlspecialchars($user['descricao']); ?></textarea>
                    
                    <button class="btn" style="border: 0;" type="submit">Salvar Alterações</button>                    
                    <div id="overlay"></div>

                    <button class="btn" type="button" onclick="openEditFoto()">Editar Foto</button>
                    <div class="perfil-foto">
                    
                    </div><a href='usuario.php'"><button type="button" class="btn">Voltar</button></a> 
        </div> 
     </form>     
     <form action="editar-perfil.php" enctype="multipart/form-data" method="post">
    <div id="edit-foto-container">
    <div id="crop-area">
        <img id="crop-image" src="" alt="">
    </div>
    <div id="buttons-container">
        <input class="btn" type="file" id="file-input" onchange="previewImage(event)" >
        <button class="btn" type="submit" onclick="saveImage()">Salvar</button>
        <button class="btn" type="button" onclick="closeEditFoto()">Cancelar</button>
    </div>
</div>
</form>
        </div>
        </div>
        </div>
        </div>
    
    <br><br><br></br>
</section>
<br><br><br><br>
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
    <script src="assets/js/script.js"></script>
</body>
</html>
