<?php

require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\config.php';
require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\MVC\Controller\Controller.php';

session_start();

// Verificar se o usuário está autenticado e é admin
if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] != 'admin') {
    // Se não estiver autenticado ou não for admin, redirecionar para a página inicial
    header("Location: .listar.php?message=Você não tem permissão para realizar essa ação.");
    exit;
}

// Verificar se o ID foi passado via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Instanciar o controlador e chamar a função de deletar
    $Controller = new Controller($pdo);
    $result = $Controller->deletarConsumo($id);

    if ($result) {
        // Redirecionar com mensagem de sucesso
        header("Location: listar.php?message=Consumo deletado com sucesso!");
    } else {
        // Redirecionar com mensagem de erro
        header("Location: listar.php?message=Falha ao deletar o consumo.");
    }
} else {
    // Se o ID não for passado, redirecionar com erro
    header("Location: listar.php?message=ID inválido.");
}
?>
