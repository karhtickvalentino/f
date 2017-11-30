<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Recruiter;
use app\models\Job;
use app\models\Chat;
use webvimark\modules\UserManagement\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\jobsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Messages';

?>
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single">
    <div class="container">

        <div class="sixteen columns">
            <h2>Messages</h2>
            <nav id="breadcrumbs">
                <ul>
                    <li>You are here:</li>
                    <li><a href="/recruiter/">Home</a></li>
                    <li>Messages</li>
                </ul>
            </nav>
        </div>

    </div>
</div>

<div class="container">
<!-- Table -->
    <div class="sixteen columns">


        <table class="manage-table responsive-table">
 <tr>
                <th><i class="fa fa-user"></i> Name</th>
                <!-- <th><i class="fa fa-file-text"></i> Profile</th> -->
                <th><i class="fa fa-check-square-o"></i> Status</th>
                <th><i class="fa fa-file-text"></i> Remarks</th>
            </tr>

 <?php 
      $query = Chat::find()->select(['from','to'])->where(['OR',['from'=>Yii::$app->user->identity->chatname],['to'=>Yii::$app->user->identity->chatname]])->distinct()->all();
      $a = [];
      foreach ($query as  $val) {
            if(!in_array($val['from'],$a, true))
            array_push($a, $val['from']);
            if(!in_array($val['to'],$a, true))
            array_push($a, $val['to']);
    }
    $a = array_diff($a, [yii::$app->user->identity->chatname]);
    foreach ($a as $val) {
        $query = user::find()->where(['chatname'=>$val])->one();
        ?>
           <!-- Items -->
            <tr>
                <td class="title"><a href="#" onclick="chatWith('<?php echo $val; ?>')">
                    <?php 
                            echo $val; ?></a></td>
               <!--  <td class=""><a href="/view-candidate/view?id=<?php echo $query->id ?>">view</a></td> -->
                <td class="">-</td>
                <td class=""></td>
            </tr>


<?php   }
    ?>

        </table>

        <br>
       

    </div>



</div>