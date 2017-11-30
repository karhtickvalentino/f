<?php 
use app\models\WorkType;
use app\models\Recruiter;
use app\models\Mysession;
use webvimark\modules\UserManagement\models\User;
$rec = Recruiter::find()->where(['=', 'recruiter_id', $model->recruiter_id])->one();
?>
<!-- Titlebar
================================================== -->
<div id="titlebar" class="photo-bg" style="background: url(/images/job-page-photo.jpg)">
	<div class="container">
		<div class="ten columns">
			<span><a href="#" id="empbtn"><?php echo $rec->company_name ?></a></span>
			<h2><?php echo $model->title?><span class="<?php 
                $role_label = WorkType::find()->where(['=', 'work_type_id', $model->worktype])->one();
                        if($role_label)
                        echo $role_label->name;
                        else echo '--'; ?>"><?php 
                $role_label = WorkType::find()->where(['=', 'work_type_id', $model->worktype])->one();
                        if($role_label)
                        echo $role_label->name;
                        else echo '--'; ?></h2></span>
		</div>

		<div class="six columns">
			<?php 
				$status = Mysession::find()->where(['user_id'=>$rec->recruiter_id])->one();
				if($status){
				$c = user::find()->where(['id' => $rec->recruiter_id])->one();
			?>
			<a href="#" class="button" onclick="chatWith('<?php echo $c->chatname; ?>')"><i class="ln ln-icon-Speach-Bubble"></i> Chat</a>
			<?php }?>
		</div>

	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	
	<!-- Recent Jobs -->
	<div class="eleven columns">
	<div class="padding-right">
		
		<!-- Company Info -->
		<div class="company-info">
			<img src="/images/company-logo.png" alt="">
			<div class="content">
				<h4><?php 
                
                        if($rec)
                        echo $rec->name;
                        else echo '--'; ?></h4>
				<span><a href="#"><i class="fa fa-link"></i> -</a></span>
				<span><a href="#"><i class="fa fa-twitter"></i> - </a></span>
			</div>
			<div class="clearfix"></div>
		</div>

		<p class="margin-reset">
		<?php 
		echo $model->description;
		?>
		</p>
		<br>
		<div class="clearfix"></div>
		<div id="emp">
		<p><strong>About Employer</strong></p>
		<p>
			<?php 
				echo "Name : ".$rec->name."<br>";
				if($rec->company_name)
				echo "Company Name : ".$rec->company_name."<br>";
				if($rec->designation)
				echo "Designation : ".$rec->designation."<br>";
			?>
		</p>
	</div>
	</div>
	</div>


	<!-- Widgets -->
	<div class="five columns">

		<!-- Sort by -->
		<div class="widget">
			<h4>Overview</h4>

			<div class="job-overview">
				
				<ul>
					<li>
						<i class="fa fa-map-marker"></i>
						<div>
							<strong>Location:</strong>
							<span><?php echo $model->location;?></span>
						</div>
					</li>
					<li>
						<i class="fa fa-user"></i>
						<div>
							<strong>Job Title:</strong>
							<span><?php echo $model->title; ?></span>
						</div>
					</li>

					<li>
						<i class="fa fa-money"></i>
						<div>
							<strong>Rate / Salary:</strong>
							<span><?php echo $model->salary ?></span>
						</div>
					</li>
				</ul>
				<?php 
					if($status){
				?>
				<a href="#" class="button" onclick="chatWith('<?php echo $rec->name; ?>')"><i class="ln ln-icon-Speach-Bubble"></i> Chat</a>
				<?php 
					}
					else { 
				?><a href="#" class="button" style="background-color: rgb(229, 229, 229) !important;color: #666666;cursor: not-allowed;pointer-events:none;" ><i class="ln ln-icon-Speach-Bubble"></i> Offline</a>
				<?php } ?>
			</div>

		</div>

	</div>
	<!-- Widgets / End -->


</div>
<?php
$js='$("#empbtn").click(function() {
    $("html, body").animate({
        scrollTop: $("#emp").offset().top
    }, 500);
});';
$this->registerJs($js);
?>