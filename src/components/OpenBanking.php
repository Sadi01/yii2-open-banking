<?php

namespace sadi01\openbanking\components;

use sadi01\openbanking\models\BaseOpenBanking;
use Yii;
use yii\base\Component;
use yii\base\NotSupportedException;

class OpenBanking extends Component implements OpenBankingInterface
{


    /**
     * Parameters:
     * string $platform
     * string $service
     * Returns:
     * array
     * */
    public function call($platform, $service, $body)
    {
        $mappedPlatform = BaseOpenBanking::itemAlias('PlatformMap',$platform);
        if (Yii::$app->has($mappedPlatform) && method_exists(Yii::$app->$mappedPlatform, $service)) {

            return Yii::$app->$mappedPlatform->$service($body);

        } else {
            throw new NotSupportedException('Operation not suported');
        }
    }

    protected function getUrl($platform, $service)
    {

    }

    protected function setErrors($errors)
    {
        $map = [];
        $key = 0;
        foreach ($errors as $item) {
            $map[$key]['code'] = 422;
            $map[$key]['message'] = $item[0];
            $map[$key]['value'] = null;
            $key++;
        }
        $response = new \stdClass();
        $response->success = false;
        $response->status = 422;
        $response->data = null;
        $response->errors = $map;

        return $response;
    }

}