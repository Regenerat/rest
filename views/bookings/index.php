<?php

use app\models\Bookings;
use app\models\Roles;
use app\models\Status;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var app\models\BookingsSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Bookings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="bookings-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Bookings', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'table',
            'date',
            'time',
            'status',
            [
                'attribute' => 'Сменить статус',
                'visible' => (Yii::$app->user->identity->role_id == Roles::ADMIN_ROLE ? true : false),
                'format' => 'raw',
                'value' => function($model) {
                    if($model->status_id == Status::NEW_STATUS){
                        $html = Html::beginForm(Url::to(['update', 'id' => $model->id]));
                        $html .= Html::activeDropDownList($model, 'status_id', [
                            '2' => 'Принять',
                            '3' => 'Отклонить',
                        ]);
                        $html .= Html::submitButton('Save', ['class' => 'btn btn-success']);
                        return $html;
                    }
                    return "";
                }
            ],
        ],
    ]); ?>


</div>
