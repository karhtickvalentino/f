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
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }


        public function actionGetuser($q,$skills)
    {

        $dt=explode(',', $q);
        $skill=explode(',', $skills);
        //print_r($skill);print_r($dt);exit;
        if(!empty($skills) AND !empty($q)){

       // print_r($skills);exit;
         $query = Candidate::find()->where(['AND',['IN', 'location', $dt],['IN', 'skills', $skill]]);
         //print_r($query);exit;
           $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                
            ],
        ]);
          // print_r($query);exit;
       }
      else if(!empty($q) AND empty($skills)){
        $query = Candidate::find()->where(['IN', 'location', $dt]);
         //print_r($query);exit;
           $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                
            ],
        ]);
      }

      else if(!empty($skills) AND empty($q) )
      {
                $query = Candidate::find()->where(['IN', 'skills', $skill]);
         //print_r($query);exit;
           $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort' => [
                
            ],
        ]);
      }

    return  GridView::widget([
        'dataProvider' => $dataProvider,
       
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'name',
            
            'location',
             'experience',
            // 'resume',
             'skills',
              [
            'label'    =>    'status',
            'format'=>'raw',
                'value' => function($data1){

                    $query = MySession::find()->where(['=','user_id',$data1->candidate_id])->all();
                    if($query) {

                        // 'contentOptions'=>['style'='color=green'],
                        return '<a href="/message/conversations" style="color:green;">online </a>';
                    }
                    else
                     return 'offline';
                }
            ],

            [  'class' => 'yii\grid\ActionColumn',
        //'contentOptions' => ['style' => 'width:260px;'],
        'header'=>'Actions',
        'template' => '{view} ',
            ]
           
        ],
    ]);

    }
    /**
     * Creates a new Candidate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
   

    /**
     * Updates an existing Candidate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
   

    /**
     * Deletes an existing Candidate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
   
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


    protected function dataProvider($searchModel)
    {
      return  $searchModel->search(Yii::$app->request->queryParams);
    }
   
}
