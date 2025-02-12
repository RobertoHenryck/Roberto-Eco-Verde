<?php

require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\config.php';
require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\MVC\Controller\Controller.php';

session_start();

$Controller = new Controller($pdo);

$Consumos = $Controller->listarConsumo($_SESSION['usuario_id']);

if (
    isset($_POST['update_consumo_de_estacao']) &&
    isset($_POST['update_consumo_do_servidor']) &&
    isset($_POST['update_consumo_de_iluminacao']) &&
    isset($_POST['update_consumo_de_climatizacao']) &&
    isset($_POST['update_consumo_de_equipamentos'])
) {

    $Controller->editarConsumo(
        $_POST['update_consumo_de_estacao'],
        $_POST['update_consumo_do_servidor'],
        $_POST['update_consumo_de_iluminacao'],
        $_POST['update_consumo_de_climatizacao'],
        $_POST['update_consumo_de_equipamentos'],
        $_SESSION['usuario_id']
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
<style>
@import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Oswald:wght@200..700&display=swap');

body {
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
   margin:0;
    font-family: 'Josefin Sans';
    background-color: #fff;
    overflow: hidden;
}

.titulo{
    font-size: 20px;
}
.conteudo{
    display: flex;
    flex-direction: column;
    padding: 20px;
    width: 200px;
    height:10px;
}
input{
    height: 30px;
    margin-top: -10px;
}
.container{
    background-color:  #2d6a4f;
    width: 400px;
    border-radius: 10px;
    height: 510px;
}
label{
    color: white;
    font-size: 30px;
}
p{
    color: white;
    display: flex;
    justify-content: start;
    
}





    
</style>

<body>
    <center>
        <form action="#" method="POST">
            <div class="titulo">
            <h1>Editar Consumo</h1>
        </div>
            <div>
                <div class="container">
<div class="conteudo">
                <label for="id">Selecione o ID</label>
                <br>
                <select name="id">
                    <?php foreach ($Consumos as $Consumo): ?>
                        <option value="<?= $Consumo['id']; ?>"><?= "$Consumo[id] - $Consumo[consumo_de_estacao]"; ?></option>
                    <?php endforeach; ?>
                </select>

                <br>
                <p for="">Consumo de Estação</p>
                <input type="text" name="update_consumo_de_estacao" placeholder="Consumo de Estação">
                <br>
                <p for="">Consumo do servidor</p>
                <input type="text" name="update_consumo_do_servidor" placeholder="Consumo do Servidor">
                <br>
                <p for="">Consumo de Iluminação</p>
                <input type="text" name="update_consumo_de_iluminacao" placeholder="Consumo de Iluminação">
                <br>
                <p for="">Consumo de Climatização</p>
                <input type="text" name="update_consumo_de_climatizacao" placeholder="Consumo de Climatização">
                <br>
                <p for="">Consumo de Equipamentos</p>
                <input type="text" name="update_consumo_de_equipamentos" placeholder="Consumo de Equipamentos">
                <br>
               
        
                <button type="submit">Editar</button>
                <br>
                <a href="/MVC/listar.php">Voltar</a>
            </div>
        </div>
        </form>
    </div>
    </center>
</body>

</html> 