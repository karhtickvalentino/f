<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Candidate */

$this->title = $model->name;

?>
<div class="candidate-view">

    <h1><?= Html::encode($this->title) ?></h1>



    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'email_id:email',
            'mobile_number',
            'location',
            'experience',
             [
            'label'    =>    'resume',
            'format'=>'raw',
                'value' => function($data1){
                                          $request = Yii::$app->request;
            
                    $rolemapid = $request->get('candidate_id');
                    $url = '/candidate/download?id='.$data1->candidate_id;
                     //print_r($url);
                     // exit;
                        return Html::a( "Download",$url );
                          
                    }
            ],
            'skills',
        ],
    ]) ?>

</div>
