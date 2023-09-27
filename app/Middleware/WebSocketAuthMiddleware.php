<?php

declare(strict_types=1);

namespace App\Middleware;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface as HttpResponse;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Hyperf\WebSocketServer\Context;

class WebSocketAuthMiddleware implements MiddlewareInterface
{
    protected $container;
   protected $request;
   protected $response;

    public function __construct(ContainerInterface $container, HttpResponse $response, RequestInterface $request)
    {
        $this->container = $container;
        $this->response = $response;
        $this->request = $request;
    }

    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $params = $request->getQueryParams();
        Context::set('user.id', 1);
        $auth = false;
        
        if($auth == true){
            return $this->container->get(\Hyperf\HttpServer\Contract\ResponseInterface::class)->raw('Forbidden');
        }
        
        
        return $handler->handle($request);
    }
}
