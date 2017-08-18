<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\JobAsset;


JobAsset::register($this);
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

<div class="wrap">
   <nav class="navbar navbar-default" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <?php if(Yii::$app->user->isGuest){?>
            <a class="navbar-brand" href="<?php Yii::$app->homeUrl ?>">Job Portal</a>
<?php } ?> 
        </div>

        <!--/.navbar-header-->
        <div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1" style="height: 1px;">
            <ul class="nav navbar-nav">
                
               
                <?php if(Yii::$app->user->isGuest){ ?>
                              
                  



                    
                        <li><a href="/user-management/auth/login">Login</a></li>
                        
                        
                
                <?php } ?>
                 <?php if(Yii::$app->user->isGuest){ ?>
              
                        <li id="reg"><a href="/user-management/auth/registration">Register</a></li>
                        
                     
                <?php } ?>
                <?php if(!Yii::$app->user->isGuest){ ?>
                <li >
                  <a href="/candidate/view?id=<?=yii::$app->user->id ?>">Profile</a>
                </li>
                 <li >
                  <a href="/user-management/auth/logout">logout</a>
                </li>
                <?php }?>
            </ul>
        </div>
        <div class="clearfix"> </div>
      </div>
        <!--/.navbar-collapse-->
    </nav>



    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Bluegild <?= date('Y') ?></p>

       
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
