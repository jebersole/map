<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class GuzzleHelper {
    /**
     * Отправить запрос к РосРеестру на кадастровый записи
     *
     * @param array $cadNums Кадастровые номера
     * @return array поля для заполнения App\Cadastral
     */
    public static function getData($cadNums) {
        $baseUrl = 'http://pkk.bigland.ru/api/test/plots';
        $body = json_encode(
            [
                'collection' => [
                    'plots' => $cadNums
                ]
            ]
        );
        $client = new Client([
            'headers' => ['Content-Type' => 'application/json', 'Accept' => 'application/json'],
            'verify' => false,	// выключать SSL
        ]);
        
        $log = new Logger('guzzle');
        try {
            $log->pushHandler(new StreamHandler(storage_path('logs/guzzle.log'), Logger::DEBUG));
        } catch (\Exception $e) {
            \Log::critical('Cannot create log file for guzzle', [$e->getMessage()]);
            $log = \Log::getMonolog();
        }

        try {
            $log->info('GET', ['cadNums' => $cadNums]);
            $response = $client->request('GET', $baseUrl, ['body' => $body]);
        } catch (RequestException $e) {
            $resp = $e->getResponse();
            $body = $resp ? $resp->getBody() : null;
            $bodyContent = $body ? $body->getContents() : '';
            $err = $bodyContent ?: $e->getMessage();
            $err = strval($err);
            $respCode = $resp ? $resp->getStatusCode() : 0;
            $log->error('Guzzle get error (1a): '.$err, [
                'cadNums' => $cadNums,
                'e' => $e->getMessage(),
            ]);
            return [];
        } catch (\Exception $e) {
            $log->error('Guzzle get error (1b): '.$e->getMessage(), ['cadNums' => $cadNums]);
            return [];
        }
        
        $body = $response->getBody();
        $content = $body ? $body->getContents() : '';
        return json_decode($content, 1);
    }
}