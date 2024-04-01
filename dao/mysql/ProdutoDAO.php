<?php

namespace dao\mysql;

use dao\interface\IProdutoDAO;
use generic\MysqlFactory;

class ProdutoDAO extends MysqlFactory implements IProdutoDAO
{
    public function index()
    {
        $sql = 'SELECT * FROM produtos';

        return $this->banco->executar($sql);
    }

    public function store()
    {
        try {
            $sql = 'INSERT INTO produtos (nome ,descricao ,quantidade ,preco ,categoria) 
            VALUES ( :nome, :descricao, :quantidade, :preco, :categoria)';
            $param = [
                'nome' => $_POST['nome'],
                'descricao' => $_POST['descricao'],
                'quantidade' => $_POST['quantidade'],
                'preco' => $_POST['preco'],
                'categoria' => $_POST['categoria'],
            ];

            $resultado = $this->banco->executar($sql, $param);

            return json_encode(['status' => 'success', 'message' => 'Produto salvo com sucesso!']);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function edit($id)
    {
        $sql = 'SELECT id, nome,descricao ,quantidade ,preco ,categoria FROM produtos WHERE id = :id';
        $param = ['id' => $id];

        return $this->banco->executar($sql, $param);
    }

    public function update()
    {
        try {
            if (!isset($_POST['id'])) {
                return json_encode(['status' => 'error', 'message' => 'ID do produto não fornecido.']);
            }

            $sql = 'UPDATE produtos SET nome = :nome, descricao = :descricao, quantidade = :quantidade, preco = :preco, categoria = :categoria WHERE id = :id';
            $param = [
                'id' => $_POST['id'],
                'nome' => $_POST['nome'],
                'descricao' => $_POST['descricao'],
                'quantidade' => $_POST['quantidade'],
                'preco' => $_POST['preco'],
                'categoria' => $_POST['categoria'],
            ];

            $resultado = $this->banco->executar($sql, $param);

            return json_encode(['status' => 'success', 'message' => 'Produto atualizado com sucesso!']);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function destroy()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);

            if (!isset($data['id'])) {
                return json_encode(['status' => 'error', 'message' => 'ID do produto não fornecido.']);
            }

            $sql = 'DELETE FROM produtos WHERE id = :id';
            $param = [
                'id' => $data['id'],
            ];

            $resultado = $this->banco->executar($sql, $param);

            return json_encode(['status' => 'success', 'message' => 'Produto excluído com sucesso!']);
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function filterCategory()
    {
        $categoria = $_GET['categoria'];

        $sql = 'SELECT * FROM produtos WHERE categoria = :categoria';
        $param = [
            'categoria' => $categoria
        ];

        $result = $this->banco->executar($sql, $param);

        return json_encode($result);
    }

    public function getcategories()
    {
        $sql = 'SELECT DISTINCT categoria FROM produtos';

        return $this->banco->executar($sql);
    }
}
