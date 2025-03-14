document.getElementById('formCadastro').addEventListener('submit', function(event){
    event.preventDefault()

    var name = document.getElementById('name').value.trim()
    var cpf = document.getElementById('cpf').value.trim()
    var date = document.getElementById('date').value
    var email = document.getElementById('email').value.trim()
    
    var usuario = {
        nome: name,
        cpf: cpf,
        datadeNascimento: date,
        email: email,
    }

    console.log(usuario)
})
