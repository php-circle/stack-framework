<?php
declare(strict_types=1);

namespace PhpCircle\Framework\Routing;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Router implements RouterInterface
{
    /**
     * @var mixed[]
     */
    private $routes;

    /**
     * Get method.
     *
     * @param string $uri
     * @param string $handler
     *
     * @return \PhpCircle\Framework\Routing\RouterInterface
     */
    public function get(string $uri, string $handler): RouterInterface
    {
        $this->routes[$uri] = [
            'handler' => $handler,
            'method' => 'GET'
        ];

        return $this;
    }

    /**
     * Post method.
     *
     * @param string $uri
     * @param string $handler
     *
     * @return \PhpCircle\Framework\Routing\RouterInterface
     */
    public function post(string $uri, string $handler): RouterInterface
    {
        $this->routes[$uri] = [
            'handler' => $handler,
            'method' => 'POST'
        ];

        return $this;
    }

    /**
     * Get route.
     *
     * @param string $uri
     *
     * @return string[]
     */
    public function getRoute(string $uri): array
    {
        return $this->routes[$uri] ?? [];
    }

    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $handlerClass = $this->getRoute($request->getUri()->getPath())['handler'];

        /** @var \Psr\Http\Server\RequestHandlerInterface $handler */
        $handler = new $handlerClass();

        return $handler->handle($request);
    }
}
