<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\module\recruiter\models\Recruitersearch */
/* @var $dataProvider yii\data\ActiveDataProvider */


?>
<div class="recruiter-index">

    
    
       <?= Html::a('Post Job','/job/create?rid='.$id, ['class' => 'btn btn-primary']) ?>
    
 
   
       
    <?= Html::a('My Jobs','/job/index?rid='.$id, ['class' => 'btn btn-primary']) ?>
    
 
   
    
        <?= Html::a('View Candidates', ['/view-candidate/index?rid='.$id], ['class' => 'btn btn-primary']) ?>
    
</div>
