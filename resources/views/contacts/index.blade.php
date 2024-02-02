@extends('layout')

@section('title', 'Lista de Contatos')

@section('content')
    <div class="titulo-box">
        <h2>Lista de Contatos</h2>
    </div>

    <div class="text-right mb-3">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#adicionarContatoModal">
            Adicionar Contato
        </button>
    </div>

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

@endsection

@section('scripts')
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

                        window.location.reload();
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

        function excluirContato(id) {
            if (confirm("Tem certeza que deseja excluir este contato?")) {
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                url: '/contacts/' + id,
                type: 'DELETE',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(response) {
                    alert('Exclusão realizadao com sucesso!!!');
                    window.location.reload();
                },
                error: function(error) {
                    console.log(error);
                }
                });
            }
        }
    </script>
@endsection
