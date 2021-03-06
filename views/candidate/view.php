<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Recruiter;
use app\models\WorkType;
/* @var $this yii\web\View */
/* @var $model app\models\Job */

$this->title = 'Profile';

?>
<!-- Titlebar
================================================== -->
<div id="titlebar" class="resume">
	<div class="container">
		<div class="ten columns">
			<div class="resume-titlebar">
				<!-- <img src="/images/resumes-list-avatar-01.png" alt=""> -->
				<div class="resumes-list-content">
					<h4><?php echo $model->name; ?> <span><?php echo $model->role; ?></span></h4>
					<span class="icons"><i class="fa fa-map-marker"></i> <?php echo $model->location; ?></span>
					<span class="icons"><i class="ln ln-icon-Management"></i> <?php echo $model->experience; ?></span>
					<span class="icons"><a href="#"><i class="fa fa-link"></i> Website</a></span>
					<span class="icons"><a href="mailto:<?php echo $model->email_id;?>"><i class="fa fa-envelope"></i> <?php echo $model->email_id; ?></a></span>
					<div class="skills">
						<?php $sk1 = explode(",",$model['skills']); 
                            foreach ($sk1 as $sk2) {
                        ?>
                        <span><?php print_r($sk2); ?></span><?php } ?>
					</div>
					<div class="clearfix"></div>

				</div>
			</div>
		</div>
 
		<div class="six columns">
			<div class="two-buttons">

				<a href="/candidate/download?id=<?php echo $model->candidate_id; ?>" class="button"><i class="ln ln-icon-Download"></i> Resume</a>

				<a href="/candidate/update?id=<?php echo $model->candidate_id?>" class="button dark"><i class="fa fa-pencil"></i> Edit</a>


			</div>
		</div>

	</div>
</div>
<div class="container">

    <!-- Recent Jobs -->
	<div class="eight columns">
	<div class="padding-right">

		<h3 class="margin-bottom-15">About Me</h3>

		<p class="margin-reset">
			<?php echo $model->profile_summary; ?>
		</p>
		
		<br>	
		<p>
			<h4>Strengths And Achivements</h4>
		</p>
		<p>
			<?php echo $model->strengths_and_achivements; ?>
		</p>

		<br>
		<p>
			<h4>Languages known</h4>
		</p>
		<p>
			<?php echo $model->languages_spoken; ?>
		</p>

		<br>



	</div>
	</div>
<!-- Widgets -->
	<div class="eight columns">

		<h3 class="margin-bottom-20">Education</h3>

		<!-- Resume Table -->
		<dl class="resume-table">
			<dt>
				
				<strong><?php echo $model->education ?></strong>
			</dt>
			
		</dl>

		<h3 class="margin-bottom-20">Perefernce</h3>


		<!-- Resume Table -->
		<dl class="resume-table">
			<dt>
				
				<strong>Prefered Location</strong>
			</dt>
			<dd>
				<p><?php echo $model->worklocation ?></p>
			</dd>

			<dt>
				
				<strong>Prefered Work Type</strong>
			</dt>
			<dd>
				<p><?php 
					$type = WorkType::find()->where(['work_type_id'=>$model->worktype])->one();
					if($type)
				echo $type->name;
				else echo '--';	 ?></p>
			</dd>
			
		</dl>
		
			
			
		

	</div>


</div>
