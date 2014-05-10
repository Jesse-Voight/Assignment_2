<?php
include('dbConnect.php');
$addDate = time();
if(isset($_POST['Topic']) and isset($_POST['Message'])){
$updateQuery = "UPDATE {$tableName} SET idNotes='{$_GET['noteID']}', topic='{$_POST['Topic']}', dateCreated='{$_GET['dc']}', dateEdited='{$addDate}',notes='{$_POST['Message']}' WHERE idNotes = '{$_GET['noteID']}';";
$status = mysql_select_db($databaseName, $connection);
$result = mysql_query($updateQuery);
if(!$result){
    print mysql_error($connection);
    die();
}
}
else{
    print "Error: POST data lost during navigation <br/>";
    print "<a href='/assignment_2/index.php'>Back to Homepage</a>";
}
header("Location:http://{$_SERVER["HTTP_HOST"]}/assignment_2/index.php");
?>
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

