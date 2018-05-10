<?php

namespace app\controllers;

use Yii;
use app\models\Recruiter;
use app\models\Recruitersearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Candidate;

/**
 * RecruiterController implements the CRUD actions for Recruiter model.
 */
class RecruiterController extends Controller
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
     * Lists all Recruiter models.
     * @return mixed
     */
    public function actionIndex()
    {
        $id = Yii::$app->user->id;
         $this->layout = 'search_candidate.php';
       return $this->render('index', [
            'id' => $id
        ]);
        
    }

    /**
     * Displays a single Recruiter model.
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



        public function actionMessages()
    {
      $this->layout = 'search_candidate.php';
        return $this->render('messages');
    }

    /**
     * Creates a new Recruiter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Recruiter();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/recruiter/');
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }



//download candidates resume
     public function actionDownload($id) {
     $path = Yii::getAlias('@webroot').'/uploads/';
     $model  =  $this->findCandiate($id);
    $file = $path . $model->resume;
    //
    if($model->resume)
     if (file_exists($file)) {
      //print_r($file);exit;  
     return Yii::$app->response->sendFile($file);

    }
   // return $this->redirect('index');
  }
    /**
     * Updates an existing Recruiter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->layout = 'search_candidate.php';
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->recruiter_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Recruiter model.
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
     * Finds the Recruiter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Recruiter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Recruiter::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    //find candidate model
        protected function findCandiate($id)
    {
        if (($model = Candidate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
