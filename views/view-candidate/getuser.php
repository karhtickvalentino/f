<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Job;
use sanex\simplefilter\SimpleFilter;
use app\models\MySession;
use app\models\Candidate;
?>


 <div class="eleven columns">
    <div class="padding-right">
         <ul class="resumes-list">
        <?php 
        
        
      foreach ($query as  $val) {
        ?>
           <!-- Items -->
            <li><a href="/view-candidate/view?id=<?php echo $val['candidate_id']?>">

                <img src="/images/resumes-list-avatar-01.png" alt="">
                
                <div class="resumes-list-content">
                    <h4><?php echo $val['name'];?> 
                    <span><?php echo $val['role'];?></span></h4>
                    <span><i class="fa fa-map-marker"></i> <?php echo $val['location'];?></span>
                    <p>
                     <?php 
                     $online = MySession::find()->where(['=','user_id',$val['candidate_id']])->all();
                     if($online) {

                         echo '<div style="color:green">online-chat now</div>';
                     }
                     else
                      echo  '<div style="color:red">offline</div>'; ?></p>
                    <p><?php echo $val['profile_summary'];?></p>

                    <div class="skills">
                        <?php $sk1 = explode(",",$val['skills']); 
                            foreach ($sk1 as $sk2) {
                        ?>
                        <span><?php print_r($sk2); ?></span><?php } ?>
                    </div>
                    <div class="clearfix"></div>

                    
                </div>
                </a>
                <div class="clearfix"></div>
            </li>

<?php    }
    ?>   

        </ul>
        <div class="clearfix"></div>

    </div>
    </div>