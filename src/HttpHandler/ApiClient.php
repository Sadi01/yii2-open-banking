<?php
namespace sadi01\openbanking\HttpHandler;

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
    public $maxRetries = 3; // Number of retries for failed requests
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

    public function get($url, $params = [], $headers = [])
    {
        $response = $this->sendRequest('GET', $url, $params, $headers);
        return $response;
    }

    public function post($url, $data = [], $headers = [])
    {
        return $this->sendRequest('POST', $url, $data, $headers);
    }

    public function put($url, $data = [], $headers = [])
    {
        return $this->sendRequest('PUT', $url, $data, $headers);
    }

    public function delete($url, $data = [], $headers = [])
    {
        return $this->sendRequest('DELETE', $url, $data, $headers);
    }

    private function sendRequest($method, $url, $data, $headers = [])
    {
        $attempt = 0;
        while ($attempt < $this->maxRetries) {
            $attempt++;
            try {
                $request = $this->client->createRequest()
                    ->setMethod($method)
                    ->setUrl($url)
                    ->setData($data);
                   // ->addHeaders(array_merge($this->defaultHeaders, $headers));

                $response = $request->send();
                $this->logRequest($method, $url, $data, $response);

                if ($response->isOk) {
                    return [
                        'success' => true,
                        'status' => $response->statusCode,
                        'data' => $response->data,
                    ];
                } else {
                    Yii::error("API request failed: " . $response->statusCode . ' - ' );
                  //  throw new ApiException('API request failed', $response->statusCode, $response->data);
                }
            } catch (Exception $e) {
                Yii::error("API request exception: " . $e->getMessage());
                if ($attempt >= $this->maxRetries) {
                    throw new NetworkException('Network error: ' . $e->getMessage(), null, null, 0, $e);
                }
            }
        }
    }

    private function logRequest($method, $url, $data, $response)
    {
        Yii::info([
            'method' => $method,
            'url' => $url,
            'data' => $data,
            'response' => $response->data,
            'status' => $response->statusCode,
        ], 'apiClient');
    }
}
