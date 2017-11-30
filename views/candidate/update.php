<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\module\candidate\models\Candidate */

$this->title = 'Profile : ' . $model->name;


?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
