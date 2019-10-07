<?php
declare(strict_types=1);

namespace PhpCircle\Framework;

use Exception;
use FastRoute\Dispatcher;
use FastRoute\RouteCollector;
use Illuminate\Container\Container;
use PhpCircle\Framework\Exception\RouteNotFoundException;
use PhpCircle\Framework\Routing\Router;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Diactoros\ServerRequestFactory;
use function FastRoute\simpleDispatcher;

class Application extends Container
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
        $this->bootRouter();
    }

    /**
     * Proposed implementation.
     *
     * @return void
     *
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function run(): void
    {
        $request = ServerRequestFactory::fromGlobals();
        $httpMethod = $request->getMethod();
        $uri = \trim($request->getUri()->getPath(), '/');

        try {
            $handlerClass = $this->dispatch($httpMethod, $uri);

            /** @var \Psr\Http\Server\RequestHandlerInterface $handler */
            $handler = $this->make($handlerClass);

            /** @var \Psr\Http\Message\ResponseInterface $response */
            $response = $handler->handle($request);

            // Do something with the response.

            echo $response->getBody();
        } catch (Exception $exception) {
            if ($exception instanceof RouteNotFoundException) {
                // TODO: Create an error handler to return correct structure.
                http_response_code($exception->getCode());
                echo (new JsonResponse($exception->getMessage(), $exception->getCode()))->getBody();
            }
        }
    }

    /**
     * Dispatch
     *
     * @param string $method
     * @param string $uri
     *
     * @return mixed
     */
    private function dispatch(string $method, string $uri)
    {
        $dispatcher = simpleDispatcher(function (RouteCollector $routeCollector) {
            foreach ($this->router->getRoutes() as $route) {
                /** @var \PhpCircle\Framework\Routing\Route $route */
                $routeCollector->addRoute($route->getMethod(), $route->getUri(), $route->getHandler());
            }
        });

        $routeInfo = $dispatcher->dispatch($method, $uri);

        switch ($routeInfo[0]) {
            case Dispatcher::NOT_FOUND:
                throw new RouteNotFoundException('Route not found');
                break;
            case Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case Dispatcher::FOUND:
                // return [$routeInfo[1], $routeInfo[2]];
                // Return only the handler
                return $routeInfo[1];
                break;
        }
    }

    /**
     * Create router instance.
     *
     * @return void
     */
    private function bootRouter(): void
    {
        $this->router = new Router($this);
    }
}
