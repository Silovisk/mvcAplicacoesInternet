<?php include 'public/header.php'; ?>

<div class="container">
    <h2>Cadastro de Produtos</h2>
    <form id="product-form">
        <div class="row">
            <div class="col-md-3">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="nome" name="nome" placeholder="nome">
                    <label for="nome">Nome</label>
                </div>
            </div>
            <div class="col-md-9">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="descricao" name="descricao" placeholder="descricao" required>
                    <label for="descricao">Descrição</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <input type="number" class="form-control" id="quantidade" name="quantidade" placeholder="quantidade" required>
                    <label for="quantidade">Quantidade</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <input type="number" step="0.01" class="form-control" id="preco" name="preco" placeholder="preco" required>
                    <label for="preco">Preco</label>
                </div>
            </div>
            <div class="col-md-4">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="categoria" name="categoria" placeholder="categoria" required>
                    <label for="categoria">Categoria</label>
                </div>
            </div>
        </div>
        <a href="index" class="btn btn-secondary">Voltar</a>
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
    <div id="message"></div>
</div>

<?php include 'public/footer.php'; ?>

<script>
    const PageProductsCreate = {
        init: () => {
            PageProductsCreate.initForm();
        },

        initForm: () => {
            const form = document.getElementById('product-form');
            form.addEventListener('submit', PageProductsCreate.handleFormSubmit);
        },

        handleFormSubmit: (event) => {
            event.preventDefault();
            const form = event.target;
            const data = new FormData(form);
            console.log(data);
            fetch('store', {
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
                            // Redirect to the product list page
                            window.location.href = 'index';
                        }
                    });
                    document.getElementById('product-form').reset();
                } else {
                    Swal.fire({
                        title: "Erro!",
                        text: 'Erro ao salvar o produto',
                        icon: "error",
                        showCancelButton: false,
                        confirmButtonText: "OK",
                    });
                }
            });
        },
    };

    PageProductsCreate.init();
</script>