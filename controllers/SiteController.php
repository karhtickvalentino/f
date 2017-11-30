<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Job;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\models\forms\PasswordRecoveryForm;
use yii\widgets\ActiveForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    public function beforeAction($action)
{
    if (parent::beforeAction($action)) {
        // change layout for error action
        if ($action->id=='error')
             $this->layout ='main2.php';
        return true;
    } else {
        return false;
    }
}

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if(Yii::$app->user->isGuest) 
            return $this->render('index');
        elseif (yii::$app->user->identity->type==0) {
            $this->layout = 'candidate';
            return $this->render('/candidate/index');
        }
        else{
             $this->layout = 'search_candidate';
             return $this->render('/recruiter/index');
        }
    }



   public function actionAdduser()
    {
        return $this->render('index');
    }



       public function actionPassword()
    {
        $this->layout = 'main2.php';
        $model = new user();
        if ($model->load(Yii::$app->request->post())) {
             $query = user::find()->where(['username'=>$model->email])->one();
             if($query)
                 $password = $query->password_hash;
                //$new = Yii::$app->getSecurity()->validatePassword($password);
                //print_r($password);
            //return $this->redirect(['view', 'id' => $model->candidate_id]);
        } else {
            return $this->render('password',['model'=>$model]);
        }
        
        
    }





     public function actionLocation()
    {
        
        return $this->render('location');
    }



    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
