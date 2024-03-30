<?php

use generic\Controller;

include_once "generic/AutoLoad.php";


if(isset($_GET['param'])){
    $controller = Controller::getInstance();

    $controller->verificarCaminho($_GET['param']);

}