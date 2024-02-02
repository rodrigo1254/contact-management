<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Contatos</title>
    <!-- Adicione o link para o Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Estilo para o título "Lista de Contatos" */
        .titulo-box {
            background-color: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
        }

        /* Estilo para o grid (tabela) de contatos */
        .contatos-grid {
            border: 1px solid #dee2e6;
            border-radius: 10px;
        }

        /* Estilo para destacar a linha ao passar o mouse */
        .contato-item:hover {
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>

<div class="container mt-5">
    <!-- Box do Título "Lista de Contatos" -->
    <div class="titulo-box">
        <h2>Lista de Contatos</h2>
    </div>

    <!-- Botão Adicionar (agora verde) -->
    <div class="text-right mb-3">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#adicionarContatoModal">
            Adicionar Contato
        </button>
    </div>

    <!-- Tabela de Contatos -->
    <table class="table contatos-grid">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Contato</th>
                <th>E-mail</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr class="contato-item">
                    <td>{{ $contact->id }}</td>
                    <td>{{ $contact->nome }}</td>
                    <td>{{ $contact->contato }}</td>
                    <td>{{ $contact->email }}</td>
                    <td>
                        <button class="btn btn-danger" onclick="excluirContato({{ $contact->id }})">Excluir</button>
                        <button class="btn btn-info" onclick="carregarEditarContato({{ $contact->id }})" data-toggle="modal" data-target="#adicionarEditarContatoModal">Editar</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Modal Adicionar Contato -->
<div class="modal fade" id="adicionarContatoModal" tabindex="-1" role="dialog" aria-labelledby="adicionarContatoModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="adicionarContatoModalLabel">Adicionar Contato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Campos do Formulário com validações HTML5 -->
                <form id="formAdicionarContato">
                    <input type="hidden" class="form-control" id="contatoId">
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome" required minlength="5">
                    </div>
                    <div class="form-group">
                        <label for="contato">Contato:</label>
                        <input type="text" class="form-control" id="contato" name="contato" placeholder="Digite o contato" required pattern="\d{9}">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Digite o e-mail" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" id="btnAction" onclick="salvarContato()">Salvar</button>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>

    function salvarContato() {
        // Validação básica no lado do cliente
        if ($('#formAdicionarContato')[0].checkValidity()) {
            // Dados do formulário
            var dados = {
                nome: $('#nome').val(),
                contato: $('#contato').val(),
                email: $('#email').val()
            };

            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var url = '/contacts';

            var contatoId = $('#contatoId').val();
            if (contatoId) {
                url += '/' + contatoId;
            }

            // Requisição Ajax usando jQuery
            $.ajax({
                url: url,
                type: contatoId ? 'PUT' : 'POST',
                data: dados,
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function (response) {
                    $('#adicionarContatoModal').modal('hide');
                    $('#btnAction').text('Salvar');
                },
                error: function (error) {
                    alert('Erro ao salvar o contato.');
                    console.log(error);
                }
            });
        } else {
            alert('Por favor, preencha todos os campos corretamente.');
        }
    }

    function carregarEditarContato(contatoId) {
        var csrfToken = $('meta[name="csrf-token"]').attr('content');
	    $.ajax({
		url: '/contacts/' + contatoId,
		type: 'GET',
		dataType: 'json',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
		success: function(response) {
		    $('#contatoId').val(response.contact.id);
		    $('#nome').val(response.contact.nome);
            $('#contato').val(response.contact.contato);
            $('#email').val(response.contact.email);

		    $('#btnAction').text('Atualizar');
		    $('#adicionarContatoModal').modal('show');
		},
		error: function(error) {
		    console.log(error);
		}
	    });
	}

    // Função de exemplo para excluir um contato (pode ser substituída por sua lógica real)
    function excluirContato(id) {
        if (confirm("Tem certeza que deseja excluir este contato?")) {
            // Lógica para excluir o contato (pode ser chamada de uma API, por exemplo)
            alert("Contato excluído com sucesso!");
        }
    }
</script>

</body>
</html>
