<?php

spl_autoload_register(function ($class) {
    $class = str_replace('\\', '/', $class);
    $file = $_SERVER['DOCUMENT_ROOT'].'/mvc2024/'.$class.'.php';
    echo "Tentando incluir o arquivo: $file\n";
    include $file;
});
