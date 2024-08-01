<?php

declare(strict_types=1);
/**
 * This file is part of Yunzhiyike
 */

namespace Yunzhiyike\ChatGpt;

use http\Exception\InvalidArgumentException;
use Yunzhiyike\ChatGpt\exception\ClassNotFoundException;
use Yunzhiyike\ChatGpt\service\GptV1;

/**
 * @property GptV1 $gptV1
 */
class ChatGptFactory
{
    protected array $alias = [
        'gptV1' => GptV1::class,
    ];

    protected array $providers = [];

    public function __get(string $name)
    {
        if (isset($this->providers[$name])) {
            return $this->providers[$name];
        }
        if (! isset($this->alias[$name])) {
            throw new InvalidArgumentException('Invalid alias name');
        }
        $className = $this->alias[$name];
        if (! class_exists($className)) {
            throw new ClassNotFoundException("Class '{$className}' not found");
        }
        $instance = new $className();
        $this->providers[$name] = $instance;
        return $instance;
    }

    public static function getInstance(): ChatGptFactory
    {
        return new static();
    }
}
