<?php

namespace sadi01\openbanking\components\finnotech;

use sadi01\openbanking\components\OpenBanking;
use sadi01\openbanking\models\BaseOpenBanking;
use sadi01\openbanking\models\ObOauthClients;
use sadi01\openbanking\models\Finnotech as FinnotechBaseModel;
use Yii;

class Finnotech extends OpenBanking implements FinnotechInterface
{

    public $baseUrl = 'https://apibeta.finnotech.ir/';
    private $model;
    private $client;

    public function init()
    {
        parent::init();
        $this->model = new FinnotechBaseModel();

        $this->client = ObOauthClients::find()
            ->byClient(ObOauthClients::PLATFORM_FINNOTECH)
            ->one();
    }

    /**
     * @param array $data The data array containing:
     *     - string 'deposit_number' => The Deposit number value.
     * @return mixed The result of the processing.
     * */
    public function transfer($data)
    {
        if ($this->load($data, FinnotechBaseModel::SCENARIO_TRANSFER)) {
            return Yii::$app->apiClient->post(ObOauthClients::PLATFORM_FINNOTECH, BaseOpenBanking::FINNOTECH_TRANSFER, BaseOpenBanking::getUrl(BaseOpenBanking::FINNOTECH_TRANSFER, ['clientId' => $data['clientId'],'trackId' => $data['trackId']]), $data, $this->getHeaders());
        } else return $this->setErrors($this->model);
    }

}