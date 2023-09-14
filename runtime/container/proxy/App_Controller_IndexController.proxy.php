<?php

declare (strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
namespace App\Controller;

class IndexController extends AbstractController
{
    use \Hyperf\Di\Aop\ProxyTrait;
    use \Hyperf\Di\Aop\PropertyHandlerTrait;
    function __construct()
    {
        if (method_exists(parent::class, '__construct')) {
            parent::__construct(...func_get_args());
        }
        $this->__handlePropertyHandler(__CLASS__);
    }
    public function index()
    {
        $user = $this->request->input('user', 'Hyperf');
        $method = $this->request->getMethod();
        $time_start = microtime(true);
        $parallel = new \Hyperf\Coroutine\Parallel();
        $parallel->add(function () {
            sleep(2);
            //return \Hyperf\Coroutine\Coroutine::id();
        });
        $parallel->add(function () {
            sleep(2);
            //return \Hyperf\Coroutine\Coroutine::id();
        });
        // $result is [1, 2]
        $result = $parallel->wait();
        $time_end = microtime(true);
        $time = $time_end - $time_start;
        return ['method' => $method, 'message' => $time . " segundo(s)."];
    }
}