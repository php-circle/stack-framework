<?php
declare(strict_types=1);

use PhpCircle\Framework\Routing\RouterInterface;

return static function (RouterInterface $router) {
    $router->get('/users', App\Http\Handlers\UsersListHandler::class);
    $router->post('/users/{userId}', App\Http\Handlers\UserShowHandler::class);
    $router->post('/users', App\Http\Handlers\UserHandler::class);
};
