<?php
require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\config.php';
require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\MVC\Controller\Controller.php';

$Controller = new Controller($pdo);
$Consumos = $Controller->listarConsumo();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Consumo</title>
</head>

<body>
    <div class="login"> 
        <?php
        if (isset($_COOKIE['Usuario'])) {
            echo "Bem vindo(a)! $_COOKIE[Usuario]!";
        }
        ?>
    </div>

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
                        <th>Consumo de Equipamentos (kWh)</th>
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
                <a href="Organizador de Consumo/Cadastrar_Consumo.php">Cadastrar Consumo</a>
                <br>
                <a href="pagina_de_perfil.php">Página de Perfil</a>
                <br>
            </div>
        <?php else: ?>
            <p>Nenhum consumo registrado</p>
        <?php endif; ?>
    </div>
</body>

</html>
