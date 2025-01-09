<?php
include 'includes/db.php';

session_start();

// Exibir mensagens de erro
if (!empty($_SESSION['errors'])) {
    echo "<div style='color: red; margin-bottom: 10px;'>";
    foreach ($_SESSION['errors'] as $error) {
        echo "<p>$error</p>";
    }
    echo "</div>";
    unset($_SESSION['errors']);
}

// Exibir mensagem de sucesso
if (!empty($_SESSION['success'])) {
    echo "<div class='success-message'>";
    echo "<p>{$_SESSION['success']}</p>";
    echo "</div>";
    unset($_SESSION['success']);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="css/cadastro/style.css">
    
    <script>
        function voltarPagina(event) {
            event.preventDefault(); // Previne o envio do formulário
            window.location.href = 'index.php'; // Redireciona para a página desejada
        }

        document.addEventListener('DOMContentLoaded', function () {
            const modal = document.getElementById('messageModal');
            const modalMessage = document.getElementById('modalMessage');
            const closeButton = document.querySelector('.close');

            // Verifica se há mensagem de modal
            <?php if (!empty($_SESSION['modal_message'])): ?>
                modalMessage.textContent = "<?php echo $_SESSION['modal_message']; ?>";
                modal.style.display = "block";
                <?php unset($_SESSION['modal_message']); ?>
            <?php endif; ?>

            // Fechar o modal ao clicar no botão "x"
            closeButton.addEventListener('click', () => {
                modal.style.display = "none";
            });

            // Fechar o modal ao clicar fora dele
            window.addEventListener('click', (event) => {
                if (event.target === modal) {
                    modal.style.display = "none";
                }
            });
        });
    </script>
</head>
<body>
    <form action="processar_cadastro.php" method="POST">
        <h1>Cadastro de Usuário</h1>

        <div class="form-group">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
        </div>

        <div class="form-group">
            <label for="email">E-mail:</label>
            <input type="email" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" id="senha" name="senha" required>
        </div>

        <button type="submit" class="btn-submit">Cadastrar</button>
        <!-- Alterado o tipo do botão para button para não enviar o formulário -->
        <button type="button" onclick="voltarPagina(event)" class="btn btn-secondary">Voltar</button>
    </form>

    <!-- Modal de Mensagem -->
    <div id="messageModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <p id="modalMessage"></p>
        </div>
    </div>
</body>
</html>
