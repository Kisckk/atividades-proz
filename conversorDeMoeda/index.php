<?php
$moedas = [
    "Dólar" => 5.45,
    "Euro" => 6.32,
    "Libra" => 7.35,
    "Iene" => 0.038
];

$resultado = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $valor = (float) $_POST["valor"];
    $moeda = $_POST["moeda"];
    $taxa = $moedas[$moeda];
    $convertido = $valor / $taxa;
    $resultado = "R$ " . number_format($valor, 2, ',', '.') . " equivalem a " . number_format($convertido, 2, ',', '.') . " em $moeda";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Conversão de Moeda</title>
</head>
<body>
    <h2>Conversor de Moeda</h2>
    <form method="post">
        <label>Valor em Reais (R$):</label>
        <input type="number" step="0.01" name="valor" required><br><br>

        <label>Converter para:</label>
        <select name="moeda">
            <?php foreach ($moedas as $nome => $taxa): ?>
                <option value="<?= $nome ?>"><?= $nome ?> (1 <?= $nome ?> = R$ <?= number_format($taxa, 2, ',', '.') ?>)</option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Converter</button>
    </form>

    <?php if ($resultado): ?>
        <h3><?= $resultado ?></h3>
    <?php endif; ?>
</body>
</html>