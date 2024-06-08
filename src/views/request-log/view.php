<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\View;
use yii\web\YiiAsset;
use sadi01\openbanking\models\ObRequestLog;

/** @var View $this */
/** @var sadi01\openbanking\models\ObRequestLog $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('openBanking', 'Ob Request Logs'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
YiiAsset::register($this);
?>
<div class="ob-request-log-view card">
    <div class="card-header d-flex justify-content-between">
        <h3><?= Html::encode($this->title) ?></h3>
        <p>
            <?= Html::a(Yii::t('openBanking', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a(Yii::t('openBanking', 'Delete'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('openBanking', 'Are you sure you want to delete this item?'),
                    'method' => 'post',
                ],
            ]) ?>
        </p>
    </div>
    <div class="card-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                //  'id',
                [
                    'attribute' => 'client_id',
                    'value' => \sadi01\openbanking\models\BaseOpenBanking::itemAlias('Platform', $model->client_id),
                ],
                [
                    'attribute' => 'service_type',
                    'value' => \sadi01\openbanking\models\BaseOpenBanking::itemAlias('ServiceType', $model->service_type),
                ],
                'status',
                'message',
                'track_id',
                'slave_id',
                'url',
                [
                    'attribute' => 'headers',
                    'value' =>json_encode($model->headers),
                ],
                [
                    'attribute' => 'data',
                    'value' =>json_encode($model->data),
                ],
                [
                    'attribute' => 'response',
                    'value' =>json_encode($model->response),
                ],
                'created_at:datetime',
                [
                    'attribute' => 'created_by',
                    'value' => $model->createdBy->username,
                ]
            ],
        ]) ?>
    </div>
</div>