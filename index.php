<?php
include 'includes/db.php';

$usuarios = $db->query("SELECT * FROM usuarios")->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Usuários</title>
    <link rel="stylesheet" href="css/index/style.css">
</head>
<body>
    <div class="container">
        <h1>Usuários Cadastrados</h1>
        <div class="actions">
            <a href="cadastro.php" class="btn btn-primary">+ Novo Usuário</a>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario['nome']) ?></td>
                        <td><?= htmlspecialchars($usuario['email']) ?></td>
                        <td>
                            <a href="editar.php?id=<?= $usuario['id'] ?>" class="btn btn-edit">Editar</a>
                            <a href="excluir.php?id=<?= $usuario['id'] ?>" class="btn btn-delete" onclick="return confirm('Deseja excluir este usuário?')">Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
