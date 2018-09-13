# swoft-swagger

> use swagger with [Swoft](https://github.com/swoft-cloud/swoft)

# 使用方法

> 1. Modify `composer.json`

```
"require": {
    "hzmarico/swoft-swagger" : "dev-master"
}
```

> 2. Modify `.env`, Add Configuration Item

```
AUTO_SWAGGER=true
```

> 3. Add SwaggerMiddleware

```
# config file : `config/beans/base.php`
return [
    'serverDispatcher' => [
        'middlewares' => [
            \Swoft\Swagger\Middleware\SwaggerMiddleware::class,
        ]
    ],
]
```

> 4. Start App

```
# Visit `http://hostName/swagger/`

Example : http://127.0.0.1/swagger/
Example : http://127.0.0.1/api
```

# 注意事项

> 目前此项目主要为我司内部使用，开源旨在给大家提供一个swagger融入swoft项目的思路

> 小弟学艺不精，暂时不知如何通过.env配置项，处理SwaggerMiddleware拦截器的动态启用禁用问题

> 目前SwaggerMiddleware拦截器会占用 /api /swagger /swagger/，若存在项目冲突，可自行修改

# 鸣谢

> 基于Swoole的协程框架 [Swoft](https://github.com/swoft-cloud/swoft)

> 基于Swagger的PHP解析库 [zircote/swagger-php](https://github.com/zircote/swagger-php)