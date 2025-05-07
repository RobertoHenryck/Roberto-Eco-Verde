<?php
require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\config.php';
require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\MVC\Controller\Controller.php';

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}

$Controller = new Controller($pdo);
$Feedbacks = $Controller->listarfeedback();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Feedback</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Oswald:wght@200..700&display=swap');

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
            font-family: 'Josefin Sans';
            background-color: #fff;
        }

        .navbar {
            position: sticky;
            z-index: 1000;
            top: 0;
            display: flex;
            justify-content: space-around;
            background-color: #1b4332;
            height: 150px;
            gap: 600px;
            align-items: center;
            width: 100%;
        }

        h3,
        a {
            text-decoration: none;
            font-size: 30px;
            color: white;
            padding: 20px;
        }

        a:hover {
            color: #2d6a4f;
            transform: scale(1.1);
        }

        footer {
            margin-top: auto;
            width: 100%;
            display: flex;
            justify-content: space-around;
            background-color: #1b4332;
            align-items: center;
            gap: 600px;
            padding: 20px 0;
        }

        h1 {
            font-size: 50px;
            margin-top: 30px;
            display: flex;
            justify-content: center;
        }

        table {
            width: 90%;
            border-collapse: collapse;
            margin-top: 20px;
            border: none;
            padding: 40px;
            margin: 0 auto;
        }

        th,
        td {
            border: 1px solid #1b4332;
            padding: 20px;
            text-align: center;
            font-size: 20px;
        }

        th {
            background-color: #1b4332;
            color: white;
        }

        .botoes {
            margin-top: 50px;
            display: flex;
            justify-content: center;
            width: 400px;
            font-size: 30px;
            margin: 0 auto;
        }

        .botoes a {
            display: inline-block;
            margin: 20px;
            padding: 10px;
            background-color: #1b4332;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        @media screen and (max-width: 600px) {
            table {
                width: 300vw;
                display: block;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            th,
            td {
                display: block;
                width: 100%;
                box-sizing: border-box;
                font-size: 22px;
                /* Aumenta o tamanho da fonte */
                padding: 30px;
                /* Aumenta o padding */
            }

            th {
                background-color: #1b4332;
                color: white;
                text-align: left;
            }

            td {
                border-top: 1px solid #1b4332;
                border-bottom: 1px solid #1b4332;
                text-align: left;
            }

            tr {
                display: block;
                margin-bottom: 20px;
                /* Adiciona mais espaço entre as linhas */
            }

            td::before {
                content: attr(data-label);
                font-weight: bold;
                display: inline-block;
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <div class="navbar">
        <?php if (isset($_SESSION['usuario_tipo'])): ?>
            <h3>Bem-vindo(a), <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</h3>
        <?php endif; ?>

        <div class="nav2">
            <a href="feedback.php">Registrar Feedback </a>
            <a href="PáginaInicial.php">Página Inicial</a>

            <?php if (isset($_SESSION['usuario_id'])): ?>
                <a href="?logout=true">Sair</a>
            <?php endif; ?>
        </div>
    </div>

    <h1>Lista de Feedbacks Registrados</h1>
    <div class="tabela">
        <div>
            <?php if (!empty($Feedbacks)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Feedback</th>
                            <th>Email</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Feedbacks as $Feedback): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($Feedback['id']); ?></td>
                                <td><?php echo htmlspecialchars($Feedback['nome']); ?></td>
                                <td><?php echo htmlspecialchars($Feedback['feedback']); ?></td>
                                <td><?php echo htmlspecialchars($Feedback['email']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <div class="botoes">
                    <a href="feedback.php">Escreva um feedback</a>
                </div>
            <?php else: ?>
                <p>Nenhum feedback registrado</p>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <h3>ROBERTO ÉCO VERDE - ©Todos os direitos reservados</h3>
        <img src="../../IMG/LOGO ROBERTO ÉCO VERDE.png" alt="">
    </footer>
</body>

</html>