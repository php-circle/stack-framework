<?php
declare(strict_types=1);

namespace PhpCircle\Framework\Routing;

class Route
{
    /**
     * @var string
     */
    private $handler;

    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $uri;

    /**
     * Route constructor.
     *
     * @param string $uri
     * @param string $method
     * @param string $handler
     */
    public function __construct(string $uri, string $method, string $handler)
    {
        $this->uri = $uri;
        $this->method = $method;
        $this->handler = $handler;
    }

    /**
     * @return string
     */
    public function getHandler(): string
    {
        return $this->handler;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return string
     */
    public function getUri(): string
    {
        return $this->uri;
    }
}
