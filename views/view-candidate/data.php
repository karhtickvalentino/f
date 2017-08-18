<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Job;
use sanex\simplefilter\SimpleFilter;
use yii\widgets\Pjax;

?>


<?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'name',
            
            'location',
             'experience',
            // 'resume',
             'skills',

            [  'class' => 'yii\grid\ActionColumn',
        //'contentOptions' => ['style' => 'width:260px;'],
        'header'=>'Actions',
        'template' => '{view} ',
            ]
           
        ],
    ]); ?>