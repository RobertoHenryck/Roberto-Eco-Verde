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

    $resultado = $Controller->cadastrarfeedback($nome, $feedback, $email);

    if ($resultado) {
        // Verificando se o usuário é admin e redirecionando
        if ($_SESSION['usuario_tipo'] == 'admin') {
            header('Location: listarfeedback.php');
            exit;
        }
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
<style>
    @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Oswald:wght@200..700&display=swap');

    body {
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
        gap: 300px;
        align-items: center;
        width: 100%;
    }

    a:hover {
        color: #2d6a4f;
        transform: scale(1.1);
    }

    a,
    h3 {
        text-decoration: none;
        font-size: 30px;
        color: white;
        padding: 20px;
    }

    form {
        margin-top: 100px;
        display: flex;
        justify-content: center;
        flex-direction: column;
        width: 800px;
        margin: 0 auto;
        gap: 20px;
        padding: 20px;

    }

    label {
        font-size: 25px;
        display: flex;
    }

    textarea {
        height: 150px;
        width: 700px;


    }

    h1 {
        display: flex;
        justify-content: center;
        font-size: 40px;
    }

    input {
        width: 700px;
        height: 50px;
        display: flex;

    }

    .conteudo {
        background-color: #e9ecef;
        width: 800px;
        margin: 30px auto;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 20px;
        box-shadow: 1px 1px solid black;

    }

    footer {

        width: 100%;
        display: flex;
        justify-content: space-around;
        background-color: #1b4332;
        align-items: center;
        gap: 200px;

    }

    button {
        width: 250px;
        height: 50px;
        display: flex;
        margin: 0 auto;
        justify-content: center;
        font-size: 30px;
        align-items: center;
        border: none;
        background-color: #ced4da;
        border-radius: 10px;

    }

    @media screen and (max-width: 600px) {
        .navbar {
            flex-direction: column;
            gap: 20px;
            padding: 10px;
            height: auto;
            align-items: center;
        }

        .navbar h3 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .nav2 a {
            font-size: 18px;
            padding: 10px;
            width: 100%;
            text-align: center;
        }

        h1 {
            font-size: 30px;
        }

        .conteudo {
            width: 90%;
            padding: 15px;
        }

        form {
            width: 100%;
            gap: 15px;
        }

        label {
            font-size: 18px;
        }

        input,
        textarea {
            width: 100%;
            font-size: 16px;
            padding: 10px;
        }

        button {
            font-size: 20px;
            width: 100%;
        }

        footer {
            flex-direction: column;
            align-items: center;
            gap: 15px;
            padding: 15px;
        }

        footer .feedback a {
            font-size: 16px;
            padding: 10px;
        }

        .imagem img {
            max-width: 120px;
        }
    }
</style>

<body>
    <div class="navbar">
        <?php if (isset($_SESSION['usuario_tipo'])) {
            echo "<h3>Bem vindo(a)! $_SESSION[usuario_tipo] " . $_SESSION['usuario_nome'] . '!</h3>';
        }
        ?>

        <div class="nav2">
            <a href="CadastrarConsumo.php">Cadastrar Consumo</a>
            <a href="listar.php">Meu Consumo</a>

            <?php if (isset($_SESSION['usuario_id'])): ?>
                <a href="?logout=true">Sair</a>
            <?php endif; ?>
        </div>
    </div>

    <h1>Envie seu feedback❗</h1>
    <div class="conteudo">
        <form method="POST">

            <label for="nome">Seu nome</label>
            <input type="text" name="nome" required>

            <label for="feedback">Feedback</label>
            <textarea type="text" name="feedback" required></textarea>

            <label for="email">Email</label>
            <input type="email" name="email" required>

            <button type="submit">Enviar</button>

        </form>
    </div>
    <footer>


        <div class="texto">
            <h3>ROBERTO ÉCO VERDE - ©Todos os direitos reservados</h3>
        </div>
        <div class="feedback">
            <?php if ($_SESSION['usuario_tipo'] == 'admin') { ?>
                <a href="listarfeedback.php">Ver feedbacks</a>
        </div>
    <?php } ?>
    <div cl+ass="imagem">
        <img src="../../IMG/LOGO ROBERTO ÉCO VERDE.png" alt="">
    </div>

    </footer>

</body>

</html>