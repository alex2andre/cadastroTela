<?php
include 'includes/db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $usuario = $db->query("SELECT * FROM usuarios WHERE id = $id")->fetch();

    // Verifica se o usuário foi encontrado
    if (!$usuario) {
        echo "Usuário não encontrado.";
        exit;
    }

    // Verifica se o formulário foi enviado
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $nome = $_POST['nome'];
        $email = $_POST['email'];

        try {
            $stmt = $db->prepare("UPDATE usuarios SET nome = ?, email = ? WHERE id = ?");
            $stmt->execute([$nome, $email, $id]);
            header('Location: index.php');
            exit;
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="css/Editar/style.css"> <!-- Link para o CSS -->
    <script>
        function voltarPagina(event) {
            event.preventDefault(); // Previne o envio do formulário
            window.location.href = 'index.php'; // Redireciona para a página desejada
        }
    </script>

</head>
<body>
    <!-- Container principal da página -->
    <div class="container">
        <!-- Centraliza o conteúdo em coluna -->
        <div class="content">
            <h1>Editar Usuário</h1>
            

            <form method="POST" class="form-editar">
                <div>
                    <label for="nome">Nome:</label>
                    <input type="text" id="nome" name="nome" value="<?= htmlspecialchars($usuario['nome']); ?>" required>
                </div>

                <div>
                    <label for="email">E-mail:</label>
                    <input type="email" id="email" name="email" value="<?= htmlspecialchars($usuario['email']); ?>" required>
                </div>

                <div>
                    <button type="submit">Salvar Alterações</button>
                    <button type="button" onclick="voltarPagina(event)" class="btn btn-secondary">Voltar</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
