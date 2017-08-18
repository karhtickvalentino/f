<style>
table {
    width: 100%;
    border-collapse: collapse;
}

table, td, th {
    border: 1px solid black;
    padding: 5px;
}

th {text-align: left;}
</style>
<?php
 // $q = $_GET['q'];


  $rows = (new \yii\db\Query())
    ->select([new \yii\db\Expression("*")])
    ->from('candidate')
    ->andwhere(['location' => $q])
    ->all();

// $posts = Yii::$app->db->createCommand('SELECT * FROM candidate WHERE location=bangalore')
//             ->queryAll();

//print_r($q);exit;

echo "<table>
<tr>
<th>name</th>
<th>location</th>

<th>experience</th>
<th>skills</th>
</tr>";
foreach ($rows as $row) {
    echo "<tr>";
    echo "<td>" . $row['name'] . "</td>";
    echo "<td>" . $row['location'] . "</td>";
    echo "<td>" . $row['experience'] ."  years </td>";
    echo "<td>" . $row['skills'] . "</td>";
   
    echo "</tr>";
}
echo "</table>";

?>