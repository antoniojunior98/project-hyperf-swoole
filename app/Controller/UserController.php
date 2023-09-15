<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Model\User;

class UserController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $user = User::query()->where('id', 2)->first();
        return $response->json($user);
    }
}
