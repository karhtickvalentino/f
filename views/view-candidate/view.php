<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\MySession;
use webvimark\modules\UserManagement\models\User;
use app\models\WorkType;

/* @var $this yii\web\View */
/* @var $model app\models\Candidate */

$this->title = $model->name;

?>
<!-- Titlebar
================================================== -->
<div id="titlebar" class="resume">
    <div class="container">
        <div class="ten columns">
            <div class="resume-titlebar">
                <img src="/images/resumes-list-avatar-01.png" alt="">
                <div class="resumes-list-content">
                    <h4><?php echo $model->name; ?><span><?php echo $model->role; ?></span></h4>
                    <span class="icons"><i class="fa fa-map-marker"></i><?php echo $model->location; ?></span>
                    
                    <span class="icons"><a href="#"><i class="fa fa-link"></i>-</a></span>
                   
                    <div class="skills">
                    <?php $sk1 = explode(",", $model->skills); 
                        foreach ($sk1 as $value) {
                    ?>
                        <span><?php echo $value; ?></span>
                        <?php } ?> 
                    </div>
                    <div class="clearfix"></div>

                </div>
            </div>
        </div>

        <div class="six columns">
            <div class="two-buttons">
                <?php 

                     $sql = "SELECT * FROM session where ((user_id = :userid) and (last_write ) > (:now - 1800))";           $command = Yii::$app->db->createCommand($sql);
                      $command->bindValue(':userid', $model->candidate_id);
                       $command->bindValue(':now', time());
                      $res=$command->queryAll();
                    if($res){  
                 ?>
                <a href="/message?id=<?php echo $model->candidate_id; ?>" class="button" ><i class="ln ln-icon-Speach-Bubble"></i> Chat</a>
                <?php } 
                    else {
                ?>
                 <a href="#" class="button" ><i class="ln ln-icon-Speach-Bubble"></i> Offline</a>
                 <?php }?>

                 <a href="/recruiter/download?id=<?php echo $model->candidate_id?>" class="button dark"><i class="fa fa-star"></i> Download Resume</a>


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
            
            <h3 class="margin-bottom-20">Perefernce</h3>
        </dl>

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
                else echo '--';  ?></p>
            </dd>
        </dl>
    </div>

</div>
