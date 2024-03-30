<?php

use generic\Controller;

define('ROOT_PATH', realpath(dirname(__FILE__)));

include_once 'generic/AutoLoad.php';

if (isset($_GET['param'])) {
    $controller = Controller::getInstance();

    $controller->verificarCaminho($_GET['param']);
}
