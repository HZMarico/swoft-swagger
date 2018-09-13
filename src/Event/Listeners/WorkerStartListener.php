<?php

namespace Swoft\Swagger\Event\Listeners;

use Swoole\Server;
use Swoft\Bootstrap\SwooleEvent;
use Swoft\Bean\Annotation\ServerListener;
use Swoft\Bootstrap\Listeners\Interfaces\WorkerStartInterface;
use Swoole\Coroutine as Co;

/**
 * Worker start listener
 *
 * @ServerListener(event={
 *     SwooleEvent::ON_WORKER_START
 * })
 */
class WorkerStartListener implements WorkerStartInterface
{
    /**
     * @param Server $server
     * @param int $workerId
     * @param bool $isWorker
     */
    public function onWorkerStart(Server $server, int $workerId, bool $isWorker)
    {
        // is worker 0 and open AUTO_REGISTER
        if (0 == $workerId && env('AUTO_SWAGGER', false)) {
            go(function() {
                // 新路径
                $folder = \alias('@root/public/swagger');
                // 判断是否存在public swagger
                if (!\is_dir($folder)) {
                    // 原路径
                    $copyFolder = dirname(dirname(dirname(__DIR__))).'/public/swagger';
                    // 判断目录是否存在
                    if (!\is_dir($copyFolder)) {
                        throw new \Exception('swagger folder missing.', 404);
                    }
                    // 复制文件
                    Co::exec("cp -r $copyFolder $folder");
                }
                // 判断是否存在目录
                if (\is_dir($folder)) {
                    // 新路径
                    $bin = \alias('@root/vendor/bin/swagger');
                    // 执行
                    Co::exec("$bin -o $folder -e vendor");
                }
            });
        }
    }
}