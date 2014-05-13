<?php
include('dbConnect.php');
if(!login){
if (isset($_GET['noteID'])){
$delQuery = "DELETE from {$tableName} WHERE idNotes ={$_GET['noteID']};";
$status = mysql_select_db($databaseName, $connection);
$result = mysql_query($delQuery);
if(!$result){
    print mysql_error($connection);
    die();
}
header("Location:http://{$_SERVER["HTTP_HOST"]}/index.php");
}
}
?>


