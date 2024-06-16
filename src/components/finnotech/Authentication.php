<?php

namespace sadi01\openbanking\components\finnotech;

use sadi01\openbanking\models\BaseOpenBanking;
use Yii;
use sadi01\openbanking\models\ObOauthAccessTokens;
use sadi01\openbanking\models\ObOauthRefreshTokens;
use sadi01\openbanking\components\BaseAuthentication;
use sadi01\openbanking\models\ObOauthClients;
use yii\httpclient\Client;

class Authentication extends BaseAuthentication
{

    const OAUTH_URL = '/dev/v2/oauth2/token';

    /**
     * @var ObOauthClients $client
     * */
    public static function getToken($client)
    {
        $accessToken = ObOauthAccessTokens::find()->notExpire()->byClientId($client->client_id)->one();
        $refreshToken = ObOauthRefreshTokens::find()->notExpire()->byClientId($client->client_id)->one();

        if (!$accessToken instanceof ObOauthAccessTokens && !$refreshToken instanceof ObOauthRefreshTokens) {

            $body = array(
                'grant_type' => 'client_credentials',
                'nid' => $client->nid,
                'scopes' => 'oak:iban-inquiry:get',
            );
            // $headers['Content-Type'] = 'application/x-www-form-urlencoded';
            $headers['Content-Type'] = Client::FORMAT_JSON;
            $headers['Authorization'] = 'Basic ' . base64_encode($client->app_key . ':' . $client->app_password);
            $response = Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_GET_TOKEN, self::getUrl($client->base_url, self::OAUTH_URL), $body, $headers);
            if ($response['status'] == 200) {
                $result = $response['data']->result;
                $scopes = null;
                foreach ($result->scopes as $scope) {
                    $scopes .= $scope . ' ';
                }
                $accessToken = new ObOauthAccessTokens([
                    'access_token' => $result->value,
                    'client_id' => (string)ObOauthClients::PLATFORM_FINNOTECH,
                    'user_id' => Yii::$app->user->id,
                    'expires' => date('Y-m-d H:i:s', time() + ($result->lifeTime / 1000)),
                    'scope' => $scopes,
                ]);
                if (!$accessToken->save()) {
                    print_r($accessToken->errors);
                    die;
                }
                $refreshToken = new ObOauthRefreshTokens([
                    'refresh_token' => $result->refreshToken,
                    'user_id' => Yii::$app->user->id,
                    'client_id' => (string)ObOauthClients::PLATFORM_FINNOTECH,
                    'expires' => date('Y-m-d H:i:s', time() + ($result->lifeTime / 1000)),
                    'scope' => $scopes,
                ]);
               /* $refreshToken->save();*/
                if (!$refreshToken->save()) {
                    print_r($refreshToken->errors);
                    die;
                }
                return $accessToken->access_token;
            }
        } else if ($accessToken instanceof ObOauthAccessTokens) {
            return $accessToken->access_token;
        } else if ($refreshToken instanceof ObOauthRefreshTokens) {
            return self::refreshToken($refreshToken, $client);
        }
        return null;
    }

    public function refreshToken($refresh_token, ObOauthClients $client)
    {
        $path = $this->get_token_path('token');
        $params = array(
            'grant_type' => 'refresh_token',
            'refresh_token' => $refresh_token->refresh_token,
            'bank' => $refresh_token->refresh_token,

        );
        $headers['Content-Type'] = 'application/json';
        $headers['Authorization'] = $client->app_key . ':' . $client->app_password;

        $response = Yii::$app->apiClient->post($url, $param, $headers);
        if ($response['status'] === 200) {
            $result = $response['body']->result;
            $accessToken = new ObOauthAccessTokens([
                'access_token' => $result->access_token,
                'expires' => time() + $result->lifeTime,
                'scope' => $result->scopes,
            ]);
            $accessToken->save();
            return $accessToken->access_token;
        }
        return null;
    }

    public static function getUrl($baseUrl, $url)
    {
        return 'https://apibeta.finnotech.ir' . $url;
    }
}