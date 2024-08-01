<?php

declare(strict_types=1);
/**
 * This file is part of Yunzhiyike
 */

namespace Yunzhiyike\ChatGpt\service;

use GuzzleHttp\RequestOptions;
use stdClass;
use Yunzhiyike\ChatGpt\Request;

class GptV1
{
    public const URL = 'https://itulpl.aitianhu1.top/api/please-donot-reverse-engineering-me-thank-you';
    public const REQUEST_HEADER = [
        'Accept' => 'application/json, text/plain, */*',
        'Accept-Language' => 'zh,en-GB;q=0.9,en-US;q=0.8,en;q=0.7,zh-CN;q=0.6',
        'Cache-Control' => 'no-cache',
        'Content-Type' => 'application/json',
        'Cookie' => 'sl-session=MHWZM6V5rGadTeyYA8rArA==; sl_jwt_session=nm+dMT42q2YqHwOxpw5bcg==; cdn=aitianhu; SERVERID=srv99n4|Zqsoj',
        'Origin' => 'https://itulpl.aitianhu1.top',
        'Pragma' => 'no-cache',
        'Priority' => 'u=1, i',
        'Referer' => 'https://itulpl.aitianhu1.top/',
        'Sec-CH-UA' => '"Not/A)Brand";v="8", "Chromium";v="126", "Google Chrome";v="126"',
        'Sec-CH-UA-Mobile' => '?0',
        'Sec-CH-UA-Platform' => '"macOS"',
        'Sec-Fetch-Dest' => 'empty',
        'Sec-Fetch-Mode' => 'cors',
        'Sec-Fetch-Site' => 'same-origin',
        'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
    ];

    protected Request $request;

    public function __construct()
    {
        $this->request = new Request(60);
    }

    public function sendText(string $text, string $proxy = ''): void
    {
        $data = [
            'prompt' => "{$text}\n",
            'options' => new stdClass(),
            'model' => 'gpt-3.5-turbo',
            'OPENAI_API_KEY' => 'sk-AItianhuFreeForEveryone',
            'systemMessage' => "You are an AI assistant, a large language model trained. Follow the user's instructions carefully. Respond using markdown.",
            'temperature' => 0.8,
            'top_p' => 1,
        ];
        $response = $this->request->post(
            self::URL,
            [
                RequestOptions::HEADERS => self::REQUEST_HEADER,
                RequestOptions::JSON => $data,
                'verify' => false,
                'proxy' => $proxy,
            ]
        );
        var_dump($response->getBody()->getContents());
    }
}
