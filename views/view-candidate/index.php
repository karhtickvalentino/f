
<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Job;
use sanex\simplefilter\SimpleFilter;
use app\models\MySession;
use app\models\Candidate;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Candidatesearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Candidates';

?>
<style type="text/css">
.FixedHeightContainer1
{
  
  /*height : 180px;*/
/*  float: right;

  width:170px; 
  padding:3px; 
    background:#26ae61;*/
     /*padding:3px;*/
}
.Content
{
  height:150px;
   overflow:auto;
    background:#fff;
}
</style>

<!-- Titlebar
================================================== -->
<div id="titlebar">
    <div class="container">
        <div class="ten columns">
           
            <h2>Candidates</h2>
        </div>

        <div class="six columns">
            <a href="/job/create?rid=<?php echo Yii::$app->user->id ?>" class="button">Post Job, It’s Free!</a>
        </div>

    </div>
</div>


<div class="container">
   
<div class="eleven columns">
     <div class="mobile-sidebar-here" >
     </div>
</div>
     <!--new theme -->



<div id="txtHint">
        <!-- Recent Jobs -->
    <div class="eleven columns">
    <div class="padding-right">
         <ul class="resumes-list">
        <?php 
         $query = Candidate::find()->all();
      $i = 0;
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
                      echo  '<div style="color:red">offline</div>';
                  ?>
        
                    </p>
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
</div>

    <!-- Widgets -->
    <div class="desktop-sidebar-here">
   <div class="mobile-sidebar">
    <div class="five columns">
        
         <!-- Skills -->
        <div class="widget">
            <h4>Status</h4>

            <!-- Select -->
             <div class="stat" >       

                <label style="font-weight: 300"><input type="checkbox" name="skills" value="1" id="online" class="status"> Online</label>
               


        </div>

        </div>
      

        <!-- Skills -->
        <div class="widget">
            <h4>Skills</h4>

            <!-- Select -->
             <div class="ski" >
         <div class="FixedHeightContainer1" style="">
                Filter By Skills
                <div class="Content">
                <?php
                $arr = []; 
                $loc = Candidate::find()->all();
                    foreach ($loc as $l) {  
                         $dbloc = explode(',', $l['skills']);
                          if(!empty($dbloc[0]) ){

                            foreach ($dbloc as $value) {
                                 if(!in_array($value,$arr, true))
                                array_push($arr, $value);
                        }
                    }}
                        foreach ($arr as $value) {
                ?>

                <label style="font-weight: 300"><input type="checkbox" name="skills" value="<?php print_r($value);?>" id="<?php print_r($value);?>" class="skills"> <?php print_r($value);?></label>
                <?php    }
                ?>
</div>
</div>
</div>

        </div>
        

        <!-- Location -->
        <div class="widget">
            <h4>Location</h4>
                 <div class="location">
        <div class="FixedHeightContainer1">
            Filter By Location
            <div class="Content">
              <?php $loc = Candidate::find()->Select('location')->distinct()->all(); //print_r($loc);exit;
                $locarray = [];
                foreach ($loc as $l) {  
                    if(!empty($l['location'])){
              ?>

               <label style="font-weight: 300">  <input type="checkbox" name="location" value="<?php print_r($l['location']); ?>" id="<?php print_r($l['location']);?>" class="filters"> <?php print_r($l['location']); ?></label>
                <?php    }}
                ?>
            </div>
        </div>
        </div>
</div>
    </div>
</div>
    <!-- Widgets / End -->









     <!-- ENd -->





       


<br>




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
                 xmlhttp.open('GET','/view-candidate/getuser?q='+category_list+'&skills='+skill,true);
                 xmlhttp.send();
               })

                $('.skills').on('change', function(){
            skill=[];
            $('.ski :input:checked').each(function(){
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
                 xmlhttp.open('GET','/view-candidate/getuser?q='+category_list+'&skills='+skill,true);
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


