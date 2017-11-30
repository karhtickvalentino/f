<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\recruiter\models\Recruiter */

$this->title = $model->name;

?>
<div class="container">

   

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->recruiter_id], ['class' => 'button']) ?>
        
        
       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            'company_name',
            'designation',
            'email_id:email',
            'mobile_number',

        ],
    ]) ?>

</div>
