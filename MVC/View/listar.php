<?php
require_once 'C:\xampp\htdocs\ROBERTO-ECO-VERDE\config.php';
require_once 'C:\xampp\htdocs\ROBERTO-ECO-VERDE\MVC\Controller\Controller.php';

session_start();

$Controller = new Controller($pdo);
$Consumos = $Controller->listarConsumo($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Consumo</title>
</head>

<body>

    <?php if (isset($_SESSION['usuario_tipo'])) {
        echo "Bem vindo(a)! $_SESSION[usuario_tipo]    "  . $_SESSION['usuario_nome'] . '!';
    }
    ?>
    <h1>Lista de Consumo Registrado</h1>

    <div>
        <?php if (isset($Consumos) && is_array($Consumos) && count($Consumos) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Consumo da Estação (kWh)</th>
                        <th>Consumo do Servidor (kWh)</th>
                        <th>Consumo de Iluminação (kWh)</th>
                        <th>Consumo de Climatização (kWh)</th>
                        <?php

                        if ($_SESSION['usuario_tipo'] == 'admin') { ?>
                            <th>Consumo de Equipamentos (kWh)</th>
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


                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="botoes">
                <a href="CadastrarConsumo.php">Cadastrar Consumo</a>
                <br>
                <?php if ($_SESSION['usuario_tipo'] == 'admin') { ?>
                    <a href="editar.php">Editar</a>
                <?php } ?>
                <br>
            </div>
        <?php else: ?>
            <p>Nenhum consumo registrado</p>
        <?php endif; ?>
    </div>
</body>

</html>