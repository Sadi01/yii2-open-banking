<?php

use sadi01\openbanking\models\ObRequestLog;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\web\View;
use yii\data\ActiveDataProvider;
use sadi01\openbanking\models\ObRequestLogSearch;
use common\widgets\grid\GridView;
use yii\widgets\Pjax;

/** @var View $this */
/** @var sadi01\openbanking\models\ObRequestLogSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */

$this->title = Yii::t('openBanking', 'Ob Request Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ob-request-log-index card">
    <div class="card-header d-flex justify-content-between">
        <h3><?= Html::encode($this->title) ?></h3>
    </div>
    <div class="card-body">
        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'export' => false,
            'headerRowOptions' => [
                'class' => 'table-light'
            ],
            'showCustomToolbar' => false,
            'tableOptions' => ['class' => ''],
            'bordered' => false,



           // 'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'client_id',
                'service_type',
                'status',
                'message',
                //'transaction_id',
                'url',
                //'request_info',
                //'response_info',
                //'created_at',
                //'created_by',
                [
                    'class' => 'common\widgets\grid\ActionColumn',
                    'contentOptions' => [
                        'class' => 'text-nowrap'
                    ],
                    'template' => '{view}',
                   // 'class' => ActionColumn::class,
                    'urlCreator' => function ($action, ObRequestLog $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</div>