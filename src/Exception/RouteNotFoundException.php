<?php
declare(strict_types=1);

namespace PhpCircle\Framework\Exception;

use RuntimeException;
use Throwable;

final class RouteNotFoundException extends RuntimeException
{
    /**
     * RouteNotFoundException constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct($message = '', int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message ?? '', 404, $previous);
    }
}
