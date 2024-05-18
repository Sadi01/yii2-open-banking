<?php
namespace sadi01\openbanking\components;

use Yii;
use yii\base\Component;
use yii\base\NotSupportedException;

class OpenBanking extends Component implements OpenBankingInterface
{

    /**
    Parameters:
    string $platform
    string $service
    Returns:
    array
     * */
    public function call($platform, $service, $body)
    {
        if (Yii::$app->has($platform) && method_exists(Yii::$app->$platform, $service)) {

            Yii::$app->$platform->$service($body);

        } else {
            throw new NotSupportedException('Operation not suported');
        }
    }

}