<?php

require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\config.php';
require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\MVC\Controller\Controller.php';

session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: index.php");
    exit;
}

if (!isset($_SESSION['usuario_id']) || $_SESSION['usuario_tipo'] != 'admin') {
   
    header("Location: .listar.php?message=Você não tem permissão para realizar essa ação.");
    exit;
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $Controller = new Controller($pdo);
    $result = $Controller->deletarConsumo($id);

    if ($result) {
        
        header("Location: listar.php?message=Consumo deletado com sucesso!");
    } else {
      
        header("Location: listar.php?message=Falha ao deletar o consumo.");
    }
} else {
    
    header("Location: listar.php?message=ID inválido.");
}
?>
