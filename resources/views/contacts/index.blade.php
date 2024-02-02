@extends('layout')

@section('content')
    <!-- Box do Título "Lista de Contatos" -->
    <div class="titulo-box">
        <h2>Lista de Contatos</h2>
    </div>

    <!-- Botão Adicionar (agora verde) -->
    <div class="text-right mb-3">
        @if (Auth::check())
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#adicionarContatoModal">
                Adicionar Contato
            </button>
            
            <!-- Botão "Sair" -->
            <a href="{{ route('logout') }}" class="btn btn-danger ml-2"
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Sair
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        @else
            <!-- Botão "Login" -->
            <button type="button" class="btn btn-primary ml-2" data-toggle="modal" data-target="#loginModal">
                Login
            </button>
        @endif
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
                    @if (Auth::check())
                        <!-- Botões para usuários logados -->
                        <button class="btn btn-danger" onclick="excluirContato({{ $contact->id }})">Excluir</button>
                        <button class="btn btn-info" onclick="carregarEditarContato({{ $contact->id }})" data-toggle="modal" data-target="#adicionarEditarContatoModal">Editar</button>
                        <button class="btn btn-secondary" onclick="verContato({{ $contact->id }})" data-toggle="modal" data-target="#verContatoModal">Ver</button>
                    @else
                        <!-- Botão "Ver" para usuários não logados -->
                        <button class="btn btn-secondary" onclick="verContato({{ $contact->id }})" data-toggle="modal" data-target="#verContatoModal">Ver</button>
                    @endif

                    
                    </td>
                   
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal Ver Contato -->
    <div class="modal fade" id="verContatoModal" tabindex="-1" role="dialog" aria-labelledby="verContatoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="verContatoModalLabel">Detalhes do Contato</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Aqui você pode exibir os detalhes do contato -->
                    <p>Nome: <span id="detalhesNome"></span></p>
                    <p>Contato: <span id="detalhesContato"></span></p>
                    <p>E-mail: <span id="detalhesEmail"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal de Login -->
    <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Formulário de Login -->
                    <form id="loginForm" autocomplete="off">
                        <div class="form-group">
                            <label for="email">E-mail:</label>
                            <input value="rodrigo1254@gmail.com" type="email" class="form-control" id="emailLogin" name="email" placeholder="Digite o e-mail" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Senha:</label>
                            <input value="123456" type="password" class="form-control" id="password" name="password" placeholder="Digite a senha" required>
                        </div>
                        <button type="button" class="btn btn-primary" onclick="submitLoginForm()">Entrar</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
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
                            <input type="tel" class="form-control" id="contato" name="contato" placeholder="Digite o contato" required pattern="\d{9}" maxlength="9" inputmode="numeric">
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

        function verContato(id) {
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
            url: '/contacts/' + id,
            type: 'GET',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': csrfToken
            },
            success: function(response) {
                $('#detalhesNome').text(response.contact.nome);
                $('#detalhesContato').text(response.contact.contato);
                $('#detalhesEmail').text(response.contact.email);
                
                // Exibe a modal
                $('#verContatoModal').modal('show');
            },
            error: function(error) {
                console.log(error);
            }
            });
            
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


        //Funcao para realizar exclusao
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

        function submitLoginForm() {
            var email = $('#emailLogin').val();
            var password = $('#password').val();

            // Requisição AJAX
            $.ajax({
                url: '/login', // Altere para o endpoint correto
                type: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'email': email,
                    'password': password
                },
                success: function(response) {
                    // Sucesso na autenticação, faça o que for necessário aqui
                    console.log(response);
                },
                error: function(error) {
                    // Falha na autenticação, manipule o erro aqui
                    console.log(error);
                }
            });
        }
    </script>
@endsection
