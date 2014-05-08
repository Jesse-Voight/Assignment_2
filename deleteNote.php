<?php
include('dbConnect.php');
if (isset($_GET['noteID'])){
$delQuery = "DELETE from {$tableName} WHERE idNotes ={$_GET['noteID']};";
$status = mysql_select_db($databaseName, $connection);
mysql_query($delQuery);
header("Location:http://{$_SERVER["HTTP_HOST"]}/A2/assignment_2/index.php");
}
?>


