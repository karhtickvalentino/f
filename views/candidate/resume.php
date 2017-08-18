 <?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

 


    <?php $form = ActiveForm::begin(); ?>
 <?= $form->field($model, 'resume')->fileInput() ?>
 <?= Html::a('Download', ['/candidate/download?id='.$model->candidate_id], ['class' => 'btn btn-primary']) ?>
  <?= Html::submitButton('upload',['class' =>  'btn btn-primary']) ?>
 <?php ActiveForm::end(); ?>
