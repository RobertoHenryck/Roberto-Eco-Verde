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
            header('Location: PáginaInicial.php');
            exit;
        } else {
            $erro = "Senha incorreta!";
        }
    } else {
        $erro = "Usuário não encontrado!";
    }
}
?>

<!-- Formulário de login -->
<form method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="senha" placeholder="Senha" required>
    <button type="submit">Entrar</button>
</form>
<?php if (isset($erro)) echo $erro; ?>
