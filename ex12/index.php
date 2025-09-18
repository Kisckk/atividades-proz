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
        <li><strong>Tipos de IA</strong></li>
        
          <li>Generativa</li>
          <div>Ela cria imagens, vídeos, textos utilizando como base padrões aprendidos pelo usuário.</div>

          <li>Large Language Models</li>
          <div>São modelos de linguagem em larga escala que entendem e produzem textos de forma coerente, respondendo perguntas, explicando conceitos, traduzindo ou até interagindo em diálogos.</div>

          <li>Visão Computacional</li>
          <div>A visão computacional é uma área da IA focada em fazer com que máquinas “enxerguem” e interpretem o mundo visual.</div>

          <li><strong>Bibliotecas em Python para IA</strong></li>
          <li>Keras</li>
          <div>É usada quando você precisa criar redes neurais de forma rápida e simples, ideal para protótipos de IA como reconhecimento de imagens ou análise de texto.</div>
          <li>PyTorch</li>
          <div>É indicada para pesquisas e projetos avançados de Deep Learning, quando você precisa de flexibilidade para criar arquiteturas complexas como Transformers ou GANs.</div>
          <li>Scikit-Learn</li>
          <div>É a escolha certa quando o projeto envolve algoritmos de Machine Learning tradicional, como regressão, classificação ou clusterização em dados tabulares.</div>

          <li><strong>Bibliotecas</strong></li>
          <li>OpenCV</li>
          <div>É uma biblioteca de visão computacional muito usada em projetos de processamento de imagens e vídeos. Com ela, é possível detectar bordas, reconhecer faces, aplicar filtros, identificar objetos e trabalhar com análise de movimento. O objetivo é fornecer ferramentas para que computadores entendam e interpretem imagens e vídeos.</div>
          <li>YOLO (You Only Look Once)</li>
          <div>É um modelo/algoritmo de detecção de objetos em tempo real. Ele analisa a imagem de uma só vez (por isso o nome “You Only Look Once”) e consegue identificar e localizar objetos com alta velocidade e precisão. O objetivo é reconhecer vários objetos ao mesmo tempo em uma cena, como pessoas, carros, animais etc. É muito usado em câmeras de segurança, veículos autônomos e sistemas de monitoramento.</div>
          <li>MediaPipe</li>
          <div>É uma biblioteca do Google voltada para processamento multimídia em tempo real. Ela já traz modelos prontos para tarefas como detecção de mãos, reconhecimento de gestos, rastreamento de rosto, pose corporal e até segmentação de imagens. O objetivo é facilitar o desenvolvimento de aplicações interativas de visão computacional e realidade aumentada, sem precisar treinar modelos do zero.</div>
    </article>
  </body>
</html>
