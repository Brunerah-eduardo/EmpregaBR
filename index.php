<?php

    require 'lib/autoloader.php';
    mb_internal_encoding("UTF-8");

    Db::connect("localhost", "root", "", "empregabr");

    $router = new RouterController();
    $router->process(array($_SERVER['REQUEST_URI']));

    $router->renderView();
?>