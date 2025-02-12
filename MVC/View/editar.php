<?php

require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\config.php';
require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\MVC\Controller\Controller.php';

$Controller = new Controller($pdo);

$Consumos = $Controller->listarConsumo(); // Alterando o nome da função para listarConsumo

if (
    isset($_POST['update_consumo_de_estacao']) &&
    isset($_POST['update_consumo_do_servidor']) &&
    isset($_POST['update_consumo_de_iluminacao']) &&
    isset($_POST['update_consumo_de_climatizacao']) &&
    isset($_POST['update_consumo_de_equipamentos']) &&
    isset($_POST['id']) &&
    isset($_POST['update_id_usuario']) // Adicionando id_usuario
) {
    // Chamando a função com o novo parâmetro id_usuario
    $Controller->editarConsumo(
        $_POST['update_consumo_de_estacao'],
        $_POST['update_consumo_do_servidor'],
        $_POST['update_consumo_de_iluminacao'],
        $_POST['update_consumo_de_climatizacao'],
        $_POST['update_consumo_de_equipamentos'],
        $_POST['id'],
        $_POST['updateid_usuario'] // Novo parâmetro
    );

    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Consumo</title>
</head>

<body>
    <center>
        <form action="#" method="POST">
            <h1>Editar Consumo</h1>
            <div>

                <label for="id">Seleciona o Consumo</label>
                <br>
                <select name="id">
                    <?php foreach ($Consumos as $Consumo): ?>
                        <option value="<?= $Consumo['id']; ?>"><?= "$Consumo[id] - $Consumo[consumo_de_estacao]"; ?></option>
                    <?php endforeach; ?>
                </select>

                <br>
                <input type="text" name="update_consumo_de_estacao" placeholder="Consumo de Estação">
                <br>
                <input type="text" name="update_consumo_do_servidor" placeholder="Consumo do Servidor">
                <br>
                <input type="text" name="update_consumo_de_iluminacao" placeholder="Consumo de Iluminação">
                <br>
                <input type="text" name="update_consumo_de_climatizacao" placeholder="Consumo de Climatização">
                <br>
                <input type="text" name="update_consumo_de_equipamentos" placeholder="Consumo de Equipamentos">
                <br>
                <input type="text" name="update_id_usuario" placeholder="ID do Usuário"> <!-- Novo campo -->
                <br>
                <button type="submit">Editar</button>
                <br>
                <a href="/MVC/listar.php">Voltar</a>
            </div>
        </form>
    </center>
</body>

</html>
