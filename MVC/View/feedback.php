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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $feedback = $_POST['feedback'];
    $email = $_POST['email']; 

    $resultado = $Controller->cadastrarfeedback(
        $nome,
        $feedback,
        $email
    );

    if ($resultado) {
        header('Location: PáginaInicial.php');
        exit;
    } else {
        echo 'Erro ao cadastrar';
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feedback</title>
</head>

<body>

    <form method="POST">

        <label for="nome">Seu nome</label>
        <input type="text" name="nome" required>

        <label for="feedback">Feedback</label>
        <textarea type="text" name="feedback" required></textarea>

        <label for="email">Email</label>
        <input type="email" name="email" required>

        <button type="submit">Enviar</button>

    </form>

</body>

</html>