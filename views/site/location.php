<?php 
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
    <div class="container">
        <div id="search_wrapper">
         <div id="search_form" class="clearfix">
         <h1>Start your job search</h1>
            <p>
            <?php $form = ActiveForm::begin() ?>
            <div class="row">
            <div class="col-sm-3">
              <?= $form->field($model, 'location')->textInput(['autofocus' => true]) ?>
            
             <label class="btn2 btn-2 btn2-1b"><input type="submit" value="Find Jobs"></label>
             </div>
             </div>
            </p>
           <?php ActiveForm::end(); ?>
         </div>
        
       </div>
   </div> 
 