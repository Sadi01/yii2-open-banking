<?php

namespace sadi01\openbanking\HttpHandler;

use Yii;
use yii\base\Component;
use yii\helpers\Json;
use yii\httpclient\Client;
use yii\httpclient\Exception;
use sadi01\openbanking\models\ObRequestLog;

class ApiClient extends Component
{
    public $baseUrl;
    public $defaultHeaders = [];
    public $maxRetries = 1;
    public $timeout = 30;

    private $client;

    public function init()
    {
        parent::init();
        $this->client = new Client([
            'baseUrl' => $this->baseUrl,
            'requestConfig' => [
                'format' => Client::FORMAT_JSON,
            ],
            'parsers' => [
                // configure options of the JsonParser, parse JSON as objects
                Client::FORMAT_JSON => [
                    'class' => 'yii\httpclient\JsonParser',
                    'asArray' => false,
                ]
            ],
            'responseConfig' => [
                'format' => Client::FORMAT_JSON,
            ],
        ]);
    }

    /**
     * @param int | string $clientId
     * @param int | string $serviceType
     * @param string $url
     * @param array $params
     * @param array $headers
     * */
    public function get($clientId, $serviceType, $url, $params = [], $headers = [])
    {
        $response = $this->sendRequest($clientId, $serviceType, 'GET', $url, $params, $headers);
        return $response;
    }

    public function post($clientId, $serviceType, $url, $data = [], $headers = [])
    {
        return $this->sendRequest($clientId, $serviceType, 'POST', $url, $data, $headers);
    }

    public function put($clientId, $serviceType, $url, $data = [], $headers = [])
    {
        return $this->sendRequest($clientId, $serviceType, 'PUT', $url, $data, $headers);
    }

    public function delete($clientId, $serviceType, $url, $data = [], $headers = [])
    {
        return $this->sendRequest($clientId, $serviceType, 'DELETE', $url, $data, $headers);
    }

    private function sendRequest($clientId, $serviceType, $method, $url, $data = [], $headers = [])
    {
        $attempt = 0;
        while ($attempt < $this->maxRetries) {
            $attempt++;
            try {
                $request = $this->client->createRequest()
                    ->setFormat($headers['Content-Type'] ?? Client::FORMAT_JSON)
                    ->setMethod($method)
                    ->setUrl($url)
                    ->setData($data)
                    ->addHeaders($headers);

                $response = $request->send();
                $this->logRequest($method, $url, $data, $response, $headers, $clientId, $serviceType);

                if ($response->isOk) {
                    return [
                        'success' => true,
                        'status' => $response->statusCode,
                        'data' => $response->data,
                    ];
                } else {
                    return [
                        'success' => false,
                        'status' => $response->statusCode,
                        'data' => $response->data
                    ];
                }
            } catch (Exception $e) {
                Yii::error("API request exception: " . $e->getMessage());
                if ($attempt >= $this->maxRetries) {
                    throw $e;
                }
            }
        }
    }


    private function logRequest($method, $url, $data, $response, $headers, $clientId, $serviceType)
    {
        $model = new ObRequestLog([
            'status' => $response->statusCode,
            'url' => $url,
            'method' => $method,
            'data' => $data ? $data : json_decode("{}"),
            'headers' => $headers ? $headers : json_decode("{}"),
            'response' => $response->data,
            'client_id' => $clientId,
            'service_type' => $serviceType,
            'message' => '',
            'track_id' => null,
            'slave_id' => 1,
        ]);

        $model->save();
    }
}
