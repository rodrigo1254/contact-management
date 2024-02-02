<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Contatos</title>
    <!-- Adicione o link para o Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <!-- Botão Adicionar (agora verde) -->
    <div class="text-right mb-3">
        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#adicionarContatoModal">
            Adicionar Contato
        </button>
    </div>

    <h2>Lista de Contatos</h2>
    <!-- Tabela de Contatos -->
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Contato</th>
                <th>E-mail</th>
                <th>Ações</th> <!-- Nova coluna para Ações -->
            </tr>
        </thead>
        <tbody>
            <!-- Exemplo de Contatos -->
            <tr>
                <td>1</td>
                <td>João Silva</td>
                <td>987654321</td>
                <td>joao@example.com</td>
                <td>
                    <!-- Botões de Ações -->
                    <button class="btn btn-danger" onclick="excluirContato(1)">Excluir</button>
                    <button class="btn btn-info" data-toggle="modal" data-target="#editarContatoModal">Editar</button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Maria Oliveira</td>
                <td>912345678</td>
                <td>maria@example.com</td>
                <td>
                    <button class="btn btn-danger" onclick="excluirContato(2)">Excluir</button>
                    <button class="btn btn-info" data-toggle="modal" data-target="#editarContatoModal">Editar</button>
                </td>
            </tr>
            <tr>
                <td>3</td>
                <td>Carlos Santos</td>
                <td>998877665</td>
                <td>carlos@example.com</td>
                <td>
                    <button class="btn btn-danger" onclick="excluirContato(3)">Excluir</button>
                    <button class="btn btn-info" data-toggle="modal" data-target="#editarContatoModal">Editar</button>
                </td>
            </tr>
            <!-- Adicione mais linhas conforme necessário -->
        </tbody>
    </table>
</div>

<!-- Adicione o link para o Bootstrap JS e o Popper.js -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Modal Adicionar Contato -->
<div class="modal fade" id="adicionarContatoModal" tabindex="-1" role="dialog" aria-labelledby="adicionarContatoModalLabel" aria-hidden="true">
    <!-- ... (código do modal de adição de contatos) ... -->
</div>

<!-- Modal Editar Contato -->
<div class="modal fade" id="editarContatoModal" tabindex="-1" role="dialog" aria-labelledby="editarContatoModalLabel" aria-hidden="true">
    <!-- ... (código do modal de edição de contatos) ... -->
</div>

<script>
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
