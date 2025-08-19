<?php
function calcularEquivalencia($salario, $vt, $vr, $saude, $contabilidade, $aliquotaSimples, $aliquotaINSSpj) {
    $decimo_terceiro = $salario / 12;
    $ferias = $salario / 12 + ($salario / 36); 
    $fgts = $salario * 0.08;
    $inss_empresa = $salario * 0.20;

    $custo_clt_extra = $decimo_terceiro + $ferias + $fgts + $inss_empresa;

    $beneficios = $vt + $vr + $saude;

    $custo_inss_pj = $salario * $aliquotaINSSpj / 100;
    $custo_contabilidade = $contabilidade;
    $custo_ir = $salario * ($aliquotaSimples / 100);

    $total_custos = $custo_clt_extra + $beneficios + $custo_inss_pj + $custo_contabilidade + $custo_ir;

    $salario_pj = $salario + $total_custos;

    return [
        "decimo_terceiro" => $decimo_terceiro,
        "ferias" => $ferias,
        "fgts" => $fgts,
        "inss_empresa" => $inss_empresa,
        "beneficios" => $beneficios,
        "inss_pj" => $custo_inss_pj,
        "contabilidade" => $custo_contabilidade,
        "ir" => $custo_ir,
        "total_custos" => $total_custos,
        "salario_pj" => $salario_pj
    ];
}

$resultado = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $salario = (float) $_POST["salario"];
    $vt = (float) $_POST["vt"];
    $vr = (float) $_POST["vr"];
    $saude = (float) $_POST["saude"];
    $contabilidade = (float) $_POST["contabilidade"];
    $aliquotaSimples = (float) $_POST["aliquotaSimples"];
    $aliquotaINSSpj = (float) $_POST["aliquotaINSSpj"];

    $resultado = calcularEquivalencia($salario, $vt, $vr, $saude, $contabilidade, $aliquotaSimples, $aliquotaINSSpj);
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Calculadora PJ vs CLT</title>
</head>
<body>
    <h2>Calculadora de Equivalência Salarial - PJ vs CLT</h2>
    <form method="post">
        <label>Salário Bruto CLT Desejado (R$):</label>
        <input type="number" step="0.01" name="salario" required><br><br>

        <label>Vale-Transporte (R$/mês):</label>
        <input type="number" step="0.01" name="vt" value="300"><br><br>

        <label>Vale-Refeição/Alimentação (R$/mês):</label>
        <input type="number" step="0.01" name="vr" value="800"><br><br>

        <label>Plano de Saúde (R$/mês):</label>
        <input type="number" step="0.01" name="saude" value="500"><br><br>

        <label>Taxa de Contabilidade (R$/mês):</label>
        <input type="number" step="0.01" name="contabilidade" value="400"><br><br>

        <label>Alíquota Simples Nacional (%):</label>
        <input type="number" step="0.01" name="aliquotaSimples" value="6"><br><br>

        <label>INSS PJ (%):</label>
        <input type="number" step="0.01" name="aliquotaINSSpj" value="11"><br><br>

        <button type="submit">Calcular</button>
    </form>

    <?php if ($resultado): ?>
        <h3>Resultado:</h3>
        <ul>
            <li>13º Salário (proporcional): R$ <?= number_format($resultado["decimo_terceiro"], 2, ',', '.') ?></li>
            <li>Férias + 1/3: R$ <?= number_format($resultado["ferias"], 2, ',', '.') ?></li>
            <li>FGTS (8%): R$ <?= number_format($resultado["fgts"], 2, ',', '.') ?></li>
            <li>INSS (parte empresa, 20%): R$ <?= number_format($resultado["inss_empresa"], 2, ',', '.') ?></li>
            <li>Benefícios (VT, VR, Saúde): R$ <?= number_format($resultado["beneficios"], 2, ',', '.') ?></li>
            <li>INSS PJ (<?= $_POST["aliquotaINSSpj"] ?>%): R$ <?= number_format($resultado["inss_pj"], 2, ',', '.') ?></li>
            <li>Contabilidade: R$ <?= number_format($resultado["contabilidade"], 2, ',', '.') ?></li>
            <li>Impostos PJ (<?= $_POST["aliquotaSimples"] ?>%): R$ <?= number_format($resultado["ir"], 2, ',', '.') ?></li>
        </ul>
        <h3>Total de custos adicionais: R$ <?= number_format($resultado["total_custos"], 2, ',', '.') ?></h3>
        <h2>Salário PJ Equivalente: <strong>R$ <?= number_format($resultado["salario_pj"], 2, ',', '.') ?></strong></h2>
    <?php endif; ?>
</body>
</html>