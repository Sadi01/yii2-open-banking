<?php

use sadi01\openbanking\models\ObOauthClients;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\web\View;
use yii\data\ActiveDataProvider;
use sadi01\openbanking\models\ObOauthClientsSearch;
use yii\grid\GridView;
use yii\widgets\Pjax;

/** @var View $this */
/** @var sadi01\openbanking\models\ObOauthClientsSearch $searchModel */
/** @var ActiveDataProvider $dataProvider */

$this->title = Yii::t('openBanking', 'Ob Oauth Clients');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ob-oauth-clients-index card">
    <div class="card-header d-flex justify-content-between">
        <h3><?= Html::encode($this->title) ?></h3>
        <p>
            <?= Html::a(Yii::t('openBanking', 'Create Ob Oauth Clients'), ['create'], ['class' => 'btn btn-success']) ?>
        </p>
    </div>
    <div class="card-body">
        <?php Pjax::begin(); ?>
        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'id',
                'client_id',
                'base_url:url',
                'client_secret',
                'grant_types',
                //'scope',
                //'provider',
                //'username',
                //'password',
                //'add_on',
                [
                    'class' => ActionColumn::class,
                    'urlCreator' => function ($action, ObOauthClients $model, $key, $index, $column) {
                        return Url::toRoute([$action, 'id' => $model->id]);
                    }
                ],
            ],
        ]); ?>

        <?php Pjax::end(); ?>
    </div>
</div>