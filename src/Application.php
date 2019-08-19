<?php
declare(strict_types=1);

namespace PhpCircle\Framework;

use PhpCircle\Framework\Routing\Router;

class Application
{
    /**
     * @var \PhpCircle\Framework\Routing\RouterInterface
     */
    public $router;

    /**
     * Application constructor.
     */
    public function __construct()
    {
        $this->router = new Router();
    }

    /**
     * Description here
     *
     * @return void
     */
    public function run(): void
    {
        dump('Application run...');
    }
}
