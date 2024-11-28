<?php
session_start();
require("conectar.php");
if (!isset($_SESSION['user_nome']) || !isset($_SESSION['user_email'])) {
    header("Location: login.php");
    exit();
}

$userEmail = $_SESSION['user_email'];

// Consulta para obter a foto do perfil do usuário
$sql = "SELECT nome, celular, endereco, descricao, foto_perfil FROM user WHERE email = ?";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Studio Patty Leão - Tratamentos, cortes, com zelo, carinho e cuidado
    </title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/img/logo.png" />

    </head>
<body>
    <div class="banner">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                    <a href="inicio.php" ><img class="logoImagem" src="assets/img/logo.png" alt="Studio" width="120px">
                </div>
                <nav>
                    <ul id="MenuItens">
                        <li class="navword"><a href="início.php">Início</a></li>
                        <li class="navword"><a  href="serviços.html">Serviços</a></li>
                        <li class="navword"><a  href="index.html">logout</a></li>
                        
                    </ul>
                </nav>
                <a href="https://wa.me/message/4YWF26SVIUX2J1" title="">
                <img src="assets/img/agendar.png" class="agendar"alt="agendamento de serviços" width="80px" ></a>
                <a href="usuario.php"><img src="<?php echo htmlspecialchars($fotoPerfil) . '?v=' . time(); ?>" class="perfil-usuario" alt=""></a>
                <img src="assets/img/menu.png" alt="Menu Celular" class="menu-celular" onclick="menucelular()">
            </div>
                <div class="linha">
                <div class="col-2">
                <h1 class="titleIndex">Seu cabelo<br>Nosso cuidado</h1>
                <p>Serviços atenciosos e cuidadosos com seu xodó</p>
                <br><a href="cadastro.html" class="btn">Cadastre-se já &#8594;</a>
            </div>
                <div class="col-2">
                
                <img class="imagem-banner" src="assets/img/model-hair.png" style="
                    padding: 0; 
                    width: 475px;"
                     alt="">
                </div>
            </div>
        </div>
    </div>
    
        <section class="secaoSobre">
            <div class="container">
            <div class="linha">
                
                <div class="col-2">
                    <h2>Sobre nós</h2>
                    <h2>Somos Studio Patty Leão.</h2>
                    <h4>Nosso objetivo é cuidar do seu xodó com maestria e amor</h4>
                </div>
                <div class="col-2">
                    <img class="imagemSobre" src="assets/img/model-sobre.jpg"  width="450px" alt="">
            </div>
        </div>
    </section>
        <section class="secListra">
            <div class="container">
            <div class="linha">
                <div class="col-2">
                    <img class="imagemSobre" src="assets/img/instituto.png" alt="">
            </div>
            
            <div class="col-2">
                    <h2>Como começamos:</h2>
                    <h2>Curso de cabeleireira</h2>
                    <p>Dois anos atrás, Patrícia Leão de Oliveira resolveu fazer um curso profissionalizante no instituto Ana Hickmann, onde por muito tempo estudou os tipos de cortes, tratamentos e a ciencia geral na área de cabeleireiros, o que deu início a um sonho de ter o próprio espaço.</p>
                </div>
            </div>    
        </div>
                </section>
                        <section class="secListra1">
                            <div class="container">
                            <div class="linha">
                                <div class="col-2">
                                    <h2>Início de um sonho:</h2>
                                    <h2>Espaço adquirido</h2>
                                    <p>Ao finalizar o curso, começaram os preparativos para um salão e de forma milagrosa, uma amiga que há muito tempo não aparecia tinha um local disponível para aluguel e reforma. Esse local era um antigo bar, gerido pelo seu Manuel, o dono do local, que mora ao lado dele. Com ajuda do pastor, da familia e de alguns parentes e irmãos da igreja, o projeto foi iniciado. </p>
                                </div>
                                
                                <div class="col-2">
                                    <img class="imagemSobre" src="assets/img/Processo/img-1.jpg" alt="">
                            </div>
                        </div>    
                    </div>
                </section>
                <section class="secListra">
                    <div class="container">
                    <div class="linha">
                        <div class="col-2">
                            <img class="imagemSobre" src="assets/img/Processo/img-9.jpg" alt="">
                    </div>
                    
                    <div class="col-2">
                            <h2>Vários colaboradores:</h2>
                            <h2>Desenvolvimento</h2>
                            <p>Várias pessoas nos ajudaram, como a irmã Neide e o seu Manuel, que nos disponibilizaram o aluguel do espaço e nos instruiram acerca de como as coisas estavam funcionando por la. Um dos maiores contribuintes foi o pastor Silas, que nos ajudou bastante fazendo o rejunte, o piso, além disso ajudou também com relação ao encanamento para a saída de água no lavatório.</p>
                        </div>
                    </div>    
                </div>
            </section>
            <section class="secListra1">
                <div class="container">
                <div class="linha">
                    <div class="col-2">
                        <h2>Progresso em diversas áreas:</h2>
                        <h2>Colaboradores</h2>
                        <p>Nosso vizinho Aloísio ajudou recolocando os fios necessários para se acender as lâmpadas de dentro e fora sem a necessidade de ligar diretamente na caixa de força. Ele também instalou sistema de aquecimento na água do lavatório, para o caso de clientes agendarem em dias de baixa temperatura. Luiz Fernando, o marído de Patricia, ajudou com os custos, ajudando efetivamente em quase todas as áreas, sua contribuição foi essencial. Um irmão chamado Fábio ajudou na contrução pintando uma parte das paredes.</p>
                    </div>
                    
                    <div class="col-2">
                        <img class="imagemSobre" src="assets/img/Processo/img-41.jpg" alt="">
                </div>
            </div>    
        </div>
    </section>

    <section class="secListra">
        <div class="container">
        <div class="linha">
            <div class="col-2">
                <img class="imagemSobre" src="assets/img/Processo/img-54.jpg" alt="">
        </div>
        
        <div class="col-2">
                <h2>Vários colaboradores:</h2>
                <h2>Desenvolvimento</h2>
                <p>Com muito trabalho, oração e esforço, após alguns meses o espaço foi ficando cada vez mais perto de se tornar um salão.</p>
            </div>
        </div>    
    </div>
</section>
<section class="secListra1">
    <div class="container">
    <div class="linha">
        <div class="col-2">
            <h2>Finalização e abertura:</h2>
            <h2>O sonho virou realidade!</h2>
            <p>De fato, foi um trabalho árduo e longo, foram necessários sacrificios, houveram percalços mas tudo correu bem. Agora o salão foi recém-inaugurado, faltando apenas algumas coisas pequenas para estar completo, suas atividades começarão em breve.</p>
        </div>
        
        <div class="col-2">
            <img class="imagemSobre" src="assets/img/Processo/img-61.jpg" alt="">
    </div>
</div>    
</div>
</section>
        <div class="depoimentos">
            <h1>Funcionários</h1>
            <div class="corpo-categorias">
                <div class="linha">
                    <div class="col-3">
                        <ion-icon name="ribbon" class="depoimento-icone"></ion-icon>
                        <p>Patrícia Leão de Oliveira é a gerente do salão e uma cabeleireira incível, a principal cabeleireira do salão, cujos serviços são perfeitamente minunciosos, com atenção e zelo redobrados.</p>
                        <div class="classificacao">
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                        </div>
                        <img src="assets/img/perfil.jpg">
                        <h3>Patrícia Leão de oliveira - Cabeleireira e administradora</h3>
                    </div>

                   
                    <div class="col-3">
                        <ion-icon name="ribbon" class="depoimento-icone"></ion-icon>
                        <p>Luiz Fernando Menezes de Oliveira foi quem proveu mais recursos para o salão, ajudando efetivamente a gerir cada gasto e lucro. Seu serviço foi e é de fato essencial.</p>
                        <div class="classificacao">
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                        </div>
                        <img src="assets/img/perfil-pai.jpg" alt="">
                        <h3>Luiz Fernando Menezes de Oliveira - Provedor</h3>
                    </div>
                    <div class="col-3">
                        <ion-icon name="ribbon" class="depoimento-icone"></ion-icon>
                        <p>Daniel Henrique Leão de Oliveira foi o responsável pela criação do site para agendamento de serviços no salão, atuando também no processo de construção.</p>
                        <div class="classificacao">
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                            <ion-icon name="star"></ion-icon>
                        </div>
                        <img src="assets/img/perfil-filho.jpg" alt="">
                        <h3>Daniel Henrique Leão de Oliveira - Programador</h3>
                    </div>
                </div>
            </div>
        </div>
    <section class="agendamento">
        <div class="container">
            <div class="linha">
                <div class="col-2">
                    <form action="cadastro.html">
                    <h1 class="h1-agendamento">Agende já seu <br> tratamento!</h1>
                        <input class="btn" type="submit" value="Cadastre-se &#8594;" > 
                    </form>
                </div>
                <div class="col-2">
                    <img src="assets/img/modelo-cabelo-agendar.png" style="padding:0;" alt="">
                </div>
                
                </div>
            </div>
        </section>
    
        <div class="marcas">
            <div class="corpo-categorias">
                <div class="linha">
    
                   <div class="col-5">
                    <img src="assets/img/marca-1.png" alt="">
                   </div>
                   <div class="col-5">
                    <img src="assets/img/marca-2.png" alt="">
                   </div>
                   <div class="col-5">
                    <img src="assets/img/marca-3.png" alt="">
                   </div>
                   <div class="col-5">
                    <img src="assets/img/marca-4.png" alt="">
                   </div>
                   <div class="col-5">
                    <img src="assets/img/marca-5.jpeg" alt="">
                   </div>
    
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