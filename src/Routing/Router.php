<?php
declare(strict_types=1);

namespace PhpCircle\Framework\Routing;

use App\Http\Handlers\UserHandler;
use Illuminate\Contracts\Container\Container;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class Router implements RouterInterface
{
    /**
     * @var \Illuminate\Contracts\Container\Container
     */
    private $app;

    /**
     * @var \SplStack
     */
    private $routes;

    /**
     * Router constructor.
     *
     * @param \Illuminate\Contracts\Container\Container $app
     */
    public function __construct(Container $app)
    {
        $this->app = $app;
        $this->routes = new \SplStack();
    }

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
        $uri = trim($uri, '/');
        // if (\array_key_exists($uri, $this->routes) === true) {
        //     $this->routes[$uri]['GET'] = [
        //         'handler' => $handler
        //     ];
        //
        //     return $this;
        // }
        //
        // $this->routes[$uri] = [
        //     'GET' => ['handler' => $handler]
        // ];

        $this->addRoute($uri, 'GET', $handler);

        return $this;
    }

    /**
     * Get route.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return string[]
     */
    public function getRoute(ServerRequestInterface $request): array
    {
        $path = \trim($request->getUri()->getPath(), '/');

        $dynamicUri = false;

        // if () {
        //
        // }

        dd($path);
    }

    /**
     * @return \SplStack
     */
    public function getRoutes(): \SplStack
    {
        return $this->routes;
    }

    /**
     * Handles a request and produces a response.
     *
     * May call other collaborating code to generate the response.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $handlerClass = $this->getRoute($request)['handler'];

        /** @var \Psr\Http\Server\RequestHandlerInterface $handler */
        $handler = $this->app->make($handlerClass);

        return $handler->handle($request);
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
        $uri = trim($uri, '/');

        // if (\array_key_exists($uri, $this->routes) === true) {
        //     $this->routes[$uri]['POST'] = [
        //         'handler' => $handler
        //     ];
        //
        //     return $this;
        // }
        //
        // $this->routes[$uri] = [
        //     'POST' => ['handler' => $handler]
        // ];

        $this->addRoute($uri, 'POST', $handler);

        return $this;
    }

    /**
     * Add new route to the stack.
     *
     * @param string $uri
     * @param string $method
     * @param string $handler
     *
     * @return void
     */
    private function addRoute(string $uri, string $method, string $handler): void
    {
        $this->routes->push(new Route($uri, $method, $handler));
    }
}
