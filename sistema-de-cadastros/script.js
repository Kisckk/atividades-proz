document.getElementById('formCadastro').addEventListener('submit', function(event){
    event.preventDefault()

    var name = document.getElementById('name').value.trim()
    var cpf = document.getElementById('cpf').value.trim()
    var date = document.getElementById('date').value
    var email = document.getElementById('email').value.trim()

    if(!name || !cpf || !date || !email) {
        alert('[ERRO] Preencha todos os campos!')
        return
    }
    
    var novoUsuario = {
        nome: name,
        cpf: cpf,
        dataDeNascimento: date,
        email: email
    }

    var usuarios = JSON.parse(localStorage.getItem('usuarios')) || []
    
    usuarios.push(novoUsuario)
    
    localStorage.setItem('usuarios', JSON.stringify(usuarios))
    
    console.table(usuarios)

    document.getElementById('formCadastro').reset()
})

document.getElementById('formproc').addEventListener('submit', (eventpesq) => {
    eventpesq.preventDefault()

    var pesquisar = document.getElementById('pesq').value.trim()
    var res = document.getElementById('res')
    var usuarios = JSON.parse(localStorage.getItem('usuarios')) || []
    
if (!pesquisar) {
    res.innerHTML = '<p style="color: red;">[ERRO]Digite um nome para pesquisar!'
    return
}

const filtro = usuarios.find(usuarios => usuarios.nome.toLowerCase() === pesquisar)

if(filtro) {
    res.innerHTML = `
        <p><strong>Nome:</strong> ${filtro.nome}</p>
        <p><strong>CPF:</strong> ${filtro.cpf}</p>
        <p><strong>Data de Nascimento:</strong> ${filtro.dataDeNascimento}</p>
        <p><strong>Email:</strong> ${filtro.email}</p>
    `
    var excluir = document.createElement('button')
        excluir.textContent = 'Excluir Usuário'
        excluir.style.backgroundColor = 'darkred'
        excluir.style.color = 'white'
        excluir.style.border = 'none'
        excluir.style.padding = '10px'
        excluir.style.cursor = 'pointer'
        excluir.style.borderRadius = '10px'
        
        excluir.addEventListener('click', () => {
            var usuariosAtualizados = usuarios.filter(usuarios => usuarios.nome !== filtro.nome)
            localStorage.setItem('usuarios', JSON.stringify(usuariosAtualizados))
            res.innerHTML = '<p style="color: green;">Usuário excluído com sucesso!</p>'
        })

        res.appendChild(excluir)
} else {
    res.innerHTML = '<p style="color: red;">Usuário não encontrado!</p>'
}

document.getElementById('formproc').reset()
})