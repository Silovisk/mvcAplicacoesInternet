<html>
    <body>
        <h2>Produtos</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Descrição</th>
                <th>Quantidade</th>
                <th>Valor</th>
                <th>Categoria</th>
            </tr>
            <?php foreach ($param['lista'] as $v) { ?>
                <tr>
                    <td><?php echo $v['idproduto']; ?></td>
                    <td><?php echo $v['nome']; ?></td>
                    <td><?php echo $v['descricao']; ?></td>
                    <td><?php echo $v['quantidade']; ?></td>
                    <td><?php echo $v['valor']; ?></td>
                    <td><?php echo $v['categoria']; ?></td>
                </tr>
            <?php } ?>
        </table>
    </body>
</html>
