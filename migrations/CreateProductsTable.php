<?php

namespace migrations;

class CreateProductsTable
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function up()
    {
        $sql = '
            CREATE TABLE produtos (
            id INT NOT NULL AUTO_INCREMENT,
            nome VARCHAR(255) NOT NULL,
            descricao TEXT,
            quantidade INT NOT NULL,
            preco DECIMAL(10,2) NOT NULL,
            categoria VARCHAR(100) NOT NULL,
            PRIMARY KEY (id)
            );
        ';

        $this->db->exec($sql);
    }

    public function down()
    {
        $sql = 'DROP TABLE IF EXISTS produtos;';
        $this->db->exec($sql);
    }
}
