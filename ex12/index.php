<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Atividade de Aprendizagem de Máquina</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
      body { font-family: Arial, sans-serif; padding:20px; }
      canvas { max-width:600px; margin:20px auto; display:block; }
    </style>
  </head>
  <body>
    <h1>Questionário</h1>
    <article>
      <ol>
        <li>
          <strong>Explique com suas palavras qual a diferença entre, aprendizagem por
          reforço, aprendizado supervisionada e não supervisionado.</strong>
        </li>
        <ul>
          <div>
            <li><strong>Aprendizagem por Reforço</strong></li>
            <label>É uma forma de ensinar a máquina em que ela aprende interagindo com
            o ambiente, recebendo feedbacks. Muito usado para definir
            algoritmos.</label>
            <li><strong>Aprendizado Supervisionado</strong></li>
            <label>No aprendizado supervisionado, a máquina aprende com exemplos que
            já têm a resposta certa.</label>
            <li><strong>Aprendizado não Supervisionado</strong></li>
            <label>No aprendizado não supervisionado, não existe professor nem
            resposta pronta. A máquina recebe vários dados e precisa encontrar
            sozinha padrões e semelhanças.</label>
          </div>
        </ul>

        <li><strong>No aprendizado supervisionado o que é um rótulo?</strong></li>
        <div>
          No aprendizado supervisionado, um rótulo é simplesmente a resposta
          correta que acompanha cada exemplo nos dados de treino.
        </div>

        <li><strong>O que é um modelo em ML?</strong></li>
        <div>
          Em Machine Learning, um modelo é a representação matemática que a
          máquina constrói para conseguir aprender com os dados e fazer previsões
          ou tomar decisões.
        </div>

        <li><strong>O que são hiperparâmetros?</strong></li>
        <div>
          Hiperparâmetros são valores definidos antes do treino de um modelo de
          Machine Learning e controlam como o modelo aprende.
        </div>

        <li>
          <strong>Explique a técnica de regressão linear. Onde ele pode ser aplicado?
          Desenvolva uma aplicação que envolva ele.</strong>
        </li>
        <div>
          É uma técnica de aprendizado supervisionado usada para prever um valor
          numérico (variável contínua) a partir de uma ou mais variáveis de
          entrada. Ela tenta ajustar uma reta (ou hiperplano em várias dimensões)
          que melhor descreve a relação entre as variáveis.
        </div>

        <?php

        $horas = [1, 2, 3, 4, 5, 6];
        $notas = [52, 55, 60, 63, 68, 72];

        function media($arr) {
            return array_sum($arr) / count($arr);
        }

        $mediaX = media($horas);
        $mediaY = media($notas);

        $num = 0; $den = 0;
        for ($i = 0; $i < count($horas); $i++) {
            $num += ($horas[$i] - $mediaX) * ($notas[$i] - $mediaY);
            $den += pow($horas[$i] - $mediaX, 2);
        }

        $a = $num / $den;
        $b = $mediaY - $a * $mediaX;

        $prev7 = $a * 7 + $b;
        ?>

        <div style="margin-top:20px;">
          <p><b>Equação da reta:</b> y = <?= round($a,2) ?>x + <?= round($b,2) ?></p>
          <p>Se estudar <b>7 horas</b>, a previsão é <b><?= round($prev7,1) ?></b> pontos.</p>
          <canvas id="grafico"></canvas>
        </div>

        <script>
          const ctx = document.getElementById('grafico');

          const horas = <?= json_encode($horas) ?>;
          const notas = <?= json_encode($notas) ?>;

          const retaX = [0, 7];
          const retaY = retaX.map(x => <?= $a ?> * x + <?= $b ?>);

          new Chart(ctx, {
              type: 'scatter',
              data: {
                  datasets: [
                      {
                          label: 'Dados reais',
                          data: horas.map((h, i) => ({x: h, y: notas[i]})),
                          backgroundColor: 'blue'
                      },
                      {
                          label: 'Reta de regressão',
                          type: 'line',
                          data: retaX.map((x, i) => ({x: x, y: retaY[i]})),
                          borderColor: 'red',
                          fill: false
                      }
                  ]
              },
              options: {
                  scales: {
                      x: { title: { display: true, text: 'Horas de Estudo' } },
                      y: { title: { display: true, text: 'Nota' } }
                  }
              }
          });
        </script>
      </ol>
    </article>
  </body>
</html>
