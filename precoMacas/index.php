<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $qtd = (int)$_POST["qtd"];
    if ($qtd < 12) {
        $preco = 0.30;
    } else {
        $preco = 0.25;
    }
    $total = $qtd * $preco;
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Compra de Maçãs</title>
</head>
<body>
    <h2>Compra de Maçãs</h2>
    <form method="post">
        <label>Quantidade de maçãs: </label>
        <input type="number" name="qtd" required>
        <button type="submit">Calcular</button>
    </form>
    <p>
        <?php if (isset($total)) echo "Valor total da compra: R$ " . number_format($total, 2, ',', '.'); ?>
    </p>
</body>
</html>