<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;
use Hyperf\SocketIOServer\Socket;
use Socket as GlobalSocket;

class IndexController extends AbstractController
{
    public function index()
    {
        //$user = $this->request->input('user', 'Hyperf');
        //$method = $this->request->getMethod();
    
        $socket = \Hyperf\Utils\ApplicationContext::getContainer()->get(\Hyperf\SocketIOServer\SocketIO::class);
        $socket->to('room1')->emit('event', "enviado pelo index para sala 1");
      
        return $this->response->json('teste')->withStatus(200);
    }
}
