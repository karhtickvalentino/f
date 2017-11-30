<?php

namespace app\controllers;


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

/**
 * JobController implements the CRUD actions for Job model.
 */
class JobController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        // return [
        //     'verbs' => [
        //         'class' => VerbFilter::className(),
        //         'actions' => [
        //             'delete' => ['POST'],
        //             //'createjob' => ['POST'],
        //         ],
        //     ],
        // ];
     return [
        'ghost-access'=> [
            'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
        ],
    ];
    }

    /**
     * Lists all Job models.
     * @return mixed
     */
    public function actionIndex($rid)
    {
        $this->layout = 'search_candidate';
        $searchModel = new jobsearch();
       // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

         $query = Job::find()->where(['recruiter_id'=> $rid ]);
         

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                'defaultOrder' => [
                    'job_id' => SORT_DESC,
                   
                ]
            ],
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Job model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'search_candidate.php';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Job model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate($rid)
    {
        $this->layout = 'search_candidate.php';
        $model = new Job();

        if ($model->load(Yii::$app->request->post())  ) {
            $model->recruiter_id = $rid;
            $model->status = 0;
            $model->save(false);
            return $this->redirect('\recruiter\index'
                );
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }




    //function which saves data through APIs







    /**
     * Updates an existing Job model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = 'search_candidate';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            //print_r(Yii::$app->request->post());exit;
            return $this->redirect(['view', 'id' => $model->job_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Job model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Job model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Job the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Job::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
 public function actionCreatejob()
    {   
        try{
        Yii::$app->response->format = Response::FORMAT_JSON;
        $model = new Job();
        //print_r($model->validate());exit;
        //$model->scenario = Job::SCENARIO_CREATEJOB;
        $model->attributes = Yii::$app->request->post();
        if ($model->validate()) {

            $model->save();
            return array('status' => true, 'data' => 'job record is successfully updated');
        }
        else 
        {
            return array('status' => false, 'data' => $model->getErrors());
        }
    }
    catch (ErrorException $e)
    {
         Yii::warning("error.");
    }

}




//create users through APIs
 public function actionCreateuser()
    {   
        
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





//get job info through api
public function actionGetjob()
{
    Yii::$app->response->format = Response::FORMAT_JSON;
        $model = Job::find()->all();
        if(count($model)>0)
        {
            return array('status'=>true,'data'=>$model);
        }
        else 
        {
            return array('status'=>false,'data'=>'no job found');
        }
}
protected function triggerModuleEvent($eventName, $data = [])
    {
        $event = new UserAuthEvent($data);

        $this->module->trigger($eventName, $event);

        return $event->isValid;
    }

}
