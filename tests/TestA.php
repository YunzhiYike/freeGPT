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
        $res = ChatGptFactory::getInstance()->gptV1->sendText('给我画一幅美丽的风景图');
        var_dump($res);
    }
}
