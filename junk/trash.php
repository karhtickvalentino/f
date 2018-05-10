  $q = mysqli_query($con, "SELECT * FROM `conversation` WHERE user_one='$user_id' or user_two=$user_id");
                    //display all the results
                    while($row = mysqli_fetch_assoc($q)){
                        if($user_id == $row['user_one'])
                            $id1 = $row['user_two'];
                        else $id1 = $row['user_one'];
                        $role_label = user::find()->where(['=', 'id', $id1])->one();
                        if($role_label)
                             $sql = "SELECT * FROM session where ((user_id = :userid) and (last_write ) > (:now - 1800))"; 
                         $command = Yii::$app->db->createCommand($sql);
                      $command->bindValue(':userid', $id1);
                      $command->bindValue(':now', time());
                      $res=$command->queryAll();
                       $sql1 = "SELECT * FROM messages where (((new_from = 0 ) or (new_to = 0)) and ((user_from = :userid) or (user_to = :userid)))"; 
                         $command1 = Yii::$app->db->createCommand($sql1);
                      $command1->bindValue(':userid', $id1);
                      $res1=$command1->queryAll();
                      $new = count($res1);
                      if($res)
                        $status = "<div style='float:right;color:green'> online </div>";
                      else 
                        $status = "<div style='float:right;color:red'> offline </div>";
                      echo "<a href='message?id={$role_label->id}'><li> {$role_label->name}$status</li></a>";
                    }