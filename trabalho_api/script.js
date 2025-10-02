async function buscarCEP() {
  const cep = document.getElementById("cep").value.trim();
  const resultado = document.getElementById("resultado");

  if (cep.length !== 8 || isNaN(cep)) {
    resultado.innerHTML = "<p style='color:red'>Digite um CEP válido (8 números)</p>";
    return;
  }

  try {
    const response = await fetch(`https://viacep.com.br/ws/${cep}/json/`);
    const data = await response.json();

    if (data.erro) {
      resultado.innerHTML = "<p style='color:red'>CEP não encontrado.</p>";
    } else {
      resultado.innerHTML = `
        <p><strong>Rua:</strong> ${data.logradouro}</p>
        <p><strong>Bairro:</strong> ${data.bairro}</p>
        <p><strong>Cidade:</strong> ${data.localidade} - ${data.uf}</p>
        <p><strong>DDD:</strong> ${data.ddd}</p>
      `;
    }
  } catch (error) {
    resultado.innerHTML = "<p style='color:red'>Erro ao buscar o CEP.</p>";
  }
}