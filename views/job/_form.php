<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Job */
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
            });
        });
    </script>

<div class="job-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true,'class'=>'search-field']) ?>
    
    <?= $form->field($model, 'description')->textarea(['rows' => 3,'cols'=>40,'class'=>'WYSIWYG','spellcheck'=>true]) ?>
    <br>
    
    Experience Minimum (years)

    <?= Html::activeDropDownList($model, 'experience_minimum',range(0,100),['class'=>'chosen-select-no-single']) ?>

    Experience Maximum (years)

    <?= Html::activeDropDownList($model, 'experience_maximun',range(0,100),['class'=>'chosen-select-no-single']) ?>
   
    <br></br>

    <?= $form->field($model, 'salary')->textInput(['class'=>'search-field']) ?>

    <?= $form->field($model, 'location')->textInput(['maxlength' => true,'class'=>'search-field', 'id'=>'txtPlaces']) ?>

    <?= $form->field($model, 'industry')->textInput(['maxlength' => true,'class'=>'search-field']) ?>

     <?php 
                        $rows = (new \yii\db\Query())
                        ->select([new \yii\db\Expression("work_type_id, CONCAT(name) as fName")])
                        ->from('work_type')
                        ->orderBy('name')
                        ->all();

                        $data = ArrayHelper::map($rows, 'work_type_id', 'fName');

                        echo $form->field($model, "worktype")->dropDownList($data,['prompt'=>'Select Work Type']); ?>
    


     <?php if(!$model->isNewRecord)
     echo  $form->field($model, "status")->checkbox(['label'=>'Filled?']); ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Post' : 'Update', ['class' => $model->isNewRecord ? 'button big margin-top-5' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
