<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Recruiter;

/* @var $this yii\web\View */
/* @var $searchModel app\models\jobsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jobs';

?>
<div class="job-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
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
            'description:ntext',
           // 'experience_minimum',
            // 'experience_maximun',
            // 'salary',
             'location',
             'industry',
            // 'created_on',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
