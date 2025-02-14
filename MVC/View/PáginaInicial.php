<?php
require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\config.php';
require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\MVC\Controller\Controller.php';

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

        html,
        body {
            margin:  0 auto;
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
                height: 150px;
                gap: 550px;
                align-items: center;
                width: 100%;
            }
        
        a {
            color: white;
            text-decoration: none;
            font-size: 30px;
            padding: 20px;
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

      
        li {
            font-size: 25px;
        }

        h2 {
            color: black;
            font-size: 20px;
        }

        h3 {
            color: white;
            font-size: 30px;
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
            margin: 0 auto;
            

        }

        .texto1 {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            width: 90%;
            margin: 20px auto;
        }

        .texto1 p {
            font-size: 25px;
            text-align: justify;
            color: #333;
        }

        .texto1 p strong {
            font-weight: bold;
            color: #1b4332;
        }


        ul li {
            margin-bottom: 10px;
        }

        footer {
            background-color: #1b4332;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;

            height: 190px;
        }
        @media screen and (max-width: 800px) {
    .navbar {
        flex-direction: column;
        height: auto;
        gap: 10px;
        padding: 10px;
        text-align: center;
    }

    .nav2 {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .nav2 a {
        display: block;
        padding: 8px;
    }

    .conteudo {
        padding: 15px;
    }

    .texto1 {
        width: 100%;
    }

    .texto1 p {
        font-size: 18px;
        text-align: center;
    }

    .fundo {
        height: 150px;
        text-align: center;
    }

    .fundo h1 {
        font-size: 26px;
    }

    ul {
        padding-left: 10px;
    }

    li {
        font-size: 18px;
    }

    footer {
        flex-direction: column;
        text-align: center;
        height: auto;
        padding: 20px;
    }

    footer img {
        display: none; /* Oculta a logo para não ocupar espaço */
    }
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
            <a href="listar.php">Meu Consumo</a>

            <?php if (isset($_SESSION['usuario_id'])): ?>
                <a href="?logout=true">Sair</a>
            <?php endif; ?>
        </div>
    </div>

    <div class="conteudo">
        <div class="fundo">
            <h1>🌱 TI Verde: Sustentabilidade na Tecnologia</h1>
        </div>

        <div class="texto1">

            <p>A TI Verde (ou Green IT) é um conceito que busca tornar o uso da tecnologia mais sustentável, reduzindo impactos ambientais, otimizando o consumo de energia e promovendo a reutilização de recursos tecnológicos. Empresas e governos estão cada vez mais investindo em práticas sustentáveis para minimizar o consumo excessivo de energia e o descarte inadequado de resíduos eletrônicos.</p>
        </div>

        <div class="texto1">
            <ul>
                <h1>✅ Por que a TI Verde é Importante?</h1>
                <br>
                <p><strong>A revolução digital</strong> trouxe inúmeros benefícios, mas também aumentou o consumo de energia e a produção de lixo eletrônico. Alguns números mostram a urgência da adoção de TI Verde:</p>
                <br>
                <li> Data centers consomem cerca de 1% da eletricidade mundial.</li>
                <li> A produção de um único laptop pode gerar até 120 kg de CO₂.</li>
                <li> A cada ano, o mundo gera mais de 50 milhões de toneladas de lixo eletrônico.</li>
                <li> Cerca de 20% dos resíduos eletrônicos são reciclados corretamente – o restante é descartado de forma inadequada.</li>

                <div class="texto1">
                    <h1>💡 Como Reduzir os Custos de Energia com a TI Verde?</h1>
                    <p>A adoção de práticas de TI Verde pode ajudar empresas e usuários a economizar energia e reduzir o impacto ambiental. Aqui estão algumas sugestões:</p>
                    <ul>
                        <li>✅ Utilize servidores e computadores com certificação de eficiência energética.</li>
                        <li>✅ Opte por fontes de energia renováveis para alimentar seus dispositivos.</li>
                        <li>✅ Configure sistemas para o modo de economia de energia sempre que possível.</li>
                        <li>✅ Adote a virtualização de servidores para reduzir o consumo de hardware físico.</li>
                        <li>✅ Faça a manutenção regular de equipamentos para evitar desperdícios energéticos.</li>
                        <li>✅ Invista em data centers ecologicamente corretos com melhor eficiência térmica.</li>
                        <li>✅ Descarte corretamente equipamentos eletrônicos obsoletos, garantindo sua reciclagem.</li>
                        <li>✅ Incentive o trabalho remoto para reduzir o consumo de energia nos escritórios.</li>
                    </ul>
                    <p>Com pequenas mudanças, podemos transformar a tecnologia em uma aliada do meio ambiente e ainda reduzir custos operacionais. 🌱💚</p>
                </div>

                <p>Além disso, nosso site está integrado com práticas e diretrizes do conceito de <strong>TI Verde</strong>, oferecendo uma abordagem focada na sustentabilidade, eficiência energética e redução de impactos ambientais.</p>

                <h1><strong>Nossa missão</strong></h1>

                <p>É ajudar você a entender melhor como seu consumo energético afeta o meio ambiente e possibilitar ações que promovam a redução de desperdícios, economizando recursos e, ao mesmo tempo, contribuindo para um planeta mais sustentável.</p>
        </div>
    </div>
    <footer>
        <div class="navbar">
            <h3>ROBERTO ÉCO VERDE - ©Todos os direitos reservados</h3>
            <img src="../../IMG/LOGO ROBERTO ÉCO VERDE.png" alt="">
        </div>

</body>

</html>