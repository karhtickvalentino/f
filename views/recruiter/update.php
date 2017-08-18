<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\module\recruiter\models\Recruiter */

$this->title = 'Update Recruiter: ' . $model->name;

?>
<div class="recruiter-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
