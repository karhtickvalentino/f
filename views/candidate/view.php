<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Recruiter;
/* @var $this yii\web\View */
/* @var $model app\models\Job */

$this->title = $model->title;

?>
<div class="job-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            [
            'label' => 'Recruiter',
            'format'=>'raw',
            'value'=>function ($data1) {
                    
                  $roleLabel = Recruiter::find()->where(['=', 'recruiter_id', $data1->recruiter_id])->one();
                        if(!empty($roleLabel)){
                            return $roleLabel->name;
                        }
                        else{
                            return '-';
                        }
                    
                },

            ],
                        [
            'label' => 'Company',
            'format'=>'raw',
            'value'=>function ($data1) {
                    
                  $roleLabel = Recruiter::find()->where(['=', 'recruiter_id', $data1->recruiter_id])->one();
                        if(!empty($roleLabel)){
                            return $roleLabel->company_name;
                        }
                        else{
                            return '-';
                        }
                    
                },

            ],


            
            'title',
            'description:ntext',
            'experience_minimum',
            'experience_maximun',
            'salary',
            'location',
            'industry',
            'created_on',
        ],
    ]) ?>

</div>
