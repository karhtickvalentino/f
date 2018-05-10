<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Job;
use sanex\simplefilter\SimpleFilter;
use app\models\MySession;
use app\models\Candidate;
use app\models\WorkType;

?>


<!-- Recent Jobs -->
    <div class="eleven columns">
    <div class="padding-right">
        
       

        <ul class="job-list full">
       <?php
      foreach ($query as  $val) {
        if($status==1)
        {
            $sql = "SELECT * FROM session where ((user_id = :userid) and (last_write ) > (:now - 1800))";
                      $command = Yii::$app->db->createCommand($sql);
                      $command->bindValue(':userid', $val['recruiter_id']);
                      $command->bindValue(':now', time());
                      $res=$command->queryAll();
                     if($res) {
        ?>
           <li class="highlighted"><a href="/candidate/view-job?id=<?php echo $val['job_id'];?>" >
        <img src="/images/job-list-logo-01.png" alt="">
        <div class="job-list-content">
          <h4><?php print_r($val['title']); ?><span class="<?php 
                $role_label = WorkType::find()->where(['=', 'work_type_id', $val['worktype']])->one();
                        if($role_label)
                        echo $role_label->name;
                        else echo '--'; ?>"><?php  if($role_label)
                        echo $role_label->name;
                        else echo '--'; ?></span></h4>
           <?php 
           $sql = "SELECT * FROM session where ((user_id = :userid) and (last_write ) > (:now - 1800))";
                      //print_r($sql);exit;

                      $command = Yii::$app->db->createCommand($sql);
                      $command->bindValue(':userid', $val['recruiter_id']);
                       $command->bindValue(':now', time());
                      $res=$command->queryAll();
                     //$online = MySession::find()->where(['=','user_id',$val['recruiter_id']])->all();
                     if($res) {

                         echo '<div style="color:green;float:right">online-chat now</div>';
                     }
                     else
                      echo  '<div style="color:red;float:right">offline</div>';
                  ?>
          <div class="job-icons">
            <span><i class="fa fa-briefcase"></i> <?php print_r($val['industry']); ?></span>
            <span><i class="fa fa-map-marker"></i><?php print_r($val['location']); ?> </span>
            <span><i class="fa fa-money"></i><?php if(empty($val['salary']))echo 'salary not disclosed';else print_r($val['salary']); ?></span>
          </div>
        </div>
        </a>
        <div class="clearfix"></div>
      </li>

<?php  }} else {
    ?>
               <li class="highlighted"><a href="/candidate/view-job?id=<?php echo $val['job_id'];?>" >
        <img src="/images/job-list-logo-01.png" alt="">
        <div class="job-list-content">
          <h4><?php print_r($val['title']); ?><span class="<?php echo $val['worktype']; ?>"><?php echo $val['worktype']; ?></span></h4>
           <?php 
           $sql = "SELECT * FROM session where ((user_id = :userid) and (last_write ) > (:now - 1800))";
                      //print_r($sql);exit;

                      $command = Yii::$app->db->createCommand($sql);
                      $command->bindValue(':userid', $val['recruiter_id']);
                       $command->bindValue(':now', time());
                      $res=$command->queryAll();
                     //$online = MySession::find()->where(['=','user_id',$val['recruiter_id']])->all();
                     if($res) {

                         echo '<div style="color:green;float:right">online-chat now</div>';
                     }
                     else
                      echo  '<div style="color:red;float:right">offline</div>';
                  ?>
          <div class="job-icons">
            <span><i class="fa fa-briefcase"></i> <?php print_r($val['industry']); ?></span>
            <span><i class="fa fa-map-marker"></i><?php print_r($val['location']); ?> </span>
            <span><i class="fa fa-money"></i><?php if(empty($val['salary']))echo 'salary not disclosed';else print_r($val['salary']); ?></span>
          </div>
        </div>
        </a>
        <div class="clearfix"></div>
      </li>
      <?php }} ?>

        </ul>
        <div class="clearfix"></div>

    </div>
    </div>