<?php
declare(strict_types=1);

namespace PhpCircle\Framework\Routing;

interface RouterInterface
{
    /**
     * Get method.
     *
     * @param string $uri
     * @param string $action
     *
     * @return \PhpCircle\Framework\Routing\RouterInterface
     */
    public function get(string $uri, string $action): RouterInterface;
}
