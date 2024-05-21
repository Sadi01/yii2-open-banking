<?php

namespace sadi01\openbanking\components\faraboom;

use common\models\OauthAccessTokens;
use sadi01\openbanking\components\BaseAuthentication;
use sadi01\openbanking\models\ObOauthClients;

class Authentication extends BaseAuthentication
{
    /**
     * @var ObOauthClients $client
     * */
    public static function getToken($client)
    {
        $scopes = is_array($scopes) ? implode(',', $scopes) : $scopes;
        $accessToken = ObOauthAccessTokens::find()->notExpire()->byClientId($client->client_id)->byScope($scopes)->one();
        $refreshToken = ObOauthRefreshTokens::find()->notExpire()->byClientId($client->client_id)->byScope($scopes)->one();

        if (!$accessToken instanceof OauthAccessTokens && !$refreshToken instanceof OauthRefreshTokens) {

            $body = array(
                'grant_type' => 'password',
                'username' => $client->username,
                'password' => $client->password,
            );

            $headers['App-Key'] = $client->add_on;
            $headers['Authorization'] = $client->add_on;
            $headers['Bank-Id'] = $client->add_on;
            $headers['CLIENT-DEVICE-ID'] = $client->add_on;
            $headers['CLIENT-IP-ADDRESS'] = $client->add_on;
            $headers['CLIENT-PLATFORM-TYPE'] = $client->add_on;
            $headers['CLIENT-USER-AGENT'] = $client->add_on;
            $headers['CLIENT-USER-ID'] = $client->add_on;
            $headers['Content-Type'] = $client->add_on;
            $headers['Device-Id'] = $client->add_on;
            $headers['Token-Id'] = $client->add_on;

            $response = \Yii::$app->apiClient->post($url,$param,$headers);
           // $response = $this->execute($path, $params, $headers);
            if ($response['status'] === 200) {
                $result = $response['body']->result;
                $accessToken = new OauthAccessTokens([
                    'access_token' => $result->access_token,
                    'token_type' => $result->token_type,
                    'expires_in' => time() + $result->expires_in,
                    'scope' => $result->scopes,
                ]);
                $accessToken->save();

                $refreshToken = new OauthRefreshTokens([
                    'refresh_token' => $result->refresh_token,
                    'expires_in' => time() + $result->expires_in,
                    'scope' => $result->scopes,
                ]);

                $refreshToken->save();

                return $accessToken->access_token;
            }
        } else if ($accessToken instanceof OauthAccessTokens) {
            return $accessToken->access_token;
        } else if ($refreshToken instanceof OauthRefreshTokens) {
            return $client->refreshToken($refreshToken);
        }

        return null;
    }

    public function refreshToken($refresh_token)
    {
        $path = $this->get_token_path('token');
        $params = array(
            'grant_type' => 'refresh_token',
            'refresh_token' => $refresh_token->refresh_token,
            'redirect_uri' => 'null',

        );

        $headers['Authorization'] = $refresh_token->add_on;
        $headers['Device-Id'] = $refresh_token->add_on;
        $headers['CLIENT-IP-ADDRESS'] = $refresh_token->add_on;
        $headers['CLIENT-PLATFORM-TYPE'] = $refresh_token->add_on;
        $headers['CLIENT-DEVICE-ID'] = $refresh_token->add_on;
        $headers['CLIENT-USER-ID'] = $refresh_token->add_on;
        $headers['CLIENT-USER-AGENT'] = $refresh_token->add_on;

        $response = \Yii::$app->apiClient->post($url,$param,$headers);
        if ($response['status'] === 200) {
            $result = $response['body']->result;
            $accessToken = new OauthAccessTokens([
                'access_token' => $result->access_token,
                'expires' => time() + $result->expires_in,
                'scope' => $result->scopes,
            ]);
            $accessToken->save();
            return $accessToken->access_token;
        }

        return null;
    }

}