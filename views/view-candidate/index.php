<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\ActiveForm;
use app\models\Job;
use sanex\simplefilter\SimpleFilter;
use app\models\MySession;

/* @var $this yii\web\View */
/* @var $searchModel app\models\Candidatesearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Candidates';

?>


<div class="candidate-index">

    <h1><?= Html::encode($this->title) ?></h1>
<div class="location">
Filter By Location:
<label style="font-weight: 300">  <input type="checkbox" name="location" value="delhi" id="delhi" class="filters"> Delhi</label>
<label style="font-weight: 300"><input type="checkbox" name="location" value="chennai" id="chennai" class="filters"> chennai</label>
<label style="font-weight: 300"><input type="checkbox" name="location" value="bangalore" id="bangalore" class="filters"> Bangalore</label>
<label style="font-weight: 300"><input type="checkbox" name="location" value="pune" id="pune" class="filters"> Pune</label><br>
</div>
<div class="ski" >
<br>
Filter By skills:

<label style="font-weight: 300"><input type="checkbox" name="skills" value="java" id="java" class="skills"> Java</label>
<label style="font-weight: 300"><input type="checkbox" name="skills" value="php" id="php" class="skills"> PHP</label>
</div>
</div>
<br>
<div id="txtHint">
<?php //$req = yii::$app->request;
//$rid1 = $req->get('rid');
//$rid1= $rid;
//print_r($rid);exit;
 ?>
    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

           
            'name',
            
            'location',
             'experience',
             'skills',
             [
            'label'    =>    'status',
            'format'=>'raw',
                'value' => function($data1){
                    $query = MySession::find()->where(['=','user_id',$data1->candidate_id])->all();
                    if($query) {

                        // 'contentOptions'=>['style'='color=green'],
                        $req = yii::$app->request;
                        $rid = $req->get('rid');
                        return "<a href='/message/conversations?recid=$rid&senid=$data1->candidate_id' style='color:green;'>online </a>";
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
    ]); ?>

    </div>
    
    
</div>





<?php 
$js=" 
    var category_list = [];
            var skill = [];

            $('.filters').on('change', function(){
            category_list=[];
            $('.location :input:checked').each(function(){
              var category = $(this).val();

                if ($.inArray(this.name,category_list) == -1){
                    category_list.push(category);//Push each check item's value into an array
                }

               
              });
            if (window.XMLHttpRequest) {
                     // code for IE7+, Firefox, Chrome, Opera, Safari
                     xmlhttp = new XMLHttpRequest();
                 } else {
                     // code for IE6, IE5
                     xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
                 }
              
                 xmlhttp.onreadystatechange = function() {
                     if (this.readyState == 4 && this.status == 200) {
                         document.getElementById('txtHint').innerHTML = this.responseText;
                     }
                 };
                 xmlhttp.open('GET','/view-candidate/getuser?q='+category_list+'&skills='+skill,true);
                 xmlhttp.send();
               })

                $('.skills').on('change', function(){
            skill=[];
            $('.ski :input:checked').each(function(){
              var sk = $(this).val();

                if ($.inArray(this.name,skill) == -1){
                    skill.push(sk);//Push each check item's value into an array
                }

               
              });
            if (window.XMLHttpRequest) {
                     // code for IE7+, Firefox, Chrome, Opera, Safari
                     xmlhttp = new XMLHttpRequest();
                 } else {
                     // code for IE6, IE5
                     xmlhttp = new ActiveXObject('Microsoft.XMLHTTP');
                 }
              
                 xmlhttp.onreadystatechange = function() {
                     if (this.readyState == 4 && this.status == 200) {
                         document.getElementById('txtHint').innerHTML = this.responseText;
                     }
                 };
                 xmlhttp.open('GET','/view-candidate/getuser?q='+category_list+'&skills='+skill,true);
                 xmlhttp.send();
       })"


               ;
        $this->registerJs($js);
?>