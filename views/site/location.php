<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
    <div class="container">
    <?php $emoji='angry'; ?>
       <?= Html::img('@web/images/happy.png'); ?>
       <?= Html::img('@web/images/'.$emoji.'.png', ['style'=>'height:29px;width:29px;', 'class' => 'emojiIndex']); ?>
   </div> 
 