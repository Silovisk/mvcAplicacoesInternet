<html>
    <head>
        <link rel="stylesheet" href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    </head>
    <body>
        <h2>Professores</h2>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
            </tr>
            <?php foreach ($param['lista'] as $v) { ?>
                    <tr>
                        <td><?php $v['idprofessor']; ?></td>
                        <td><?php $v['nome']; ?></td>
                    </tr>
            <?php } ?>
        </table>
     


        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
        <script>

        </script>
    </body>
</html>