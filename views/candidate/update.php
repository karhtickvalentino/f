<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\module\candidate\models\Candidate */

$this->title = 'Update Candidate: ' . $model->name;


?>
<div class="candidate-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
