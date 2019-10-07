<?php
declare(strict_types=1);

use PhpCircle\Framework\Application;

require_once __DIR__ . '/../vendor/autoload.php';

(static function () {
    // Here for now...
    $whoops = new Whoops\Run;
    $whoops->prependHandler(new Whoops\Handler\PrettyPageHandler);
    $whoops->register();

    // Create application instance.
    $app = new Application();

    /**
     * @noinspection UsingInclusionReturnValueInspection
     *
     * Set routes
     */
    (require __DIR__ . '/../config/routes.php')($app->router);

    $app->run();
})();
