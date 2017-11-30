<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Recruiter;
use app\models\Job;
use app\models\WorkType;
use app\models\MySession;

/* @var $this yii\web\View */
/* @var $searchModel app\module\candidate\models\Candidatesearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
?>

<?= Yii::$app->session->getFlash('success') ?>



<!-- Titlebar
================================================== -->
<div id="titlebar">
    <div class="container">
        <div class="ten columns">
            <span>We found 1,412 jobs matching:</span>
            <h2>Web, Software & IT</h2>
        </div>

        <div class="six columns">
            <a href="#" class="button">Live chat with recruiters for free</a>
        </div>

    </div>
</div>

<div class="container">

<div class="eleven columns">
     <div class="mobile-sidebar-here" >
     </div>
</div>
<!-- Recent Jobs -->
<div id="txtHint">
    <div class="eleven columns">
    <div class="padding-right">


        <ul class="job-list full">

             <?php 
      $query = Job::find()->where(['status' => 0])->all();
      foreach ($query as  $val) {
       // print_r($val);
        ?>
           <li class="highlighted"><a href="/candidate/view-job?id=<?php echo $val['job_id'];?>" >
        <img src="/images/job-list-logo-01.png" alt="">
        <div class="job-list-content">
          <h4><?php print_r($val['title']); ?><span class="<?php 
                $role_label = WorkType::find()->where(['=', 'work_type_id', $val['worktype']])->one();
                        if($role_label)
                        echo $role_label->name;
                        else echo '--'; ?>"><?php 
                $role_label = WorkType::find()->where(['=', 'work_type_id', $val['worktype']])->one();
                        if($role_label)
                        echo $role_label->name;
                        else echo '--'; ?></span></h4>
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
</div>

    <!-- Widgets -->
    <div class="five columns">
    <div class="desktop-sidebar-here">
   <div class="mobile-sidebar">
<!-- Sort by -->
        <div class="widget">
            <h4>Filters</h4>
            <h4>Status</h4>

            <!-- Select -->
                 <div class="status">
               <label style="font-weight: 300">  <input type="checkbox" name="status" value="1" id="online" class="status1"> Online</label>
               
        </div>
               

        </div>
            

 <!-- Location -->
        <div class="widget">
            <h4>Location</h4>
                 <div class="location">
 
            Filter By Location
 
              <?php $loc = Job::find()->Select('location')->distinct()->all(); //print_r($loc);exit;
                $locarray = [];
                foreach ($loc as $l) {  
                $dbloc = explode(',', $l['location']);
                array_push($locarray, $dbloc[0]);

                if(!empty($dbloc[0]) ){
              ?>

               <label style="font-weight: 300">  <input type="checkbox" name="location" value="<?php print_r($dbloc[0]); ?>" id="<?php print_r($dbloc[0]);?>" class="filters"> <?php print_r($dbloc[0]); ?></label>
                <?php    }}
                ?>
            </div>

        </div>

       

</div>
</div>

    </div>
    <!-- Widgets / End -->


   </div>
   </div>
   <?php 
$js=" 
    var category_list = [];
            var skill = [];

            $('.filters').on('change', function(){
            category_list=[];
            $('.location :input:checked').each(function(){
              var category = $(this).val();

                if ($.inArray(this.name,category_list) == -1){
                    category_list.push(category);//Push each check item's value into an array
                }

               
              });
            if (window.XMLHttpRequest) {
                     // code for IE7+, Firefox, Chrome, Opera, Safari
                     xmlhttp = new XMLHttpRequest();
                 } else {
                     // code for IE6, IE5
                     xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
                 }
              
                 xmlhttp.onreadystatechange = function() {
                     if (this.readyState == 4 && this.status == 200) {
                          document.getElementById('txtHint').innerHTML = this.responseText;
                        //document.getElementById('txtHint').innerHTML = this.responseText;
                     }
                 };
                 xmlhttp.open('GET','/candidate/getjob?q='+category_list+'&skills='+skill,true);
                 xmlhttp.send();
               })

                $('.status1').on('change', function(){
            skill=[];
            $('.status :input:checked').each(function(){
              var sk = $(this).val();

                if ($.inArray(this.name,skill) == -1){
                    skill.push(sk);//Push each check item's value into an array

                }

               
              });

            if (window.XMLHttpRequest) {
                     // code for IE7+, Firefox, Chrome, Opera, Safari
                     xmlhttp = new XMLHttpRequest();
                 } else {
                     // code for IE6, IE5
                     xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
                 }
              
                 xmlhttp.onreadystatechange = function() {
                     if (this.readyState == 4 && this.status == 200) {
                          document.getElementById('txtHint').innerHTML = this.responseText;
                         // window.location.href = '#?query' + this.responseText;
                     }
                 };
                 xmlhttp.open('GET','/candidate/getjob?q='+category_list+'&skills='+skill,true);
                 xmlhttp.send();
       })"


               ;
        $this->registerJs($js);
        $js2 = '$(window).on("load resize", function() {
  if ( $(window).width() < 768 ) {
    $(".mobile-sidebar").appendTo(".mobile-sidebar-here");
  }
  else  if ( $(window).width() > 768 ) {
    $(".mobile-sidebar").appendTo(".desktop-sidebar-here");
}
});';
$this->registerJs($js2);
?>
