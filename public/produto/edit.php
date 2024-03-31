<?php include 'public/header.php'; ?>

<?php
if (isset($param['produto'])) {
    $produto = (object) $param['produto'][0];
} else {
    return;
}

?>

<div class="container">
    <h2>Editar Produto</h2>
    <form id="product-form">
        <input type="hidden" name="id" value="<?php echo $produto->id; ?>">
        <div class="row">
            <div class="col-md-3">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="nome" value="<?php echo $produto->nome; ?>"required>
                    <label for="nome">Nome</label>
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="descricao"   value="<?php echo $produto->descricao; ?>" required>
                    <label for="descricao">Descrição</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="quantidade"  value="<?php echo $produto->quantidade; ?>" required>
                    <label for="quantidade">Quantidade</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <input type="number" step="0.01" class="form-control" id="preco" name="preco" placeholder="preco"  value="<?php echo $produto->preco; ?>" required>
                    <label for="preco">Preco</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="categoria" name="categoria" placeholder="categoria"  value="<?php echo $produto->categoria; ?>" required>
                    <label for="categoria">Categoria</label>
                </div>
            </div>
        </div>
        <a href="/mvcAplicacoesInternet/produtos/index" class="btn btn-secondary">Voltar</a>
        <button type="submit" class="btn btn-primary">Editar</button>
    </form>
    <div id="message"></div>
</div>

<?php include 'public/footer.php'; ?>

<script>
    const PageProductsEdit = {
        init: () => {
            PageProductsEdit.initForm();
        },

        initForm: () => {
            const form = document.getElementById('product-form');
            form.addEventListener('submit', PageProductsEdit.handleFormSubmit);
        },

        handleFormSubmit: (event) => {
            event.preventDefault();
            const form = event.target;
            const data = new FormData(form);
            console.log(data);
            fetch('/mvcAplicacoesInternet/produtos/update', {
                method: 'POST',
                body: data,
            })
            .then((response) => response.json())
            .then((data) => {
                console.log(data);
                if (data.status === 'success') {
                    Swal.fire({
                        title: "Sucesso!",
                        text: data.message,
                        icon: "success",
                        showCancelButton: false,
                        confirmButtonText: "OK",
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/mvcAplicacoesInternet/produtos/index';
                        }
                    });
                    document.getElementById('product-form').reset();
                } else {
                    Swal.fire({
                        title: "Erro!",
                        text: 'Erro ao editar o produto',
                        icon: "error",
                        showCancelButton: false,
                        confirmButtonText: "OK",
                    });
                }
            });
        },
    };

    PageProductsEdit.init();
</script>