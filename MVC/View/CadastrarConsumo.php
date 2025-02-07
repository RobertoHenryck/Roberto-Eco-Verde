<?php
require_once  'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\config.php';
require_once  'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\MVC\Controller\Controller.php';

$Controller = new Controller($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $consumo_de_estacao = $_POST['consumo_de_estacao'];
    $consumo_do_servidor = $_POST['consumo_do_servidor'];
    $consumo_de_iluminacao = $_POST['consumo_de_iluminacao'];
    $consumo_de_climatizacao = $_POST['consumo_de_climatizacao'];
    $consumo_de_equipamentos = $_POST['consumo_de_equipamentos'];

    $resultado = $Controller->cadastrarConsumo(
        consumo_de_estacao: $consumo_de_estacao, 
        consumo_do_servidor: $consumo_do_servidor, 
        consumo_de_iluminacao: $consumo_de_iluminacao, 
        consumo_de_climatizacao: $consumo_de_climatizacao, 
        consumo_de_equipamentos: $consumo_de_equipamentos
    );

    if ($resultado) {
        header('Location: index.php');
        exit;
    } else {
        echo 'Erro ao cadastrar';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Roberto ÉCO VERDE</title>
</head>

<body>
    <center>
        <h1>Cadastrar Consumo</h1>

        <form method="POST" action="#">
            <label for="consumo_de_estacao">Consumo da Estação</label>
            <br>
            <input type="text" name="consumo_de_estacao" required />
            <br>
            <label for="consumo_do_servidor">Consumo do Servidor</label>
            <br>
            <input type="text" name="consumo_do_servidor" required />
            <br>
            <label for="consumo_de_iluminacao">Consumo de Iluminação</label>
            <br>
            <input type="text" name="consumo_de_iluminacao" required />
            <br>
            <label for="consumo_de_climatizacao">Consumo de Climatização</label>
            <br>
            <input type="text" name="consumo_de_climatizacao" required />
            <br>
            <label for="consumo_de_equipamentos">Consumo de Equipamentos</label>
            <br>
            <input type="text" name="consumo_de_equipamentos" required />
            <br>
            <br>

            <button type="submit">Cadastrar Consumo</button>

        </form>

        <br>

        <a href="../index.php">Voltar</a>
    </center>

</body>

</html>
