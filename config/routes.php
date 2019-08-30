<?php
declare(strict_types=1);

use PhpCircle\Framework\Routing\RouterInterface;

return static function (RouterInterface $routes) {

    $routes->post('/user', App\Http\Handlers\UserHandler::class);
};
