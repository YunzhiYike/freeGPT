# freeGPT
免费chatGPT接口

# 使用方法
```php
<?php

declare(strict_types=1);
/**
 * This file is part of Yunzhiyike
 */

namespace Yunzhiyike\Test;

use PHPUnit\Framework\TestCase;
use Yunzhiyike\ChatGpt\ChatGptFactory;
use Yunzhiyike\ChatGpt\constans\GptV1Model;

/**
 * @internal
 * @coversNothing
 */
class TestA extends TestCase
{
    public function test()
    {
        $res = ChatGptFactory::getInstance()->gptV1->sendText('给我画一幅美丽的风景图', GptV1Model::GTP_4O, 'http://账号:密码@IP:端口');
        var_dump($res);
    }
}

```



[1️⃣ 支持站](https://github.com/LiLittleCat/awesome-free-chatgpt?tab=readme-ov-file)
