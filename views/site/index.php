<?php

/* @var $this yii\web\View */
use app\models\User;
use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
 <!-- <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
  <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css" rel="stylesheet"> -->
<div class="banner">
    <div class="container">
        <div id="search_wrapper">
         <div id="search_form" class="clearfix">
         <h1>Start your job search here</h1>
         
            <p>
             <input type="text" id="tb1" class="text1" placeholder=" " value="Enter Keyword(s)" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Enter Keyword(s)';}">
             <input type="text" class="text" placeholder=" " value="Location" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Location';}">
             <label class="btn2 btn-2 btn2-1b"><input type="submit" value="Find Jobs"></label>
            </p>
               <h1 id="main-heading" class="page-header">.</h1>
 
         </div>
        
       </div>
   </div> 
</div> 

