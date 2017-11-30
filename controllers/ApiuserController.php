<?php
namespace app\controllers;

//use yii\web\Controller;


use app\models\Job;
use app\models\jobsearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use app\models\Test;
use yii\web\Response;
use Yii;
use webvimark\modules\UserManagement\models\User;
use webvimark\modules\UserManagement\controllers\AuthController;
use webvimark\modules\UserManagement\models\forms\RegistrationForm;
use app\models\Candidate;
use webvimark\modules\UserManagement\components\UserAuthEvent;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\authclient\OAuth2;
/**
* api class to retrive data and save data into the database
*/
class ApiuserController extends Controller
{
    
    public function behaviors()
{
    $behaviors = parent::behaviors();
    $behaviors['authenticator'] = [
        'class' => HttpBasicAuth::className(),
                    // HttpBearerAuth::className(),
    ];
    return $behaviors;
}

//function to create users through apis
    public function actionCreateuser()
    {
        //print_r( HttpBasicAuth::className());exit;
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new user();
        //print_r($model->validate());exit;
        //$model->scenario = Job::SCENARIO_CREATEJOB;
        $model->attributes = Yii::$app->request->post();
       // print_r($model->attributes['type']);exit;
        if ($model->validate()) {

            if ( $this->triggerModuleEvent(UserAuthEvent::BEFORE_REGISTRATION, ['model'=>$model]) )
             {
               // print_r($model->attributes);exit;
                $user = $model->save(false);
                $userclass = 'webvimark\modules\UserManagement\UserManagementModule';
                //print_r($model->id);exit;
                // Trigger event "after registration" and checks if it's valid
                if ( $this->triggerModuleEvent(UserAuthEvent::AFTER_REGISTRATION, ['model'=>$model, 'user'=>$user]) )
                {
                    if ( $user )
                    {                        //{
                            //$roles = (array)$userclass->rolesAfterRegistration;
                            $roles = [];
                            if($model->attributes['type'] == 0)
                            {
                            array_push($roles, 'candidate');
                            $candidatemodel = new Candidate();
                            $candidatemodel->name = $model->attributes['name'];
                            $candidatemodel->candidate_id = $model->id;
                            $candidatemodel->email_id = $model->attributes['username'];
                            $candidatemodel->mobile_number = $model->attributes['mobile_number'];
                            $candidatemodel->save(false);
                            }
                            else   array_push($roles, 'recruiter');
                            foreach ($roles as $role)
                            {
                                User::assignRole($model->id, $role);
                            }

                        }                   
                }
            }

            return array('status' => true, 'data' => 'job record is successfully updated');
        }
        else 
        {
            return array('status' => false, 'data' => $model->getErrors());
        }

    }

    protected function triggerModuleEvent($eventName, $data = [])
    {
        $event = new UserAuthEvent($data);

        $this->module->trigger($eventName, $event);

        return $event->isValid;
    }
}