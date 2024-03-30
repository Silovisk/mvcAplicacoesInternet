<?php include 'public/header.php'; ?>

<?php
$produtos = array_map(function ($produto) {
    return (object) $produto;
}, $param['lista']);
?>


<div class="container">
    <h2>Produtos</h2>
    <a href="create" class="btn btn-primary">Novo Produto</a>
    <table class="table table-striped" id="table-products">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Preco</th>
                <th>Categoria</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($produtos as $produto) { ?>
                <tr>
                    <td><?php echo $produto->id; ?></td>
                    <td><?php echo $produto->nome; ?></td>
                    <td><?php echo $produto->descricao; ?></td>
                    <td><?php echo $produto->quantidade; ?></td>
                    <td><?php echo $produto->preco; ?></td>
                    <td><?php echo $produto->categoria; ?></td>
                    <td>
                        <a href="edit/<?php echo $produto->id; ?>" class="btn btn-secondary">Editar</a>
                        <button onclick="PageProducts.handleDelete(<?php echo $produto->id; ?> ,'<?php echo $produto->nome; ?>')" class="btn btn-danger">Excluir</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>


<?php include 'public/footer.php'; ?>
    
<script>
    const PageProducts = {
        init: () => {
            PageProducts.initDataTables();
        },

        initDataTables: () => {
            $('#table-products').DataTable({
                paging: true,
                searching: true,
                ordering: true,
                info: true,
                autoWidth: false,
                columnDefs: [
                    { className: "text-center", "targets": "_all" }
                ]
            });
        },

        handleDelete: (id, name) => {
           Swal.fire({
                title: 'Deseja excluir o produto?',
                text: `Produto: ${name}`,
                showCancelButton: true,
                confirmButtonText: `Sim`,
                cancelButtonText: `Não`,
            }).then((result) => {
                if (result.isConfirmed) {
                    PageProducts.delete(id);
                }
            });
        },

        delete: (id) => {
            fetch('destroy', {
                method: 'POST',
                body: JSON.stringify({ id: id }),
            })
            .then((response) => response.json())
            .then((data) => {
                if (data.status === 'success') {
                    Swal.fire({
                        title: "Sucesso!",
                        text: data.message,
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonText: "OK",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Reload the page
                            window.location.reload();
                        }
                    });
                } else {
                    Swal.fire({
                        title: "Erro!",
                        text: 'Erro ao excluir o produto',
                        icon: "error",
                        showCancelButton: false,
                        confirmButtonText: "OK",
                    });
                }
            });
        }
    };
    
    PageProducts.init();
</script>