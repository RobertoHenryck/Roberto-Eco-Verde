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

    $Controller = new Controller($pdo);
    $Consumos = $Controller->listarConsumo($_SESSION['usuario_id']);
    ?>


    <!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gerenciamento de Consumo</title>
        <style>
            @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@100..700&display=swap');

            body {
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                margin: 0;
                font-family: 'Josefin Sans', sans-serif;
                transition: color 0.3s ease, transform 0.3s ease;
                background-color: #fff;
            }

            .navbar {
                position: sticky;
                z-index: 1000;
                top: 0;
                display: flex;
                justify-content: space-around;
                background-color: #1b4332;
                height: 100px;
                gap: 550px;
                align-items: center;
                width: 100%;
            }
            a:hover {
            color: #2d6a4f;
            transform: scale(1.1);
        }

            a,
            h3 {
                color: white;
                text-decoration: none;
                padding: 20px;
                font-size: 20px;
            }

            table {
                width: 1000px;
                border-collapse: collapse;
                margin-top: 20px;
            }

            .tabela {
                display: flex;
                justify-content: center;
                align-items: center;
            }

            th,
            td {
                border: 1px solid black;
                padding: 10px;
                text-align: center;
            }

            th {
                background-color: #1b4332;
                color: white;
            }

            .botoes {
                margin-top: 20px;
                display: flex;
                justify-content: center;
            }

            .botoes a {
                display: inline-block;
                margin: 10px;
                padding: 10px;
                background-color: #1b4332;
                color: white;
                text-decoration: none;
                border-radius: 5px;
            }
        </style>
    </head>

    <body>
        <div class="navbar">
            <?php if (isset($_SESSION['usuario_tipo'])): ?>
                <h3>Bem-vindo(a), <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</h3>
            <?php endif; ?>

            <div class="nav2">
                <a href="CadastrarConsumo.php">Registrar Consumo</a>
                <a href="PáginaInicial.php">Página Inicial</a>

                <?php if (isset($_SESSION['usuario_id'])): ?>
                    <a href="?logout=true">Sair</a>
                <?php endif; ?>
            </div>
        </div>

        <h1>Lista de Consumo Registrado</h1>
        <div class="tabela">
            <div>
                <?php if (!empty($Consumos)): ?>
                    <table>
                        <thead>
                        <thead>
    <tr>
        <th>ID</th>
        <th>Consumo da Estação (kWh)</th>
        <th>Consumo do Servidor (kWh)</th>
        <th>Consumo de Iluminação (kWh)</th>
        <th>Consumo de Climatização (kWh)</th>
        <th>Consumo de Equipamentos (kWh)</th>
        <?php if ($_SESSION['usuario_tipo'] == 'admin') { ?>
            <th>Editar</th>
            <th>Deletar</th> 
        <?php } ?>
    </tr>
</thead>
<tbody>
    <?php foreach ($Consumos as $Consumo): ?>
        <tr>
            <td><?php echo htmlspecialchars($Consumo['id']); ?></td>
            <td><?php echo htmlspecialchars($Consumo['consumo_de_estacao']); ?></td>
            <td><?php echo htmlspecialchars($Consumo['consumo_do_servidor']); ?></td>
            <td><?php echo htmlspecialchars($Consumo['consumo_de_iluminacao']); ?></td>
            <td><?php echo htmlspecialchars($Consumo['consumo_de_climatizacao']); ?></td>
            <td><?php echo htmlspecialchars($Consumo['consumo_de_equipamentos']); ?></td>
            <?php if ($_SESSION['usuario_tipo'] == 'admin') { ?>
                <td>
                    <a href='editar.php?id=<?php echo htmlspecialchars($Consumo['id']); ?>'>✏️</a>
                </td>
                <td>
                    <a href="deletar.php?id=<?php echo htmlspecialchars($Consumo['id']); ?>" onclick="return confirm('Tem certeza que deseja deletar este consumo?')">❌</a>
                </td>
            <?php } ?>
        </tr>
    <?php endforeach; ?>
</tbody>

                    </table>
                    <div class="botoes">
                        <a href="CadastrarConsumo.php">Cadastrar Consumo</a>
                    </div>
                <?php else: ?>
                    <p>Nenhum consumo registrado</p>
                <?php endif; ?>
            </div>
        </div>
    </body>

    </html>
