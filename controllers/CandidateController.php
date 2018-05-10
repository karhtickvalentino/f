<?php

namespace app\controllers;

use Yii;
use app\models\Candidate;
use app\models\Candidatesearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use app\models\Jobsearch;
use app\models\Job;
use yii\data\ActiveDataProvider;
use yii\db\Query;

/**
 * CandidateController implements the CRUD actions for Candidate model.
 */
class CandidateController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        'ghost-access'=> [
            'class' => 'webvimark\modules\UserManagement\components\GhostAccessControl',
        ],
    ];
    }


    /**
     * Lists all Candidate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->layout = 'candidate.php';
        $searchModel = new jobsearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Candidate model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->layout = 'candidate';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    public function actionMessages()
    {
        $this->layout = 'candidate';
        return $this->render('messages');
    }

    public function actionViewJob($id)
    {
        $this->layout = 'candidate';
        return $this->render('view-job', [
            'model' => $this->findjob($id),
        ]);
    }



        public function actionGetjob($q,$skills)
    {

        $this->layout = 'aj.php';
        $dt=explode(',', $q);
        $skill=explode(',', $skills);
        $status = $skill[0];
        if(!empty($skills) AND !empty($q)){
         $query = Job::find()->where(['or like', 'location', $dt])->orderBy(['job_id' => SORT_DESC])->all();
       }
      else if(!empty($q) AND empty($skills)){
        $query = Job::find()->where(['AND',['or like', 'location', $dt],['status'=>0]])->orderBy(['job_id' => SORT_DESC])->all();
          }

      else if(!empty($skills) AND empty($q) )
      {     
        
// $query = new Query;
// $query  ->
//     from('job')
//     ->join('INNER JOIN', 'my_session',
//                 'job.recruiter_id =my_session.user_id')
//     ->where('job.status=0')
//     ->all()  ; 
    
// $command = $query->createCommand();
// $data = $command->queryAll();   
//             $query = $data;
        $query = Job::find()->orderBy(['job_id' => SORT_DESC])->all();
           
      }
       else if(empty($skills) AND empty($q) )
      {
                $query = Job::find()->where(['status'=>0])->orderBy(['job_id' => SORT_DESC])->all();
         }
       // $query = Job::find()->all();
      return $this->render ('getjob.php', [
            'query' => $query,
            'status' => $status,
        ]);
    }



    //browse jobs
        public function actionJobs()
    {
         $this->layout = 'candidate.php';
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Updates an existing Candidate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = 'candidate';
        $model = $this->findModel($id);
        $model->scenario = 'request';

        if ($model->load(Yii::$app->request->post())  ) {
            //print_r((Yii::$app->request->post()));exit;
            //$model->profile_summary = Yii::$app->request->post()->profile_summary;
             $file = UploadedFile::getInstance($model, 'resume');
             if($file){  
          
           $model->resume = $id.'.'.$file->extension;
           // print_r($file);exit;
          
          if($model->save(false))
          {
            $file->saveAs('uploads/'.$model->resume);
          }
         }
         
          else $model->save(false);
            return $this->redirect(['view', 'id' => $model->candidate_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Candidate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    // public function actionDelete($id)
    // {
    //     $this->findModel($id)->delete();

    //     return $this->redirect(['index']);
    // }

    /**
     * Finds the Candidate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Candidate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Candidate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }



     public function actionDownload($id) {
     $path = Yii::getAlias('@webroot').'/uploads/';
     $model  =  $this->findModel($id);
    $file = $path . $model->resume;
    //
    if($model->resume)
     if (file_exists($file)) {
      //print_r($file);exit;  
     return Yii::$app->response->sendFile($file);

    }
   // return $this->redirect('index');
  }


  // public function actionResume($id){
  //   $model = $this->findModel($id);
    
  //   //return $this->render('resume',['model'=>$model]);
  //    if ($model->load(Yii::$app->request->post())  ) {
  //       //print_r($model->load(Yii::$app->request->post()));exit;
  //            $file = UploadedFile::getInstance($model, 'resume');
  //            if($file){  
          
  //         $model->resume = $id.'.'.$file->extension; 
  //         //print_r($model->resume);exit;         
  //         $model->save(false);
  //         $file->saveAs('uploads/'.$model->resume);
  //        Yii::$app->session->setFlash('success', "Saved");
  //        return $this->redirect('index');
  //        }
  //         else return $this->render('resume',['model'=>$model]);
  //       }
  //    else  
  //       {
  //           return $this->render('resume',['model'=>$model]);
  //       }

  //   }  
  

  // public function actionUpdateresume($id)
  // {
  //    $model = $this->findModel($id);
  //    print_r($model->load(Yii::$app->request->post()));exit;
  //   if ($model->load(Yii::$app->request->post())  ) {
  //            $file = UploadedFile::getInstance($model, 'resume');
  //            if($file){  
          
  //         $model->resume = $id.'.'.$file->extension;          
  //         $model->save();
  //         $file->saveAs('uploads/'.$model->resume);
  //         return $this->redner('view',['id' => $model->candidate_id]);
  //        }
  //       }
  //    else  return $this->redner('resume');
  // }

   protected function findjob($id)
    {
        if (($model = Job::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
