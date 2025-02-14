<?php
require_once  'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\config.php';
require_once  'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\MVC\Controller\Controller.php';

session_start();

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}
$Controller = new Controller($pdo);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $consumo_de_estacao = $_POST['consumo_de_estacao'];
    $consumo_do_servidor = $_POST['consumo_do_servidor'];
    $consumo_de_iluminacao = $_POST['consumo_de_iluminacao'];
    $consumo_de_climatizacao = $_POST['consumo_de_climatizacao'];
    $consumo_de_equipamentos = $_POST['consumo_de_equipamentos'];
    $id_usuario = $_SESSION['usuario_id']; // Obtendo o ID do usuário

    $resultado = $Controller->cadastrarConsumo(
        $consumo_de_estacao,
        $consumo_do_servidor,
        $consumo_de_iluminacao,
        $consumo_de_climatizacao,
        $consumo_de_equipamentos,
        $id_usuario
    );


    if ($resultado) {
        header('Location: listar.php');
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
    <title>Cadastrar Consumo</title>
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
            overflow: hidden;
        }

        .navbar {
                position: sticky;
                z-index: 1000;
                top: 0;
                display: flex;
                justify-content: space-around;
                background-color: #1b4332;
                height: 150px;
                gap: 550px;
                align-items: center;
                width: 100%;
            }
            a:hover {
            color: #2d6a4f;
            transform: scale(1.1);
        }
        .titulo {

            color: white;
            font-size: 30px;
            margin-top: 30px;
            color: #081c15;

        }

        .conteudo {
            background-color: #1b4332;
            width: 1000px;
            height: 400px;
            display: flex;
            align-items: center;
            justify-content: space-around;
            border-radius: 40px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 1);


        }

        form {
            display: flex;
            justify-content: space-between;
            gap: 90px;
            padding: 30px;
            margin-top: 30px;

        }

        .inputs1 {
            display: flex;
            flex-direction: column;
            gap: 20px;

        }

        a,
        h3 {
            text-decoration: none;
            font-size: 30px;
            color: white;
            padding: 20px;
        }

        .inputs2 {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: -57px;
            padding: 20px;
        }


        label {
            color: white;
            font-size: 25px;
            margin: 20px;


        }

        button {
            font-size: 30px;
            height: 40px;
            border-radius: 10px;
            color: black;
            border: none;
            background-color: white;
            transition: background-color 0.3s ease, color 0.3s ease;


        }

        button:hover {
            background-color: #2d6a4f;
            color: black;
        }

        input {
            border-radius: 10   px;
            height: 30px;
            
        }
    </style>
</head>

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
        <div class="titulo">
            <h1>Cadastrar Consumo🌱</h1>
        </div>
        <div class="conteudo">
            <form method="POST" action="#">



                <div class="inputs1">
                    <div>
                        <label for="consumo_de_estacao">Consumo da Estação</label>
                        <br>
                        <br>
                        <input type="text" name="consumo_de_estacao" required />
                        <br>
                        <br>
                    </div>
                    <div>
                        <label for="consumo_do_servidor">Consumo do Servidor</label>
                        <br>
                        <br>
                        <input type="text" name="consumo_do_servidor" required />
                        <br>
                        <br>
                    </div>
                    <div>
                        <label for="consumo_de_iluminacao">Consumo de Iluminação</label>
                        <br>
                        <br>
                        <input type="text" name="consumo_de_iluminacao" required />
                        <br>
                        <br>
                    </div>
                </div>
                <br>



                <div class="inputs2">

                    <br>
                    <div>
                        <label for="consumo_de_climatizacao">Consumo de Climatização</label>
                        <br>
                        <br>
                        <input type="text" name="consumo_de_climatizacao" required />
                        <br>
                        <br>
                    </div>
                    <div>
                        <label for="consumo_de_equipamentos">Consumo de Equipamentos</label>
                        <br>
                        <br>
                        <input type="text" name="consumo_de_equipamentos" required />
                        <br>
                        <br>
                    </div>
                    <div class="botaoVoltar">
                        <button type="submit">Cadastrar Consumo</button>
                    </div>
                </div>
            </form>
        </div>
        <br>

        <a href="PáginaInicial.php">Voltar </a>
    </center>
</body>

</html>