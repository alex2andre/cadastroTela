<?php
include 'includes/db.php';

// Receber os dados do formulário
$nome = trim($_POST['nome']);
$email = trim($_POST['email']);
$senha = $_POST['senha'];

$errors = [];

// Validação de Nome
if (empty($nome)) {
    $errors[] = "O nome é obrigatório.";
}

// Validação de E-mail
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "O e-mail fornecido não é válido.";
} else {
    // Verificar se o e-mail já está cadastrado
    $stmt = $db->prepare("SELECT COUNT(*) FROM usuarios WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->fetchColumn() > 0) {
        $errors[] = "O e-mail já está cadastrado.";
    }
}

// Validação de Senha
if (strlen($senha) < 6) {
    $errors[] = "A senha deve ter pelo menos 6 caracteres.";
}

// Verificar se há erros
if (!empty($errors)) {
    // Salvar os erros na sessão para exibir no formulário
    session_start();
    $_SESSION['errors'] = $errors;

    // Redirecionar de volta ao formulário de cadastro
    header("Location: cadastro.php");
    exit();
}

// Inserir no banco de dados
$senhaHash = password_hash($senha, PASSWORD_DEFAULT); // Hashear a senha
$stmt = $db->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
if ($stmt->execute([$nome, $email, $senhaHash])) {
    // Mensagem de sucesso
    session_start();
    $_SESSION['success'] = "Usuário cadastrado com sucesso!";
    header("Location: cadastro.php");
    exit();
} else {
    // Mensagem de erro geral
    session_start();
    $_SESSION['errors'] = ["Erro ao cadastrar o usuário. Tente novamente mais tarde."];
    header("Location: cadastro.php");
    exit();
}
