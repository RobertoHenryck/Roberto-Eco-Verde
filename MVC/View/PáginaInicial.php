<?php
require_once 'C:\xampp\htdocs\ROBERTO-ECO-VERDE\config.php';
require_once 'C:\xampp\htdocs\ROBERTO-ECO-VERDE\MVC\Controller\Controller.php';

session_start();

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Oswald:wght@200..700&display=swap');
    
    html, body {
        margin: 0;
        padding: 0;
        font-family: 'Josefin Sans';
        background-color: #ffffff;
        height: 100%;
    }

    .navbar {
        position: sticky;
        z-index: 1000;
        top: 0;
        display: flex;
        justify-content: space-around;
        background-color: #1b4332;
        height: 100px;
        gap: 640px;
        align-items: center;
        width: 100%;
    }

    a {
        color: white;
        text-decoration: none;
        font-size: 20px;
        padding: 10px;
        margin: 10px;
        transition: color 0.3s ease, transform 0.3s ease;
    }

    a:hover {
        color: #2d6a4f;
        transform: scale(1.1);
    }

    p {
        color: black;
        font-size: 20px;
        padding: 10px;
        margin: 10px;
    }

    h1 {
        color: black;
        font-size: 40px;
        padding: 10px;
        margin: 10px;
    }

    .conteudo {
        padding: 20px;
    }

    h2 {
        color: black;
        font-size: 30px;
    }

    h3 {
        color: white;
    }

    ul {
        color: black;
        font-size: 18px;
        padding-left: 20px;
    }

    .fundo {
        background-color: #e9ecef;
        height: 200px;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
    }

    .conteudo {
        min-height: calc(100vh - 100px); 
        padding: 20px;
    }

    .texto1 {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 80%;
        margin: 20px auto;
    }

    .texto1 p {
        font-size: 18px;
        text-align: justify;
        color: #333;
    }

    .texto1 p strong {
        font-weight: bold;
        color: #1b4332;
    }

    /* Estilizando listas */
    ul li {
        margin-bottom: 10px;
    }
    footer{
        background-color: #1b4332;
        color: white;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px;
     
        height: 190px;
    }

    </style>
</head>
<body>

<div class="navbar">
    <?php if (isset($_SESSION['usuario_tipo'])) {
        echo "<h3>Bem vindo(a)! $_SESSION[usuario_tipo] " . $_SESSION['usuario_nome'] . '!</h3>';
    }
    ?>

    <div class="nav2">
        <a href="CadastrarConsumo.php">Cadastrar Consumo</a>
        <a href="listar.php">Listar meu Consumo</a>
        <a href="editar.php">Editar Consumo</a>

        <?php if (isset($_SESSION['usuario_id'])): ?>
            <a href="?logout=true">Sair</a>
        <?php endif; ?>
    </div>
</div>

<div class="conteudo">
   <div class="fundo"> 
       <h1>- Sobre Nós</h1>
   </div>

   <div class="texto1">
       <p>O nosso site foi desenvolvido com o objetivo de fornecer uma plataforma prática e eficiente para que empresas e indivíduos possam monitorar e gerenciar seu consumo energético de forma consciente e sustentável. Em um cenário onde a preservação ambiental e a otimização dos recursos são cada vez mais essenciais, nosso sistema oferece uma ferramenta poderosa para o controle do consumo de energia.</p>
   </div>

    <div class="texto1"><ul>
    <h1>Principais funcionalidades:</h1>
        <li><strong>Cadastro de Consumo:</strong> Permite que você registre de maneira simples e rápida o consumo de energia de sua empresa ou residência, garantindo um controle detalhado.</li>
        <li><strong>Consulta de Consumo:</strong> Através da plataforma, é possível consultar e visualizar o histórico de consumo de energia, o que ajuda a identificar padrões e a adotar práticas mais eficientes.</li>
        <li><strong>Edição de Consumo:</strong> Caso haja a necessidade de ajustes nos dados cadastrados, nossa plataforma oferece uma funcionalidade para editar as informações com facilidade.</li>
        <li><strong>Perfil Personalizado:</strong> Seu consumo de energia fica visível apenas para você, garantindo a privacidade e o controle total sobre os dados registrados.</li>
    </ul>
    

    <p>Além disso, nosso site está integrado com práticas e diretrizes do conceito de <strong>TI Verde</strong>, oferecendo uma abordagem focada na sustentabilidade, eficiência energética e redução de impactos ambientais.</p>

    <h1><strong>Nossa missão</strong></h1>

    <p>É ajudar você a entender melhor como seu consumo energético afeta o meio ambiente e possibilitar ações que promovam a redução de desperdícios, economizando recursos e, ao mesmo tempo, contribuindo para um planeta mais sustentável.</p>
</div>
</div>
<footer>
    <div class="navbar">
        <h3>ROBERTO ÉCO VERDE - Todos os direitos reservados</h3>
        <img src="../../IMG/LOGO ROBERTO ÉCO VERDE.png" alt="">
    </div>

</body>
</html>
