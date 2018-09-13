<?php

namespace Swoft\Swagger\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Swoft\Bean\Annotation\Bean;
use Swoft\Http\Message\Middleware\MiddlewareInterface;

/**
 * @Bean()
 * @uses      SwaggerMiddleware
 * @version   2018-07-26 16:04:26
 * @author    Marico <marico@marico.cn>
 * @copyright Copyright 2010-2017 Swoft software
 * @license   PHP Version 7.x {@link http://www.php.net/license/3_0.txt}
 */
class SwaggerMiddleware implements MiddlewareInterface
{
    /**
     * Process an incoming server request and return a response, optionally delegating
     * response creation to a handler.
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Server\RequestHandlerInterface $handler
     * @return \Psr\Http\Message\ResponseInterface
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        // 获取请求url
        $path = $request->getUri()->getPath();
        // 去除左 /
        $path = ltrim($path, '/');
        if (in_array($path, ['swagger', 'api'])) {
            return \response()->redirect('/swagger/');
        }
        // if path is swagger
        if (strpos($path, 'swagger') === 0) {
            // 判断是否为纯swagger，并且存在目录
            if ($path == 'swagger/' && \is_dir(\alias('@root/public/swagger'))) {
                // 返回html
                return \response()->withContent(file_get_contents(\alias('@root/public/swagger/index.html')));
            }
        }
        // 执行
        return $handler->handle($request);
    }
}