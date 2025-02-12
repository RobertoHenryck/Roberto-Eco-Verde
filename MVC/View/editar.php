<?php

require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\config.php';
require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\MVC\Controller\Controller.php';

session_start();

$Controller = new Controller($pdo);

$Consumos = $Controller->listarConsumo($_SESSION['usuario_id']);

$message = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $id = $_POST['id'];

    $result = $Controller->deletarConsumo($id);
    if ($result) {
        $message = "Consumo deletado com sucesso!";
    } else {
        $message = "Falha ao deletar o Consumo.";
    }
    header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Deletar Consumo</title>
</head>

<body>
    <center>
        <h1>Deletar Consumo</h1>

        <?php if (!empty($message)): ?>
            <p><?php echo htmlspecialchars($message); ?></p>
        <?php endif; ?>

        <form method="POST">
            <div>
                <label for="id">Selecionar Consumo</label>
                <br>
                <select name="id">
                    <?php foreach ($Consumos as $Consumo): ?>
                        <option value="<?= $Consumo['id']; ?>"><?= "$Consumo[id] - $Consumo[consumo_de_estacao]"; ?></option>
                    <?php endforeach; ?>
                </select>
                <br><br>
                <input type="submit" value="Deletar Consumo">
            </div>
        </form>

        <br>
        <a href="../index.php">Voltar à sua lista</a>
        <br>
        <a href="Cadastrar_Consumo.php">Cadastrar novo Consumo</a>
    </center>
</body>

</html>
