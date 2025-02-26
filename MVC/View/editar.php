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
$id_registro = $_GET['id'];

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
        $id_registro
    );

    header("Location: listar.php");
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
        margin: 0;
        font-family: 'Josefin Sans';
        background-color: #fff;

    }

    .navbar {
                position: sticky;
                z-index: 1000;
                top: 0;
                display: flex;
                justify-content: space-around;
                background-color: #1b4332;
                height: 150px;
                gap: 600px;
                align-items: center;
                width: 100%;
            }


    a:hover {
        color: #2d6a4f;
        transform: scale(1.1);
    }

    .titulo {
        font-size: 20px;
    }

    .conteudo {
        display: flex;
        flex-direction: column;
        padding: 10px;
        width: 300px;
        height: 600px;
    }

    input,
    select {
        height: 70px;
        background-color: white;
        border: none;
        margin-top: -15px;
        color: black;
        border-radius: 5px;

    }

    .container {
        background-color: #1b4332;
        width: 400px;
        border-radius: 10px;
        height: 610px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 1);
    }

    label {
        color: white;
        font-size: 30px;
        padding: 10px;


    }

    p {
        color: white;
        display: flex;
        justify-content: start;
        font-size: 20px;
        width: 300px;

    }

    a,
    h3 {

        text-decoration: none;
        font-size: 30px;
        color: white;
        padding: 20px;
    }

    .voltar {
        color: black;
        padding: 10px;
    }

    button {
        margin-top: 20px;
        font-size: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
        border-radius: 10px;
        color: black;
        transition: background-color 0.3s ease, color 0.3s ease;


    }

    button:hover {
        background-color: rgb(162, 162, 162);
        color: black;
    }
</style>

<body>

    <div class="navbar">
        <?php if (isset($_SESSION['usuario_tipo'])) {
            echo "<h3>Bem vindo(a)! $_SESSION[usuario_tipo] " . $_SESSION['usuario_nome'] . '!</h3>';
        }
        ?>

        <div class="nav2">
            <a href="listar.php">Meu Consumo</a>
            <a href="PáginaInicial.php">Página Inicial</a>

            <?php if (isset($_SESSION['usuario_id'])): ?>
                <a href="?logout=true">Sair</a>
            <?php endif; ?>
        </div>
    </div>
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
                        <div class="voltar"><a href="deletar.php?id=<?php echo htmlspecialchars($Consumo['id']); ?>" onclick="return confirm('Tem certeza que deseja cancelar?')">Cancelar</a></div>
                    </div>
                </div>
        </form>
        </div>
    </center>
</body>

</html>