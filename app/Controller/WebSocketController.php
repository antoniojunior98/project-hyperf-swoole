<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\SocketIOServer\Annotation\Event;
use Hyperf\SocketIOServer\Annotation\SocketIONamespace;
use Hyperf\SocketIOServer\BaseNamespace;
use Hyperf\SocketIOServer\Socket;
use Hyperf\Utils\Codec\Json;
use Hyperf\WebSocketServer\Context;

#[SocketIONamespace("/")]
class WebSocketController extends BaseNamespace
{
    /**
     * @param string $data
     */
    #[Event("event")]
    public function onEvent(Socket $socket, $data)
    {
    
        $sala = 'room'.Context::get('user.id');   
        // response
        return'Event Received: '. $sala;
    }

    /**
     * @param string $data
     */
    #[Event("join-room")]
    public function onJoinRoom(Socket $socket, $data)
    {
        $sala = 'room'.Context::get('user.id');  
        //$this->emit('event','There are '. count($socket->getAdapter()->clients($data)). "players in {$sala}");
       if( $data==$sala){
        // Add the current user to the room
            $socket->join($data);
        // Push to other users in the room (excluding the current user)
        //$socket->to($data)->emit('event', $socket->getSid(). "has joined {$data}");
        // Broadcast to everyone in the room (including the current user)
        
         }
    }

    /**
     * @param string $data
     */
    #[Event("say")]
    public function onSay(Socket $socket, $data)
    {
        $data = Json::decode($data);
        $sala = 'room1';
        if($data['room']==$sala){
            
            $socket->to($data['room'])->emit('event', $socket->getSid(). "say: {$data['message']}");
        }
    }
}