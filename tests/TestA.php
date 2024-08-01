<?php

declare(strict_types=1);
/**
 * This file is part of Yunzhiyike
 */

namespace Yunzhiyike\Test;

use PHPUnit\Framework\TestCase;
use Yunzhiyike\ChatGpt\ChatGptFactory;

/**
 * @internal
 * @coversNothing
 */
class TestA extends TestCase
{
    public function test()
    {
       ChatGptFactory::getInstance()->gptV1->sendText("你好吗？");
    }
}
