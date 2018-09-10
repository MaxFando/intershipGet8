<?php
use Phalcon\Mvc\Router;

$router = new Router();

$router->add(
    'post_detail/{title:[a-z\-]+}'
);