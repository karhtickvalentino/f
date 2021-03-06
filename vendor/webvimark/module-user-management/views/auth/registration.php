<?php

use webvimark\modules\UserManagement\UserManagementModule;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var webvimark\modules\UserManagement\models\forms\RegistrationForm $model
 */

$this->title = UserManagementModule::t('front', 'Registration');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-registration">

	<h2 class="text-center"><?= 'Step 1: '.$this->title ?></h2>

	<?php $form = ActiveForm::begin([
		'id'=>'user',
		'layout'=>'horizontal',
		'validateOnBlur'=>false,
	]); ?>

	<?php $model->type= '0'; ?>
						
				
	<?= $form->field($model, 'name')->textInput(['maxlength' => 50, 'autocomplete'=>'off', 'id' =>'regname' ,'autofocus'=>true,'class'=>'input-text']) ?>
	
    <?= $form->field($model, 'username')->textInput(['maxlength' => 50, 'id'=> 'regemail', 'autocomplete'=>'off', 'autofocus'=>true,'class'=>'input-text']) ?>

	<?= $form->field($model, 'mobile_number')->textInput(['maxlength' => 50, 'autocomplete'=>'off', 'autofocus'=>true,'class'=>'input-text']) ?>

	<?= $form->field($model, 'password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off','class'=>'input-text']) ?>

	<?= $form->field($model, 'repeat_password')->passwordInput(['maxlength' => 255, 'autocomplete'=>'off','class'=>'input-text']) ?>
	



	<div class="form-group" >
		<div class="col-sm-offset-3 col-sm-9" >
			<?= Html::submitButton(
				'<span class="glyphicon glyphicon-ok"></span> ' . UserManagementModule::t('front', 'Register'),
				['class' => 'btn btn-primary' ,'id'=>'reg-btn']
			) ?>
		</div>
	</div>

	<?php ActiveForm::end(); ?>

</div>
