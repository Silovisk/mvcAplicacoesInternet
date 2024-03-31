<?php

namespace service;

use dao\mysql\UserDAO;

class UserService extends UserDAO
{
    public function login()
    {
        return parent::login();
    }

    public function store()
    {
        return parent::store();
    }

    public function authLogin()
    {
        return parent::authLogin();
    }
}