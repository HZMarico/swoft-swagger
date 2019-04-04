# Swoft-Swagger

> use swagger with [Swoft](https://github.com/swoft-cloud/swoft)

# How to use （Now）

> use with gitlab

```
1. add swoft/swagger in gitlab
2. modify composer.json
```

> use with self

```
1. Copy WorkerStartListener To app/Listeners && Modify Namespace

2. Copy SwaggerMiddleware To app/Middlewares && Modify Namespace

3. Add bootstrap code To bin/bootstrap.php
# under require_once

4. Copy public/swagger To public/swagger

5. Copy config/swagger to config/swagger

6. composer require zircote/swagger-php
# add swagger-php
```

# How to use 

> Modify `composer.json` （Future）

```
"require": {
    "swoft/swagger" : "dev-master"
}
```

> Modify `.env`, Add Configuration Item

```
AUTO_SWAGGER=true
```

> Add SwaggerMiddleware

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

> Start App

```
# Visit `http://hostName/swagger/`

Example : http://127.0.0.1/swagger/
Example : http://127.0.0.1/api
```

# Example

> Controller

```
/**
 * @SWG\Delete(
 *     path="/account/{id}",
 *     tags={"Account"},
 *     summary="Delete Account (Marico)",
 *     security={{"Authorization": {}}},
 *     @SWG\Parameter(name="id", in="path", required=true, type="number", default="1", description="autoId"),
 *     @SWG\Response(response="200", description="success", @SWG\Schema(ref="#/definitions/ReturnBody"))
 * )
 * @RequestMapping(route="{id}", method={RequestMethod::DELETE})
 *
 * @param Integer $id
 * @param Request $request
 *
 * @return array
 * @throws \Exception
 */
 public function delete(int $id, Request $request)
 {
    // 进行数据删除
    $this->accountLogic->delete($id);
    // 返回成功结果
    return Result::success();
}
```

# Precautions

> 目前此项目主要为我司内部使用，开源旨在给大家提供一个swagger融入swoft项目的思路

> 小弟学艺不精，暂时不知如何通过.env配置项，处理SwaggerMiddleware拦截器的动态启用禁用问题

> 目前SwaggerMiddleware拦截器会占用 /api /swagger /swagger/，若存在项目冲突，可自行修改

> 如果未来有幸被编入swoft官方拓展，此拓展使用方式会更加简单，目前，略微复杂

# Acknowledgments

> 基于Swoole的协程框架 [Swoft](https://github.com/swoft-cloud/swoft)

> 基于Swagger的PHP解析库 [zircote/swagger-php](https://github.com/zircote/swagger-php)
