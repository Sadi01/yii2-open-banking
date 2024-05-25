<?php

namespace sadi01\openbanking\HttpHandler;

use sadi01\openbanking\models\ObRequestLog;
use Yii;
use yii\base\Component;
use yii\httpclient\Client;
use yii\httpclient\Exception;
use common\exceptions\ApiException;
use common\exceptions\NetworkException;

class ApiClient extends Component
{
    public $baseUrl;
    public $defaultHeaders = [];
    public $maxRetries = 1;
    public $timeout = 30; // Request timeout in seconds

    private $client;

    public function init()
    {
        parent::init();
        $this->client = new Client([
            'baseUrl' => $this->baseUrl,
            'requestConfig' => [
                'format' => Client::FORMAT_JSON,
                //'timeout' => $this->timeout,
            ],
            'responseConfig' => [
                'format' => Client::FORMAT_JSON,
            ],
        ]);
    }

    public function get($url, $params = [], $headers = [], $clientId, $serviceType)
    {
        $response = $this->sendRequest('GET', $url, $params, $headers, $clientId, $serviceType);
        return $response;
    }

    public function post($url, $data = [], $headers = [], $clientId, $serviceType)
    {
        return $this->sendRequest('POST', $url, $data, $headers, $clientId, $serviceType);
    }

    public function put($url, $data = [], $headers = [], $clientId, $serviceType)
    {
        return $this->sendRequest('PUT', $url, $data, $headers, $clientId, $serviceType);
    }

    public function delete($url, $data = [], $headers = [], $clientId, $serviceType)
    {
        return $this->sendRequest('DELETE', $url, $data, $headers, $clientId, $serviceType);
    }

    private function sendRequest($method, $url, $data = [], $headers = [], $clientId, $serviceType)
    {
        $attempt = 0;
        while ($attempt < $this->maxRetries) {
            $attempt++;
            try {
                $request = $this->client->createRequest()
                    ->setFormat(isset($headers['Content-Type']) ? $headers['Content-Type'] : Client::FORMAT_JSON)
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

                    /*Yii::error("API request failed: " . $response->statusCode . ' - ' );
                    throw new \sadi01\openbanking\HttpHandler\ApiException('API request failed', $response->statusCode, $response->data);*/
                }
            } catch (Exception $e) {
                Yii::error("API request exception: " . $e->getMessage());
                if ($attempt >= $this->maxRetries) {
                    throw new NetworkException('Network error: ' . $e->getMessage(), null, null, 0, $e);
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
            'data' => json_encode($data, JSON_UNESCAPED_UNICODE),
            'headers' => json_encode($headers, JSON_UNESCAPED_UNICODE),
            'response' => json_encode($response->data, JSON_UNESCAPED_UNICODE),
            'client_id' => $clientId,
            'service_type' => $serviceType,
            'message' => '',
            'transaction_id' => null,
        ]);

        if (!$model->save()) {
            print_r($model->errors);
            die;
        }
    }
}
