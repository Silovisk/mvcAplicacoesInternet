<?php

use generic\Controller;

define('ROOT_PATH', realpath(dirname(__FILE__)));

include_once 'generic/AutoLoad.php';

$controller = Controller::getInstance();

require_once 'generic/routes.php';

if (isset($_GET['param'])) {
    $controller->verificarCaminho($_GET['param']);
}
