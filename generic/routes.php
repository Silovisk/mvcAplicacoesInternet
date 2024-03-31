<?php

use generic\Acao;
use generic\Controller;

$controller = Controller::getInstance();

$actions = ['index', 'create', 'store', 'update', 'destroy'];

# Produto
foreach ($actions as $action) {
    $controller->addRoute("produtos/$action", new Acao('controller\ProdutoController', $action));
}
$controller->addRoute('produtos/edit/:id', new Acao('controller\ProdutoController', 'edit'));

# User
$controller->addRoute('user/login', new Acao('controller\UserController', 'login'));
$controller->addRoute('user/register', new Acao('controller\UserController', 'register'));
$controller->addRoute('user/store', new Acao('controller\UserController', 'store'));
$controller->addRoute('user/authLogin', new Acao('controller\UserController', 'authLogin'));

