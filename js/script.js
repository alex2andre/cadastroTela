
document.querySelector('form').addEventListener('submit', function (event) {
    const nome = document.getElementById('nome').value.trim();
    const email = document.getElementById('email').value.trim();
    const senha = document.getElementById('senha').value;

    let errors = [];

    // Validação de Nome
    if (nome === "") {
        errors.push("O nome é obrigatório.");
    }

    // Validação de E-mail
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        errors.push("O e-mail fornecido não é válido.");
    }

    // Validação de Senha
    if (senha.length < 6) {
        errors.push("A senha deve ter pelo menos 6 caracteres.");
    }

    // Exibir erros
    if (errors.length > 0) {
        event.preventDefault(); // Impede o envio do formulário
        alert(errors.join("\n"));
    }
});



