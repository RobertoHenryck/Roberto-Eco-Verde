<?php
session_start();
require_once 'C:\xampp\htdocs\ROBERTO-ECO-VERDE\config.php'; // arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta para verificar o usuário
    $sql = "SELECT * FROM usuarios WHERE email = :email LIMIT 1";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verificar se a senha está correta
        if (password_verify($senha, $usuario['senha'])) {
            // Criar sessão
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_tipo'] = $usuario['tipo']; // 'admin' ou 'usuario'

            // Redirecionar para a página inicial
            header('Location:PáginaInicial.php');
            exit;
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Usuário não encontrado!";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Oswald:wght@200..700&display=swap');
        
        body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            margin: 180px;
            font-family: 'Josefin Sans';
            background-color: #081c15;
        }
        .conteudo{
            display: flex;  
        }

        input, button {
            padding: 10px;
            font-size: 16px;
            width: 200px;
            display:flex;
            flex-direction: column;
        }
        .inputs{
            background-color: #1b4332;
            display: flex;
            width:600px;
            height: 400px;
            justify-content: center;
            align-items: center;
            margin:100px;
            border-radius: 10px;
            box-shadow: 0 0 10px black;
        }
        input{
            width: 550px;
            background-color:#2d6a4f;
            color:black;
            border:none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        
        img{
            width: 600px;
            height:300px;
        }
        h2{
            color:#40916c;
            width: 800px;
            font-size:50px;
            display:flex;
        }
        h2::first-letter{
            font-size:50px;
        }
        h1{
            display:flex;
            justify-content: center;
            font-size: 30px;
            color:#40916c;
        }
        
        .botao{
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
.botoes{
    display:flex;
    justify-content: center;    
    width: 400px;
    margin:0 auto;
}


        p{
            display: flex;  
            justify-content: start;
            font-size: 20px;
            color:#40916c;
        }
        a{
            color: black;
            text-decoration: none;
            display: flex;
            text-align: center;
            justify-content: center;
            margin-top:30px;
            font-size: 20px;
            color:#40916c;
        }


        .logo{
            width:700px;
            margin: 50px;
        }
    </style>
    <script>
       
        window.onload = function() {
            alert("Para continuar, faça login em sua conta ou cadastre-se para acessar todas as funcionalidades.!");
        }
    </script>
</head>
<body>
    
<div class="conteudo">
    <div class="logo">
              <h2>
        Faça login no nosso site para acessar o conteúdo exclusivo!
    </h2>
            <img src="../../IMG/LOGO ROBERTO ÉCO VERDE.png" alt="Logo">
        </div>
  
        <div class="inputs">
        <form method="POST">
 <h1>LOGIN</h1>
 <p>E-mail</p>
            <input type="email" name="email" placeholder="Email" required>
            <p>Senha</p>
            <input type="password" name="senha" placeholder="Senha" required>
            <div class="botao">
            <button type="submit">Entrar</button>
        </div>
      <div class="botoes">
    <p><a href="CadastrarUsuario.php">Não tem uma conta? Cadastre-se aqui</a></p>
</div>
       
        </form>
 </div>

  </div>
        </div>
  

    <?php if (isset($erro)) echo $erro; ?>
</body>
</html>
