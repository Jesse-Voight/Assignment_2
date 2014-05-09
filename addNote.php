<?php
include('dbConnect.php');
$addDate = time();

$insQuery = "INSERT into {$tableName} values(NULL,'{$_POST['Topic']}','{$addDate}','{$addDate}','{$_POST['Message']}');";
$status = mysql_select_db($databaseName, $connection);
$result = mysql_query($insQuery);
if(!$result){
    print mysql_error($connection);
    die();
}
header("Location:http://{$_SERVER["HTTP_HOST"]}/A2/assignment_2/index.php");

?>