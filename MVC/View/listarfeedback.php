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
$Feedbacks = $Controller->listarFeedback($_SESSION['usuario_id']);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Feedback</title>
</head>

<body>
    <div class="navbar">
        <?php if (isset($_SESSION['usuario_tipo'])): ?>
            <h3>Bem-vindo(a), <?php echo htmlspecialchars($_SESSION['usuario_nome']); ?>!</h3>
        <?php endif; ?>

        <div class="nav2">
            <a href="CadastrarFeedback.php">Registrar Feedback</a>
            <a href="PáginaInicial.php">Página Inicial</a>

            <?php if (isset($_SESSION['usuario_id'])): ?>
                <a href="?logout=true">Sair</a>
            <?php endif; ?>
        </div>
    </div>

    <h1>Lista de Feedbacks Registrados</h1>
    <div class="tabela">
        <div>
            <?php if (!empty($Feedbacks)): ?>
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Feedback</th>
                            <th>Email</th>
                            <?php if ($_SESSION['usuario_tipo'] == 'admin') { ?>
                                <th>Editar</th>
                                <th>Deletar</th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($Feedbacks as $Feedback): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($Feedback['id']); ?></td>
                                <td><?php echo htmlspecialchars($Feedback['nome']); ?></td>
                                <td><?php echo htmlspecialchars($Feedback['feedback']); ?></td>
                                <td><?php echo htmlspecialchars($Feedback['email']); ?></td>
                                <?php if ($_SESSION['usuario_tipo'] == 'admin') { ?>
                                    <td>
                                        <a href='editar.php?id=<?php echo htmlspecialchars($Feedback['id']); ?>'>✏️</a>
                                    </td>
                                    <td>
                                        <a href="deletar.php?id=<?php echo htmlspecialchars($Feedback['id']); ?>" onclick="return confirm('Tem certeza que deseja deletar este feedback?')">❌</a>
                                    </td>
                                <?php } ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div class="botoes">
                    <a href="CadastrarFeedback.php">Cadastrar Feedback</a>
                </div>
            <?php else: ?>
                <p>Nenhum feedback registrado</p>
            <?php endif; ?>
        </div>
    </div>

    <footer>
        <h3>ROBERTO ÉCO VERDE - ©Todos os direitos reservados</h3>
        <img src="../../IMG/LOGO ROBERTO ÉCO VERDE.png" alt="">
    </footer>

</body>

</html>
