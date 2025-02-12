<?php
session_start();
require_once 'C:\Turma2\xampp\htdocs\ROBERTO-ECO-VERDE\config.php'; // arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo']; // Tipo de usuário

    if (isset($_GET['logout'])) {
        session_unset();
        session_destroy();
        header('Location: index.php');
        exit;
    }

    // Verificar se o email já está cadastrado
    $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $erro = "Este email já está cadastrado!";
    } else {
        // Criptografar a senha
        $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);

        // Inserir o novo usuário no banco de dados
        $sql = "INSERT INTO usuarios (nome, email, senha, tipo) VALUES (:nome, :email, :senha, :tipo)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha_criptografada);
        $stmt->bindParam(':tipo', $tipo);

        if ($stmt->execute()) {
            $_SESSION['usuario_nome'] = $nome;
            $_SESSION['usuario_email'] = $email;
            $_SESSION['usuario_tipo'] = $tipo;

            // Redireciona para a página inicial
            header('Location: index.php');
            exit;
        } else {
            $erro = "Erro ao cadastrar o usuário. Tente novamente!";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Oswald:wght@200..700&display=swap');
        
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 100px;
            font-family: 'Josefin Sans';
            background-color: #081c15;
            overflow: hidden;
        }
        .conteudo{
            display: flex;  
        }

        input, button, select {
            padding: 10px;
            font-size: 16px;
            width: 200px;
            display: flex;
            flex-direction: column;
        }
        .inputs {
            background-color: #1b4332;
            display: flex;
            width: 600px;
            height: 600px;
            justify-content: center;
            align-items: center;
            margin: 100px;
            border-radius: 10px;
            box-shadow: 0 0 10px black;
        }
        option{
            color: #1b4332;
        }
        input,select {
            width: 550px;
            background-color: #2d6a4f;
            color: black;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        img {
            width: 600px;
            height: 300px;
        }
        h2 {
            color: #40916c;
            width: 800px;
            font-size: 50px;
            display: flex;
        }

        h1 {
            display: flex;
            justify-content: center;
            font-size: 30px;
            color: #40916c;
        }
        
        .botao {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            text-align: center; 
        }

        button {
            display: flex;
            align-items: center;    
            width: 400px;
            font-family: 'Josefin Sans';
            background-color: #40916c;
            color: #1b4332;
            font-size: 20px;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        button:hover {
            background-color: #2d6a4f;
            color: black;
        }

        p {
            display: flex;
            justify-content: start;
            font-size: 20px;
            color: #40916c;
        }

        a {
            color: black;
            text-decoration: none;
            display: flex;
            text-align: center;
            justify-content: center;
            margin-top: 30px;
            font-size: 20px;
            color: #40916c;
        }

        .logo {
            width: 700px;
            margin: 50px;
        }

        @media screen and (max-width: 1800px) {
    body {
         margin-top: -50px;
    }

    .conteudo {
        display:flex;
        
        
    }

    .logo {
        width: 100%; 
        margin: 80px;
    }

    img {
        width: 500px; 
        height: auto;
    }

    .inputs, select{
        width:450px;
        align-items: center;
        height: auto;
        padding:20px;
    }

    input {
        width: 90%;
    }

    button {
        width: 90%; 
    }

    h2 {
        font-size: 50px;
        width: auto;
    }

    h1 {
        font-size: 30px; 
    }

    p, a {
        font-size: 18px; 
    }
}


    </style>
</head>

<body>

<div class="conteudo">
    <div class="logo">
        <h2>Faça login no nosso site para acessar o conteúdo exclusivo!</h2>
        <img src="../../IMG/LOGO ROBERTO ÉCO VERDE.png" alt="Logo">
    </div>
  
    <div class="inputs">
        <form method="POST">
            <h1>Cadastro de Usuário</h1>

            <p>Nome</p>
            <input type="text" name="nome" placeholder="Nome completo" required>

            <p>Email</p>
            <input type="email" name="email" placeholder="Email" required>

            <p>Senha</p>
            <input type="password" name="senha" placeholder="Senha" required>

            <p>Tipo de Usuário</p>
            <select name="tipo" required>
                <option value="usuario">Usuário Comum</option>
            </select>

            <div class="botao">
                <button type="submit">Cadastrar</button>
            </div>

            <div class="botoes">
                <a href="index.php">Já tem uma conta? Faça login!</a>
            </div>
        </form>
    </div>
</div>

<?php if (isset($erro)) echo "<p>$erro</p>"; ?>

</body>
</html>
