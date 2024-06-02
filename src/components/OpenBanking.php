<?php

namespace sadi01\openbanking\components;

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
        if (Yii::$app->has($platform) && method_exists(Yii::$app->$platform, $service)) {

            return Yii::$app->$platform->$service($body);

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
        return [
            'success' => false,
            'status' => '422',
            'errors' => $map
        ];
    }

}