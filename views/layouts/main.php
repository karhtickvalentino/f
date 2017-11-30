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
            <h1><a href="/"><img src="images/logo2.png" alt="Work Scout" /></a></h1>
        </div>

        <!-- Menu -->
        <nav id="navigation" class="menu">
            <ul id="responsive">

                <li><a href="/" id="current">Home</a>
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


            <!-- <ul class="float-right">
                
                 
            </ul> -->

        </nav>

        <!-- Navigation -->
        <div id="mobile-navigation">
            <a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
        </div>

    </div>
</div>
</header>
<div class="clearfix"></div>
<!-- Slider
================================================== -->
<div class="fullwidthbanner-container">
    <div class="fullwidthbanner">
        <ul>

            <!-- Slide 1 -->
            <li data-fstransition="fade" data-transition="fade" data-slotamount="10" data-masterspeed="300">

                <img src="images/banner-01.jpg" alt="" >

                <div class="caption title sfb" data-x="0" data-y="195" data-speed="400" data-start="800"  data-easing="easeOutExpo">
                    <h2>Explore and be discovered</h2>
                </div>

                <div class="caption text sfb" data-x="0" data-y="270" data-speed="400" data-start="1200" data-easing="easeOutExpo">
                    <p>Connect directly with and be discovered by the employers <br>who want to hire you.</p>
                </div>

                <div class="caption sfb" data-x="0" data-y="400" data-speed="400" data-start="1600" data-easing="easeOutExpo">
                    <a href="/user-management/auth/registration" class="slider-button">Get Started</a>
                </div>
            </li>

            <!-- Slide 2 -->
            <li data-transition="slideup" data-slotamount="10" data-masterspeed="800">
                <img src="images/banner-02.jpg" alt="">

                <div class="caption title sfb" data-x="center" data-y="195" data-speed="400" data-start="800"  data-easing="easeOutExpo">
                    <h2>Hire great hourly employees</h2>
                </div>

                <div class="caption text align-center sfb" data-x="center" data-y="270" data-speed="400" data-start="1200" data-easing="easeOutExpo">
                    <p>Here and Now is most trusted job board, connecting the world's <br> brightest minds with resume database loaded with talents.</p>
                </div>

                <div class="caption sfb" data-x="center" data-y="400" data-speed="400" data-start="1600" data-easing="easeOutExpo">
                    <a href="/user-management/auth/registration" class="slider-button">Hire</a>
                    <a href="/job/index" class="slider-button">Work</a>
                </div>
            </li>

        </ul>
    </div>
</div>


    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
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
        
        <div class="three columns">
            <h4>Press</h4>
            <ul class="footer-links">
                <li><a href="#">In the News</a></li>
                <li><a href="#">Press Releases</a></li>
                <li><a href="#">Awards</a></li>
                <li><a href="#">Testimonials</a></li>
                <li><a href="#">Timeline</a></li>
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
                <div class="copyrights">©  Copyright <?php echo date("Y"); ?> by <a target = '_blank' href="http://bluegild.com">Bluegild</a>. All Rights Reserved.</div>
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
