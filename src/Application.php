<?php
declare(strict_types=1);

namespace PhpCircle\Framework;

use PhpCircle\Framework\Routing\Router;
use Zend\Diactoros\ServerRequestFactory;

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
     * Proposed implementation.
     *
     * @return void
     */
    public function run(): void
    {
        /** @var \Psr\Http\Message\ResponseInterface $handler */
        $response = $this->router->handle(ServerRequestFactory::fromGlobals());

        // Do something with the response.

        echo $response->getBody();
    }
}
