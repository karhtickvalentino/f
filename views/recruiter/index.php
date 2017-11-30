<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Recruiter;
use app\models\Job;

/* @var $this yii\web\View */
/* @var $searchModel app\models\jobsearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jobs';

?>
<!-- Titlebar
================================================== -->
<div id="titlebar" class="single">
    <div class="container">

        <div class="sixteen columns">
            <h2>Manage Jobs</h2>
            <nav id="breadcrumbs">
                <ul>
                    <li>You are here:</li>
                    <li><a href="/recruiter/">Home</a></li>
                    <li>Job Dashboard</li>
                </ul>
            </nav>
        </div>

    </div>
</div>

<div class="container">
<!-- Table -->
    <div class="sixteen columns">

        <p class="margin-bottom-25">Your listings are shown in the table below. Expired listings will be automatically removed after 30 days.</p>


        <table class="manage-table responsive-table">
 <tr>
                <th><i class="fa fa-file-text"></i> Title</th>
                <th><i class="fa fa-check-square-o"></i> Filled?</th>
                <th><i class="fa fa-calendar"></i> Date Posted</th>
                <th><i class="fa fa-file-text"></i> Industry</th>
                <th><i class="fa fa-calendar"></i> Date Expires</th>
                
                <th></th>
            </tr>

 <?php 
      $query = Job::find()->where(['recruiter_id'=>Yii::$app->user->id])->all();
      $i = 0;
      foreach ($query as  $val) {
       // print_r($val);
         
        if($i <= 5)
        {
        ?>
           <!-- Items -->
            <tr>
                <td class="title"><a href="/job/view?id=<?php echo $val['job_id'] ?>"><?php echo $val['title'] ?></a></td>
                <td class="centered">-</td>
                <td><?php echo Yii::$app->formatter->asDate($val['created_on']); ?></td>
                <td>October 10, 2015</td>
                <td><?php echo $val['industry'] ?>
                <td class="action">
                    <a href="/job/update?id=<?php echo $val['job_id']; ?>"><i class="fa fa-pencil"></i> Edit</a>
                    <a href="delete?id=<?php echo $val['job_id'] ?>" class="delete"><i class="fa fa-remove"></i> Delete</a>
                </td>
            </tr>

<?php    } $i = $i+1; }
    ?>

        </table>

        <br>
        <a href="create?rid=<?php echo Yii::$app->user->id?>" class="button">Add Job</a>

    </div>



</div>