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
use yii\db\connection;
use yii\db\sql;

/**
 * JobController implements the CRUD actions for Job model.
 */
class MessageController extends Controller
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
    public function actionIndex()
    {
      if(yii::$app->user->identity->type == 0)
      $this->layout = 'candidate';
      else $this->layout = 'search_candidate';
      return $this->render('index'); 
      }


    public function actionGet_message_ajax()
    {
      if(isset($_GET['c_id'])){
        //get the conversation id and
        $conversation_id = base64_decode($_GET['c_id']);

        //fetch all the messages of $user_id(loggedin user) and $user_two from their conversation
        //$q = mysqli_query($con, "SELECT * FROM `messages` WHERE conversation_id='$conversation_id' order by id DESC");
        //check their are any messages
        $connection = Yii::$app->db;
        if (empty($conversation_id)) {
                          echo "click on the user to start chatting";die();
                        }                
        $message_model = $connection->createCommand("SELECT * FROM `messages` WHERE (conversation_id=$conversation_id) order by id DESC");
        $mess = $message_model->queryAll();
        if($mess){
                foreach ($mess as $key => $m) {          
                //format the message and display it to the user
                $user_form = $m['user_from'];
                $user_to = $m['user_to'];
                $message = $m['message'];
                $senttime = $m['senttime'];
 
                //get name and image of $user_form from `user` table
                $user = User::find()
                         ->where(['id'=>$user_form])
                         ->one();

                $user_form_username = $user['username'];
                $user_fetch['img'] = '';
                $user_name = $user['name'];
                //display the message

                echo "
                            <div class='message'>
                                <div class='img-con'>
                                    
                                </div>
                                <div class='text-con'>
                                    <a href='#' target='_blank'>{$user_name}<div style='float:right;font-size:13px;'>{$senttime}</div></a>
                                    <p>{$message}</p>
                                </div>
                            </div>
                            <hr>";
 
            }
        }else{
            echo "Click On The User To Chat";
        }
    }
      }


    public function actionPost_message_ajax()
     {
    //post message
      
    if(isset($_POST['message'])){
        $message = $_POST['message'];
        $conversation_id = \Yii::$app->db->quoteValue($_POST['conversation_id']);
        $user_form = \Yii::$app->db->quoteValue($_POST['user_form']);
        $user_to = \Yii::$app->db->quoteValue($_POST['user_to']);
 
        //decrypt the conversation_id,user_from,user_to
        $conversation_id = base64_decode($conversation_id);
        $user_form = base64_decode($user_form);
        $user_to = base64_decode($user_to);
        $connection = Yii::$app->db;
         $connection->createCommand()
                            ->insert('messages', [
                                    'conversation_id' => $conversation_id,
                                    'user_from' => $user_form,
                                    'user_to' => $user_to,
                                    'message' => $message,
                                    'new_from' => 1])
                            ->execute();
         echo $message;
 
    }
      }

    public function actionConversation_display()
    {
    	          $user_id = yii::$app->user->id;
                    //show all the users expect me
                    //display all the results
                     $connection = Yii::$app->db;
                        //check $user_id and $user_two has conversation or not if no start one
                     $conversation_model = $connection->createCommand("SELECT * FROM `conversation` WHERE (user_one=$user_id OR user_two=$user_id) ");
                     $conver = $conversation_model->queryAll();
                     foreach ($conver as $key => $row) {
                      	$cid = $row['id'];
                        if($user_id == $row['user_one'])
                            {
                            	$id1 = $row['user_two'];
                        		$id2 = $row['user_one'];
                        	}
                        else 
                        	{
                        		$id1 = $row['user_one'];
                        		$id2 = $row['user_one'];
                        	} 
                        $role_label = user::find()->where(['=', 'id', $id1])->one();
                        if($role_label)
                             $sql = "SELECT * FROM session where ((user_id = :userid) and (last_write ) > (:now - 1800))"; 
                         $command = Yii::$app->db->createCommand($sql);
                      $command->bindValue(':userid', $id1);
                      $command->bindValue(':now', time());
                      $res=$command->queryAll();
                       $sql1 = "SELECT * FROM messages where ((new_to = 0) and (conversation_id = :cid)) "; 
                         $command1 = Yii::$app->db->createCommand($sql1);
                     
                      $command1->bindValue(':cid', $row['id']);
                      $res1=$command1->queryAll();
                      $new = count($res1);
                      if($new == 0 )
                      	$new = '';
                      else $new = '('.$new.')';
                      $sql2 = "SELECT * FROM messages where (conversation_id = :cid) order by id DESC limit 1"; 
                         $command2 = Yii::$app->db->createCommand($sql2);
                      $command2->bindValue(':cid', $row['id']);
                      //print_r($sql);
                      $res2=$command2->queryAll();
                      
                      if($res2[0]['user_from'] == yii::$app->user->id)
                      	$new = '';
                      if($res)
                        $status = "<div style='float:right;color:green'> online ".$new." </div>";
                      else 
                        $status = "<div style='float:right;color:red'> offline ".$new." </div>";
                      echo "<a href='/message?id={$role_label->id}' onclick= 'update($cid);'><li> {$role_label->name}$status</li></a> ";
                    }
      }

      public function actionUpdate()
      {
      	$id = $_POST['id'];
      	//$id = 6;
      	 $sql = "SELECT * FROM messages where (conversation_id = :cid) order by id DESC limit 1"; 
                         $command = Yii::$app->db->createCommand($sql);
                      $command->bindValue(':cid', $id);
                      //print_r($sql);
                      $res=$command->queryAll();
                      
                      if($res[0]['user_from'] != yii::$app->user->id)
                      {
        $connection = Yii::$app->db;
      	$command = $connection->createCommand(
		'UPDATE messages SET new_to=1 WHERE conversation_id='.$id);
		//print_r($command);exit;
		$command->execute();
		$connection->createCommand()->update('messages', ['new_to' => 1], 'conversation_id = :id', [':id' => $id])->execute();
      }
  }

}
