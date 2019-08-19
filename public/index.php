<?php
declare(strict_types=1);

use PhpCircle\Framework\Application;

require_once __DIR__ . '/../vendor/autoload.php';

(static function () {
    // Instantiate application
    $app = new Application();

    /**
     * @noinspection UsingInclusionReturnValueInspection
     *
     * Set routes
     */
    (require __DIR__ . '/../config/routes.php')($app);

    $app->run();
})();
