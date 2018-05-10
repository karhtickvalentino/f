<?php

namespace app\controllers;

use Yii;
use app\models\Candidate;
use app\models\Candidatesearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\MySession;
use webvimark\modules\UserManagement\models\User;
use yii\helpers\Json;
/**
 * ViewCandidateController implements the CRUD actions for Candidate model.
 */
class ViewCandidateController extends Controller
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
    public function actionIndex($rid)
    {
       //print_r(User::isOnlineBySession());exit;
        $this->layout = 'search_candidate.php';       
        $searchModel = new Candidatesearch();
        $dataProvider = $this->dataProvider($searchModel);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'rid' => $rid,
          ]);

    }

    /**
     * Displays a single Candidate model.
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




    

        public function actionGetuser($q,$skills,$status)
    {
        
        $this->layout = 'aj.php';
        $dt=explode(',', $q);
        $skill=explode(',', $skills);
        //print_r($status);exit;
        if(!empty($skills) AND !empty($q)){
         $query = Candidate::find()->where(['AND',['or like', 'location', $dt],['or like', 'skills', $skill]])->orderBy(['candidate_id' => SORT_DESC])->all();
       }
      else if(!empty($q) AND empty($skills)){
        $query = Candidate::find()->where(['or like', 'location', $dt])->orderBy(['candidate_id' => SORT_DESC])->all();

      }

      else if(!empty($skills) AND empty($q) )
      {
          $query = Candidate::find()->where(['or like', 'skills', $skill])->orderBy(['candidate_id' => SORT_DESC])->all();
      }
       else if(empty($skills) AND empty($q) )
      {
           $query = Candidate::find()->orderBy(['candidate_id' => SORT_DESC])->all();
      }
    
      return $this->render ('getuser.php', [
            'query' => $query,
            'status' => $status,
        ]);
    }
    


    protected function findModel($id)
    {
        if (($model = Candidate::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


    protected function dataProvider($searchModel)
    {
      return  $searchModel->search(Yii::$app->request->queryParams);
    }

    
   
}
