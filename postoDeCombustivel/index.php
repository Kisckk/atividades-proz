<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $litros = (float)$_POST["litros"];
    $tipo = strtoupper($_POST["tipo"]);

    if ($tipo == "A") { // Álcool
        $preco = 1.90;
        $desconto = ($litros <= 20) ? 0.03 : 0.05;
    } elseif ($tipo == "G") { // Gasolina
        $preco = 2.50;
        $desconto = ($litros <= 20) ? 0.04 : 0.06;
    } else {
        $mensagem = "Tipo de combustível inválido.";
    }

    if (!isset($mensagem)) {
        $valor_sem_desc = $litros * $preco;
        $valor_com_desc = $valor_sem_desc * (1 - $desconto);
        $mensagem = "Valor a ser pago: R$ " . number_format($valor_com_desc, 2, ',', '.');
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Posto de Combustível</title>
</head>
<body>
    <h2>Posto de Combustível</h2>
    <form method="post">
        <label>Litros vendidos: </label>
        <input type="number" step="0.01" name="litros" required>
        <br><br>
        <label>Tipo de combustível:</label>
        <select name="tipo" required>
            <option value="A">Álcool</option>
            <option value="G">Gasolina</option>
        </select>
        <br><br>
        <button type="submit">Calcular</button>
    </form>
    <p><?php if (!empty($mensagem)) echo $mensagem; ?></p>
</body>
</html>