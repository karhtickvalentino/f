<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/colors/green.css" id="colors">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">

<!-- Header
================================================== -->
<header class="sticky-header">
<div class="container">
    <div class="sixteen columns">

        <!-- Logo -->

        <div id="logo">
            <h1><a href="/candidate/"><img src="/images/logo2.png" alt="Here And Now" /></a></h1>
        </div>

        <!-- Menu -->
        <nav id="navigation" class="menu">
            <ul id="responsive">

                <li><a href="/">Home</a>
                </li>
                <li><a href="#">For Candidates</a>
                    <ul>
                         <li><a href="/user-management/auth/registration"><i class="fa fa-user"></i> Sign Up</a></li>
                         <li><a href="/user-management/auth/login"><i class="fa fa-lock"></i> Log In</a></li>
                    </ul>
                </li>

               <li><a href="#">For Employer</a>
                    <ul>
                        <li><a href="/user-management/auth/login?type=emp">Login</a></li>
                        <li><a href="/user-management/auth/registration?type=emp">Sign Up</a></li>

                    </ul>
                </li>
            </ul>

        </nav>

        <!-- Navigation -->
        <div id="mobile-navigation">
            <a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
        </div>

    </div>
</div>
</header>
<div class="clearfix"></div>
<!-- Banner
================================================== -->



    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
                   <?php 
if(isset($_SESSION['errorMsg'])){
    $msg = $_SESSION['errorMsg'] ;
    unset($_SESSION['errorMsg']);
}
else{
    $msg = '';
}?>

<?php 
    if($msg != ""){ 
             if(preg_match('/not/', $msg) OR preg_match('/Not/', $msg)){          
                echo '<div class="alert alert-danger">'.$msg.'</div>';
            }else{
                echo '<div class="alert alert-success">'.$msg.'</div>';
            } 
        }
     ?>
        <?= $content ?>
    </div>
</div>

<!-- <footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer> -->
<!-- Footer
================================================== -->
<div class="margin-top-15"></div>

<div id="footer">
    <!-- Main -->
    <div class="container">

        <div class="seven columns">
            <h4>About</h4>
            <p>Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros. Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper.</p>
            <a href="#" class="button">Get Started</a>
        </div>

        <div class="three columns">
            <h4>Company</h4>
            <ul class="footer-links">
                <li><a href="#">About Us</a></li>
                <li><a href="#">Careers</a></li>
                <li><a href="#">Our Blog</a></li>
                <li><a href="#">Terms of Service</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Hiring Hub</a></li>
            </ul>
        </div>
        


    </div>

    <!-- Bottom -->
    <div class="container">
        <div class="footer-bottom">
            <div class="sixteen columns">
                <h4>Follow Us</h4>
                <ul class="social-icons">
                    <li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
                    <li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
                    <li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
                    <li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
                </ul>
                <div class="copyrights">©  Copyright 2017 by <a href="#">Bluegild</a>. All Rights Reserved.</div>
            </div>
        </div>
    </div>

</div>

<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>

</div>
<!-- Wrapper / End -->





<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
