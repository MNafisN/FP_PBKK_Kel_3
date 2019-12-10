<?php

$router = $di->getRouter();

// Define your routes here
$router->add(
    'login/check',
    [
        'controller'    => 'login',
        'action'        => 'check'
    ]
);

$router->handle();
