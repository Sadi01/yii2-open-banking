<?php
namespace sadi01\openbanking;

use WebApplication;
use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\base\InvalidConfigException;

class Bootstrap implements BootstrapInterface
{

    public function bootstrap($app)
    {

        if (!isset($app->get('i18n')->translations['openBanking*'])) {
            $app->get('i18n')->translations['openBanking*'] = [
                'class' => PhpMessageSource::class,
                'basePath' => __DIR__ . '/messages',
                'sourceLanguage' => 'en-US',
                'fileMap' => [
                    'openBanking' => 'main.php',
                ],
            ];
        }

        $app->on(Application::EVENT_BEFORE_REQUEST, function () {
            Yii::$app->setComponents([
                'faraboom' => [
                    'class' => 'sadi01\openbanking\components\faraboom\Faraboom',
                ],
            ]);
        });

        Yii::$app->setComponents([
            'faraboom' => [
                'class' => 'sadi01\openbanking\components\faraboom\Faraboom',
            ],
        ]);


    }



}