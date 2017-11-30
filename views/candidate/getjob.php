<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Job;
use sanex\simplefilter\SimpleFilter;
use app\models\MySession;
use app\models\Candidate;

?>


<!-- Recent Jobs -->
    <div class="eleven columns">
    <div class="padding-right">
        
        <form action="#" method="get" class="list-search">
            <button><i class="fa fa-search"></i></button>
            <input type="text" placeholder="job title, keywords or company name" value=""/>
            <div class="clearfix"></div>
        </form>

        <ul class="job-list full">
       <?php

      //$query = Job::find()->all();
       
      foreach ($query as  $val) {
       // print_r($val);
        ?>
           <li class="highlighted"><a href="/candidate/view-job?id=<?php echo $val['job_id'];?>" >
        <img src="/images/job-list-logo-01.png" alt="">
        <div class="job-list-content">
          <h4><?php print_r($val['title']); ?><span class="<?php echo $val['worktype']; ?>"><?php echo $val['worktype']; ?></span></h4>
           <?php 
                     $online = MySession::find()->where(['=','user_id',$val['recruiter_id']])->all();
                     if($online) {

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

<?php  }
    ?>

        </ul>
        <div class="clearfix"></div>

    </div>
    </div>