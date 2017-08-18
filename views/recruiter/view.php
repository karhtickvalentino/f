<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\module\recruiter\models\Recruiter */

$this->title = $model->name;

?>
<div class="recruiter-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->recruiter_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Home', '/recruiter/', ['class' => 'btn btn-primary']) ?>
       
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'recruiter_id',
            'name',
            'company_name',
            'email_id:email',
        ],
    ]) ?>

</div>
