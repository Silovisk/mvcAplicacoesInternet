<?php include 'public/header.php'; ?>

<?php
$produtos = array_map(function ($produto) {
    return (object) $produto;
}, $param['lista']);

$categorias = array_map(function ($categoria) {
    return (object) $categoria;
}, $param['categorias']);
?>

<div class="container">

    <!-- Teste -->
    <div class="d-flex flex-row-reverse my-5">
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasFilter"
            aria-controls="offcanvasFilter">Filtros 2 </button>
    </div>

    <div class="d-flex justify-content-center">
        <div class="mb-3">
            <label for="categoria" class="form-label">Filtro Categoria</label>
            <select class="form-select" id="categoria" name="categoria">
                <option selected disabled>Selectione a categoria</option>
                <?php foreach ($categorias as $categoria) { ?>
                    <option value="<?php echo $categoria->categoria; ?>">
                        <?php echo $categoria->categoria; ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>
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
                    <td>
                        <?php echo $produto->id; ?>
                    </td>
                    <td>
                        <?php echo $produto->nome; ?>
                    </td>
                    <td>
                        <?php echo $produto->descricao; ?>
                    </td>
                    <td>
                        <?php echo $produto->quantidade; ?>
                    </td>
                    <td>
                        <?php echo $produto->preco; ?>
                    </td>
                    <td>
                        <?php echo $produto->categoria; ?>
                    </td>
                    <td>
                        <a href="edit/<?php echo $produto->id; ?>" class="btn btn-secondary">Editar</a>
                        <button
                            onclick="PageProducts.handleDelete(<?php echo $produto->id; ?> ,'<?php echo $produto->nome; ?>')"
                            class="btn btn-danger">Excluir</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- OffCanvas Filtro -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasFilter" aria-labelledby="offcanvasFilterLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasFilterLabel">Filtros</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form id="form-filter">
            <div class="row">
                <div class="mb-3">
                    <label for="categoria" class="form-label">Categoria</label>
                    <select class="form-select" id="categoria" name="categoria">
                        <option selected disabled>Selectione a categoria</option>
                        <?php foreach ($categorias as $categoria) { ?>
                            <option value="<?php echo $categoria->categoria; ?>">
                                <?php echo $categoria->categoria; ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include 'public/footer.php'; ?>

<script>
    const PageProducts = {
        init: () => {
            PageProducts.initDataTables();
            PageProducts.handleFilter();
            PageProducts.filter();
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
        },

        // Filter Client Side
        handleFilter: () => {
            document.getElementById('categoria').addEventListener('change', function () {
                var table = $('#table-products').DataTable();
                table.column(5).search(this.value).draw();
            });
        },

        // Filter Server Side
        filter: () => {
            document.getElementById('form-filter').addEventListener('submit', function (e) {
                e.preventDefault();
                console.log('Filtrando por categoria:', this.categoria.value);
                fetch(`index/filtraCategoria?categoria=${encodeURIComponent(this.categoria.value)}`, {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                })
                    .then(response => response.json())
                    .then(data => {
                        var table = $('#table-products').DataTable();
                        var newData = data.map(obj => [...Object.values(obj), '']);
                        table.clear().rows.add(newData).draw();
                        table.column(6).data().each(function (value, index) {
                            var id = table.cell(index, 0).data();
                            var nome = table.cell(index, 1).data();
                            var actionButtons = `
                                <a href="edit/${id}" class="btn btn-secondary">Editar</a>
                                <button onclick="PageProducts.handleDelete(${id}, '${nome}')" class="btn btn-danger">Excluir</button>
                            `;
                            table.cell(index, 6).data(actionButtons).draw();
                        });
                    });
            });
        }
    };

    PageProducts.init();
</script>