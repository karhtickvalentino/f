<?php
use webvimark\modules\UserManagement\models\User;

$user_id = yii::$app->user->id;

?>
     
    <div class="message-body">
        <div class="message-left">
            <ul>
                <div class ="contacts">

                </div>  
            </ul>
        </div>
 
        <div class="message-right">
            <!-- display message -->
            <div class="display-message">
                 <?php
                //check $_GET['id'&#93; is set
                if(isset($_GET['id'])){
                    $user_two = $_GET['id'];
                    //check $user_two is valid
                    $model = User::find()
                    ->where(['and' ,"id = $user_two","id != $user_id"])
                    ->all();

                    if($model){
                        $connection = Yii::$app->db;
                        //check $user_id and $user_two has conversation or not if no start one
                        $conversation_model = $connection->createCommand("SELECT * FROM `conversation` WHERE (user_one=$user_id AND user_two=$user_two) OR (user_one=$user_two AND user_two=$user_id)");
                        $conver = $conversation_model->queryone();                            
                        //they have a conversation
                        if($conver){
                            $conversation_id = $conver['id'];
                        }else{ //they do not have a conversation
                            //start a new converstaion and fetch its id
                            $connection->createCommand()
                            ->insert('conversation', [
                                    'user_one' => $user_id,
                                    'user_two' => $user_two,])
                            ->execute();
                             $conversation_id = Yii::$app->db->getLastInsertID();
                        }
                    }else{
                        die("Invalid  ID.");
                    }
                }else {
                    $conversation_id = "";
                    $user_id = "";
                    $user_two = "";
                    echo "Click On the Person to start Chating.";
                }
            ?>
            </div>
            <!-- /display message -->
 <?php 
 $sql = "SELECT * FROM session where ((user_id = :userid) and (last_write ) > (:now - 1800))"; 
                         $command = Yii::$app->db->createCommand($sql);
                      $command->bindValue(':userid', $user_two);
                      $command->bindValue(':now', time());
                      $res=$command->queryAll();
 ?>
            <!-- send message -->
            <div class="send-message">
                <!-- store conversation_id, user_from, user_to so that we can send send this values to post_message_ajax.php -->
                 <input type="hidden" id="conversation_id" value="<?php echo base64_encode($conversation_id); ?>">
                <input type="hidden" id="user_form" value="<?php echo base64_encode($user_id); ?>">
                <input type="hidden" id="user_to" value="<?php echo base64_encode($user_two); ?>">
                <div class="form-group">
                    <input type="textbox" class="form-control" id="message" placeholder="<?php if($res) echo 'Enter Your Message';else echo 'user is offline you cannot send messages';?>" <?php if(!$res) echo 'disabled';?> >
                </div>
                <input type="submit" value="Send" class="btn btn-primary" id="reply">
                <span id="error"></span>
            </div>
            <!-- / send message -->
        </div>
    </div>
</div>
    <!-- <script type="text/javascript" src="js/jquery.min.js"></script> -->
