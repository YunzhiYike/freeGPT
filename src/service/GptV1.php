<?php

declare(strict_types=1);
/**
 * This file is part of Yunzhiyike
 */

namespace Yunzhiyike\ChatGpt\service;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Yunzhiyike\ChatGpt\constans\GptV1Model;

class GptV1
{
    protected const URL = 'https://lite.icoding.ink/api/v1/gpt/message';

    protected const REQUEST_HEADER = [
        'Accept' => 'application/json, text/plain, */*',
        'Accept-Language' => 'zh,en-GB;q=0.9,en-US;q=0.8,en;q=0.7,zh-CN;q=0.6',
        'Cache-Control' => 'no-cache',
        'Content-Type' => 'application/json',
        'Pragma' => 'no-cache',
        'Referer' => 'https://lite.icoding.ink/',
        'Origin' => 'https://lite.icoding.ink',
        'Sec-CH-UA' => '"Not/A)Brand";v="8", "Chromium";v="126", "Google Chrome";v="126"',
        'Sec-CH-UA-Mobile' => '?0',
        'Sec-CH-UA-Platform' => '"macOS"',
        'Sec-Fetch-Dest' => 'empty',
        'Sec-Fetch-Mode' => 'cors',
        'Sec-Fetch-Site' => 'same-origin',
        'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
    ];

    protected Client $client;

    public function __construct()
    {
        $this->client = new Client(['timeout' => 60]);
    }

    public function sendText(string $text, string $model = GptV1Model::GTP_4O, string $proxy = ''): string
    {
        $data = [
            'model' => $model,
            'chatId' => '-1',
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $text,
                    'time' => date('Y/m/d H:i:s'),
                    'attachments' => [],
                ],
            ],
            'plugins' => [],
            'systemPrompt' => '',
            'temperature' => 0.5,
        ];
        $response = $this->client->post(
            self::URL,
            [
                RequestOptions::HEADERS => self::REQUEST_HEADER,
                RequestOptions::JSON => $data,
                'verify' => false,
                'proxy' => $proxy,
            ]
        );
        $data = $response->getBody()->getContents();
        $response = '';
        $lines = explode("\n", trim($data));
        foreach ($lines as $line) {
            if (str_starts_with($line, 'data: ')) {
                $pattern = '/data: "(.*?)"/';
                preg_match($pattern, $line, $matches);
                if (isset($matches[1])) {
                    $response .= $matches[1];
                }
            }
        }
        return $response;
    }
}
