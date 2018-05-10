<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\module\candidate\models\Candidate */
/* @var $form yii\widgets\ActiveForm */
?>
<style type="text/css">
    .pac-icon {
  width: 0;
  background-image: none;

}
.pac-container:after {
    /* Disclaimer: not needed to show 'powered by Google' if also a Google Map is shown */

    background-image: none !important;
    height: 0px;
}

</style>
<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDRhY5zBxFEA2iTm5C63hZSIgIbcRwyW28&libraries=places"></script>
<script type="text/javascript">
    var IsplaceChange = false;
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces'), { types: ['(cities)']});
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                var mesg = "Address: " + address;
                mesg += "\nLatitude: " + latitude;
                mesg += "\nLongitude: " + longitude;
                //alert(place);
                //console.log(place.name);
                IsplaceChange = true;
            });
        });
    </script>
<!--     <script type="text/javascript">
        google.maps.event.addDomListener(window, 'load', function () {
            var places = new google.maps.places.Autocomplete(document.getElementById('txtPlaces2'), { types: ['(cities)']});
            google.maps.event.addListener(places, 'place_changed', function () {
                var place = places.getPlace();
                var address = place.formatted_address;
                var latitude = place.geometry.location.lat();
                var longitude = place.geometry.location.lng();
                var mesg = "Address: " + address;
                mesg += "\nLatitude: " + latitude;
                mesg += "\nLongitude: " + longitude;
                //alert(place);
                //console.log(place.name);
            });
        });
    </script> -->
    

<div class="candidate-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true,'class'=>'input-text']) ?>


    <?= $form->field($model, 'profile_summary')->textarea(['rows' => 10,'cols'=>10,'spellcheck'=>true,'placeholder'=>'Brief description about you.']) ?>
    <br>
    
     
    <?= $form->field($model, 'role')->textarea(['rows' => 10,'cols'=>40,'spellcheck'=>true,'placeholder'=>'Role ex: sr.developer']) ?>
    <br>
    
         
    <?= $form->field($model, 'education')->textarea(['rows' => 10,'cols'=>40,'spellcheck'=>true,'placeholder'=>'Brief description about your education']) ?>
    <br>
    
    

    <?= $form->field($model, 'mobile_number')->textInput(['class'=>'input-text']) ?>
     
    
     <?= $form->field($model, 'location')->textInput(['id'=>'txtPlaces','class'=>'input-text'])->label('City') ?>

    <?= $form->field($model, 'experience')->textInput(['class'=>'input-text']) ?>

    <?= $form->field($model, 'skills')->textInput(['maxlength' => true,'placeholder'=>'seperate skills by comma','class'=>'input-text']) ?>

    <?= $form->field($model, 'strengths_and_achivements')->textarea(['rows' => 10,'cols'=>40,'spellcheck'=>true,'placeholder'=>'Brief description about strengths and achivements or links to your work']) ?>
    <br>
            
    <?= $form->field($model, 'languages_spoken')->textInput(['class'=>'input-text']) ?>

    <div class="form">

                   <?= $form->field($model, 'resume')->fileInput(['label class'=>'upload-btn']) ?>
                   <br><br>
    Note: Only files with these extensions are allowed: doc, docx, rtf, pdf.                
            </div>
<br>
    

    <!-- Notice -->
            <div class="notification notice closeable margin-bottom-40">
                <p><span> Preference-</span> Set your preference so employer can easily find you.</p>
            </div>
    
    

     <?php 
                        $rows = (new \yii\db\Query())
                        ->select([new \yii\db\Expression("work_type_id, CONCAT(name) as fName")])
                        ->from('work_type')
                        ->orderBy('name')
                        ->all();

                        $data = ArrayHelper::map($rows, 'work_type_id', 'fName');

                        echo $form->field($model, "worktype")->dropDownList($data,['prompt'=>'Select Work Type']); ?>
    
    <?= $form->field($model, 'worklocation')->textInput(['id'=>'txtPlaces3','class'=>'input-text']) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Continue' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
