<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $senha = $_POST["senha"];
    if ($senha == "1234") {
        $mensagem = "ACESSO PERMITIDO";
    } else {
        $mensagem = "ACESSO NEGADO";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Verificação de Senha</title>
</head>
<body>
    <h2>Verificação de Senha</h2>
    <form method="post">
        <label>Digite a senha: </label>
        <input type="password" name="senha" required>
        <button type="submit">Enviar</button>
    </form>
    <p><?php if (!empty($mensagem)) echo $mensagem; ?></p>
</body>
</html>