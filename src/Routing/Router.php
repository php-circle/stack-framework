<?php
declare(strict_types=1);

namespace PhpCircle\Framework\Routing;

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
     * @param string $action
     *
     * @return \PhpCircle\Framework\Routing\RouterInterface
     */
    public function get(string $uri, string $action): RouterInterface
    {
        return $this;
    }
}
