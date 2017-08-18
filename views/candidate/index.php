<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Recruiter;

/* @var $this yii\web\View */
/* @var $searchModel app\module\candidate\models\Candidatesearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?= Yii::$app->session->getFlash('success') ?>


 <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
             [
                'label'    =>    'Company',
                'format'=>'raw',
                    'value' => function($data1){
                        $roleLabel = Recruiter::find()->where(['=', 'recruiter_id', $data1->recruiter_id])->one();
                        if(!empty($roleLabel)){
                            return $roleLabel->company_name;
                        }
                        else{
                            return '-';
                        }
                    }
            ],
           'title',
           [
            'label' => 'min experience',
            'format'=>'raw',
             'headerOptions' => ['style' => 'max-width:100px;','class'=>'text-center headerColor'],
               'contentOptions' => ['class' => 'text-center'],
            'value'=>'experience_minimum'

            ],
            [
            'label' => 'max experience',
            'format'=>'raw',
             'headerOptions' => ['style' => 'max-width:100px;','class'=>'text-center headerColor'],
               'contentOptions' => ['class' => 'text-center'],
            'value'=>'experience_maximun'

            ],
            
            'salary',
             
             'industry',

            [  'class' => 'yii\grid\ActionColumn',
        //'contentOptions' => ['style' => 'width:260px;'],
        'header'=>'Actions',
        'template' => '{view} ',
            ]
           
        ],
    ]); ?>