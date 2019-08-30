<?php
declare(strict_types=1);

namespace PhpCircle\Framework\Routing;

use Psr\Http\Server\RequestHandlerInterface;

interface RouterInterface extends RequestHandlerInterface
{
    /**
     * Get method.
     *
     * @param string $uri
     * @param string $handler
     *
     * @return \PhpCircle\Framework\Routing\RouterInterface
     */
    public function get(string $uri, string $handler): RouterInterface;

    /**
     * Post method.
     *
     * @param string $uri
     * @param string $handler
     *
     * @return \PhpCircle\Framework\Routing\RouterInterface
     */
    public function post(string $uri, string $handler): RouterInterface;
}
