<?php
declare(strict_types=1);

namespace App\Http\Handlers;

use PhpCircle\Framework\Exception\RouteNotFoundException;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class UserHandler implements RequestHandlerInterface
{
    /**
     * Handles a request and produces a response.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = \json_decode((string)$request->getBody(), true);

        throw new RouteNotFoundException('dfsdfsdf');

        return new JsonResponse($data);
    }
}
