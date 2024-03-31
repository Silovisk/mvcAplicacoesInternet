<?php


namespace dao\mysql;

use dao\interface\IUserDAO;
use generic\MysqlFactory;

class UserDAO extends MysqlFactory implements IUserDAO
{

    public function login()
    {
    }

    public function store()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            
            if (!isset($data['username']) || !isset($data['password'])) {
                throw new \Exception('Username e password são necessários');
            }

            $sql = 'INSERT INTO users (username, password, salt) VALUES(:username, :password, :salt)';

            $salt = random_bytes(16);
            $password = $data['password'];
            $hashedPassword = password_hash($password . $salt, PASSWORD_DEFAULT);
            $param = [
                'username' => $data['username'],
                'password' => $hashedPassword,
                'salt' => $salt
            ];

            $resultado = $this->banco->executar($sql, $param);

            return json_encode(['status' => 'success', 'message' => 'Usuário salvo com sucesso!']);
        } catch (\Exception $e) {
            // Log the error internally
            error_log($e->getMessage());

            return json_encode(['status' => 'error', 'message' => 'Erro ao salvar usuário']);
        }
    }

    public function authLogin()
    {
        try {
            $data = json_decode(file_get_contents('php://input'), true);
            if (!isset($data['username']) || !isset($data['password'])) {
                throw new \Exception('Username e password são necessários');
            }

            $sql = 'SELECT username, password, salt FROM users WHERE username = :username';

            $param = ['username' => $data['username']];
            $user = $this->banco->executar($sql, $param);

            if ($user) {

                $user = (object) $user[0];
                $hashedPassword = $user->password;
                $salt = $user->salt;
                $password = $data['password'];

                if (password_verify($password . $salt, $hashedPassword)) {
                    return json_encode(['status' => 'success', 'message' => 'Login bem-sucedido']);
                } else {
                    throw new \Exception('Password incorreto');
                }
            } else {
                throw new \Exception('Username não encontrado');
            }
        } catch (\Exception $e) {
            return json_encode(['status' => 'error', 'message' => 'Erro ao Fazer login']);
        }
    }
}