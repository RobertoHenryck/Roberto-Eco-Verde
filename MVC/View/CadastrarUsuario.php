<?php
session_start();
require_once 'C:\xampp\htdocs\ROBERTO-ECO-VERDE\config.php'; // Arquivo de conexão com o banco de dados

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $tipo = $_POST['tipo']; // Tipo de usuário: 'admin' ou 'usuario'

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

            // Redireciona para a página de login
            header('Location: login.php');
            exit;
        } else {
            $erro = "Erro ao cadastrar o usuário. Tente novamente!";
        }
    }
    
}

?>

<!-- Formulário de cadastro -->
<form method="POST">
    <h2>Cadastro de Usuário</h2>

    <label for="nome">Nome:</label>
    <input type="text" name="nome" id="nome" required>

    <label for="email">Email:</label>
    <input type="email" name="email" id="email" required>

    <label for="senha">Senha:</label>
    <input type="password" name="senha" id="senha" required>

    <label for="tipo">Tipo de Usuário:</label>
    <select name="tipo" id="tipo" required>
        <option value="usuario">Usuário Comum</option>
        <option value="admin">Administrador</option>
    </select>

    <button type="submit">Cadastrar</button>
</form>

<?php if (isset($erro)) echo "<p>$erro</p>"; ?>
