<?php

use yii\helpers\Html;
use yii\grid\GridView;
use dosamigos\datepicker\DatePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\FeedbackSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Сообщения от ' . $email;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="feedback-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            [
                'attribute'         => 'name',
                'filter'            => false,
            ],
            [
                'attribute'         => 'email',
                'format'            => 'email',
                'headerOptions'     => ['width' => '250px'],
                'filter'            => false,
            ],
            [
                'attribute'         => 'created_at',
                'format'            => ['date', 'dd.MM.YYYY'],
                'headerOptions'     => ['width' => '250px'],
                'filter'            => DatePicker::widget([
                                        'model' => $searchModel,
                                        'attribute' => 'created_at',
                                        'language' => 'ru',
                                        'template' => '{addon}{input}',
                                            'clientOptions' => [
                                                'autoclose' => true,
                                                'format' => 'yyyy-mm-dd'
                                            ]
                                    ])
            ],
            [
                'attribute'         => 'message',
                'format'            => 'ntext',
                'filter'            => false
            ],
            //['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
