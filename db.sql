CREATE TABLE produtos (
id INT NOT NULL AUTO_INCREMENT,
nome VARCHAR(255) NOT NULL,
descricao TEXT,
quantidade INT NOT NULL,
preco DECIMAL(10,2) NOT NULL,
categoria VARCHAR(100) NOT NULL,
PRIMARY KEY (id)
);

DELIMITER $$

CREATE PROCEDURE gerar_dados()
BEGIN
DECLARE i INT;
DECLARE nome VARCHAR(255);
DECLARE descricao TEXT;
DECLARE quantidade INT;
DECLARE preco DECIMAL(10,2);
DECLARE categoria VARCHAR(100);

SET i = 1;

WHILE i <= 1000 DO
  SET nome = CONCAT('Produto ', i);
  SET descricao = CONCAT('Descrição do produto ', i);
  SET quantidade = FLOOR(RAND() * 100) + 1;
  SET preco = FLOOR(RAND() * 1000) + 1;
  SET categoria = CASE i
    WHEN 1 THEN 'Vestuário'
    WHEN 2 THEN 'Eletrônicos'
    WHEN 3 THEN 'Alimentos'
    ELSE 'Outros'
  END;

  INSERT INTO produtos (nome, descricao, quantidade, preco, categoria)
  VALUES (nome, descricao, quantidade, preco, categoria);

  SET i = i + 1;
END WHILE;

END $$

DELIMITER ;

CALL gerar_dados();
