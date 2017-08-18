<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Candidatesearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="candidate-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <?php
         $list = [0 => 'PHP', 1 => 'MySQL', 2 => 'Javascript'];
         $list2 = ['test1' => 'test1'];
    ?>
    <?= $form->field($model, 'location')->checkboxlist($list2);?>

    <?= $form->field($model, 'candidate_id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'email_id') ?>

    <?= $form->field($model, 'mobile_number') ?>

    <?php // $form->field($model, 'location') ?>

    <?php // echo $form->field($model, 'experience') ?>

    <?php // echo $form->field($model, 'resume') ?>

    <?php // echo $form->field($model, 'skills') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
