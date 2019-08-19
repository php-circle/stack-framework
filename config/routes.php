<?php
declare(strict_types=1);

use PhpCircle\Framework\Application;

return static function (Application $app) {
    /** @var \PhpCircle\Framework\Routing\RouterInterface $routes */
    $routes = $app->router;

    $routes->get('/', 'UserController@index');
};
