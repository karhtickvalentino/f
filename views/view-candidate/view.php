<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\MySession;
use webvimark\modules\UserManagement\models\User;

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
                    <h4><?php echo $model->name; ?><span>UX/UI Graphic Designer</span></h4>
                    <span class="icons"><i class="fa fa-map-marker"></i><?php echo $model->location; ?></span>
                    
                    <span class="icons"><a href="#"><i class="fa fa-link"></i> Website</a></span>
                   
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
                <?php $q = MySession::find()->where(['user_id'=>$model->candidate_id])->one();
                //print_r($q);print_r($model->candidate_id);exit;
                    if($q){  $c = user::find()->where(['id' => $model->candidate_id])->one();
                 ?>
                <a href="#" class="button" onclick="chatWith('<?php echo $c->chatname; ?>')"><i class="ln ln-icon-Speach-Bubble"></i> Chat</a>
                <?php } 
                    else {
                ?>
                 <a href="#" class="button" ><i class="ln ln-icon-Speach-Bubble"></i> Offline</a>
                 <?php }?>

                <a href="#" class="button dark"><i class="fa fa-star"></i> Bookmark This Resume</a>


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
                <p><?php echo $model->worktype   ?></p>
            </dd>
        </dl>
    </div>

</div>
