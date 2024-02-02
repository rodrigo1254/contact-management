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
            <!-- Exemplo de Contatos -->
            <tr class="contato-item">
                <td>1</td>
                <td>João Silva</td>
                <td>987654321</td>
                <td>joao@example.com</td>
                <td>
                    <button class="btn btn-danger" onclick="excluirContato(1)">Excluir</button>
                    <button class="btn btn-info" data-toggle="modal" data-target="#editarContatoModal">Editar</button>
                </td>
            </tr>
            <!-- Adicione mais linhas conforme necessário -->
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
                <!-- Campos do Formulário -->
                <form>
                    <div class="form-group">
                        <label for="nome">Nome:</label>
                        <input type="text" class="form-control" id="nome" placeholder="Digite o nome">
                    </div>
                    <div class="form-group">
                        <label for="contato">Contato:</label>
                        <input type="text" class="form-control" id="contato" placeholder="Digite o contato">
                    </div>
                    <div class="form-group">
                        <label for="email">E-mail:</label>
                        <input type="email" class="form-control" id="email" placeholder="Digite o e-mail">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary" onclick="salvarContato()">Salvar</button>
            </div>
        </div>
    </div>
</div>

<!-- Adicione o link para o Bootstrap JS e o Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Modal Editar Contato -->
<div class="modal fade" id="editarContatoModal" tabindex="-1" role="dialog" aria-labelledby="editarContatoModalLabel" aria-hidden="true">
    <!-- ... (código do modal de edição de contatos) ... -->
</div>

<script>
    // Função de exemplo para salvar um novo contato (pode ser substituída por sua lógica real)
    function salvarContato() {
        // Lógica para salvar o novo contato (pode ser chamada de uma API, por exemplo)
        alert("Contato salvo com sucesso!");
        // Feche o modal após salvar
        $('#adicionarContatoModal').modal('hide');
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
