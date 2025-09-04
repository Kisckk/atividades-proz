<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Banco de Sangue</title>
<style>
  body { font-family: Arial, sans-serif; padding:20px; }
  input, select, button { display:block; width:100%; padding:6px; margin:6px 0; }
  table { width:100%; border-collapse: collapse; margin-top:12px; }
  th, td { border:1px solid #aaa; padding:6px; text-align:center; }
  .baixo { background:#ffdddd; }
</style>
</head>
<body>

<h1>Banco de Sangue</h1>

<section>
  <h2>Cadastro de Doador</h2>
  <form id="cadastroForm">
    <input type="text" id="nome" placeholder="Nome Completo" required>
    <input type="text" id="cpf" placeholder="CPF" required>
    <input type="date" id="nascimento" required>
    <select id="tipoSangue" required>
      <option value="">Selecione o Tipo</option>
      <option>A+</option><option>A-</option>
      <option>B+</option><option>B-</option>
      <option>AB+</option><option>AB-</option>
      <option>O+</option><option>O-</option>
    </select>
    <button type="submit">Cadastrar</button>
  </form>
</section>

<section>
  <h2>Registrar Doação</h2>
  <form id="doacaoForm">
    <select id="listaDoadores" required></select>
    <input type="date" id="dataDoacao" required>
    <button type="submit">Registrar</button>
  </form>
</section>

<section>
  <h2>Estoque</h2>
  <table>
    <thead>
      <tr><th>Tipo</th><th>Unidades</th></tr>
    </thead>
    <tbody id="estoqueTabela"></tbody>
  </table>
</section>

<section>
  <h2>Doadores</h2>
  <table>
    <thead>
      <tr><th>Nome</th><th>CPF</th><th>Nascimento</th><th>Tipo</th><th>Última Doação</th></tr>
    </thead>
    <tbody id="doadoresTabela"></tbody>
  </table>
</section>

<script>
const STORAGE_KEY = "bancoSangue_v2";

// ---------- BANCO ----------
function carregarBanco() {
  const salvo = localStorage.getItem(STORAGE_KEY);
  if (salvo) return JSON.parse(salvo);
  const inicial = { 
    doadores: [], 
    estoque: {"A+":0,"A-":0,"B+":0,"B-":0,"AB+":0,"AB-":0,"O+":0,"O-":0} 
  };
  salvarBanco(inicial);
  return inicial;
}

function salvarBanco(banco) {
  localStorage.setItem(STORAGE_KEY, JSON.stringify(banco));
}

// ---------- INTERFACE ----------
function preencherSelectDoadores() {
  const banco = carregarBanco();
  const select = document.getElementById("listaDoadores");
  select.innerHTML = "<option value=''>Selecione um doador</option>";
  banco.doadores.forEach(d => {
    select.innerHTML += `<option value="${d.cpf}">${d.nome} (${d.tipo})</option>`;
  });
}

function atualizarEstoque() {
  const banco = carregarBanco();
  const tbody = document.getElementById("estoqueTabela");
  tbody.innerHTML = "";
  for (let tipo in banco.estoque) {
    const qtd = banco.estoque[tipo];
    const classe = qtd < 3 ? "baixo" : "";
    tbody.innerHTML += `<tr class="${classe}"><td>${tipo}</td><td>${qtd}</td></tr>`;
  }
}

function atualizarDoadores() {
  const banco = carregarBanco();
  const tbody = document.getElementById("doadoresTabela");
  tbody.innerHTML = "";
  banco.doadores.forEach(d => {
    tbody.innerHTML += `
      <tr>
        <td>${d.nome}</td>
        <td>${d.cpf}</td>
        <td>${d.nascimento}</td>
        <td>${d.tipo}</td>
        <td>${d.ultimaDoacao || "-"}</td>
      </tr>
    `;
  });
}

// ---------- EVENTOS ----------
document.getElementById("cadastroForm").addEventListener("submit", e => {
  e.preventDefault();
  const banco = carregarBanco();

  const nome = document.getElementById("nome").value;
  const cpf = document.getElementById("cpf").value;
  const nascimento = document.getElementById("nascimento").value;
  const tipo = document.getElementById("tipoSangue").value;

  if (banco.doadores.some(d => d.cpf === cpf)) {
    alert("CPF já cadastrado!");
    return;
  }

  banco.doadores.push({ nome, cpf, nascimento, tipo, ultimaDoacao: null });
  salvarBanco(banco);

  e.target.reset();
  preencherSelectDoadores();
  atualizarDoadores();
});

document.getElementById("doacaoForm").addEventListener("submit", e => {
  e.preventDefault();
  const banco = carregarBanco();

  const cpf = document.getElementById("listaDoadores").value;
  const data = document.getElementById("dataDoacao").value;

  const doador = banco.doadores.find(d => d.cpf === cpf);
  if (!doador) return;

  doador.ultimaDoacao = data;
  banco.estoque[doador.tipo] += 1;

  salvarBanco(banco);

  e.target.reset();
  atualizarEstoque();
  atualizarDoadores();
});

// ---------- INICIALIZAÇÃO ----------
preencherSelectDoadores();
atualizarEstoque();
atualizarDoadores();
</script>

</body>
</html>