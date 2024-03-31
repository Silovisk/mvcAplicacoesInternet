<?php

namespace view;
use generic\View;

class UserView extends View
{

    public function login()
    { 
        $this->conteudo('public/user/login.php');
    }

    public function register()
    {
        $this->conteudo('public/user/register.php');
    }
}