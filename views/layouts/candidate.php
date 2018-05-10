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
   
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrapper">
<header class="sticky-header">
<div class="container">
    <div class="sixteen columns">

        <!-- Logo -->

        <div id="logo">
            <h1><a href="/candidate/"><img src="/images/logo.png" alt="Here And Now" /></a></h1>
        </div>

        <!-- Menu -->
        <nav id="navigation" class="menu">
            <ul id="responsive">

                <li><a href="/candidate/">Home</a>
                </li>

                <li><a href="/candidate/">Browse Jobs</a>
                </li>

                <li><a href="/candidate/view?id=<?php echo yii::$app->user->id?>"><i class="fa fa-user"></i> Profile</a></li>
                
                <li><a href="/message">Messages</a>
                </li>
               
            </ul>


            <ul class="responsive float-right">
                

                <li><a href="/user-management/auth/logout"><i class="fa fa-lock"></i> Log Out</a></li>
                <li><a href="/user-management/auth/change-own-password"><i class="fa fa-gear"></i></a>
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



   
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    
</div>


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
                <div class="copyrights">©  Copyright 2017 by <a href="#">BLUEGILD</a>. All Rights Reserved.</div>
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
