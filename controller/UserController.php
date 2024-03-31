<?php 


namespace controller;
use service\UserService;
use view\UserView;

class UserController
{
    protected $userService;

    protected $userView;

    public function __construct() 
    {
        $this->userView = new UserView();
        $this->userService = new UserService();
    }

    public function login()
    {
        $this->userView->login();
    }

    public function authLogin()
    {
        $response = $this->userService->authLogin();
        header('Content-Type: application/json');
        echo $response;
    }


    public function register()
    {
        $this->userView->register();
    }

    public function store()
    {
        $response = $this->userService->store();
        header('Content-Type: application/json');
        echo $response;
    }
    public function logou()
    {

    }
}