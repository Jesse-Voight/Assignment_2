<?php
session_start();
#declare varriables
$tableName = "notes";
$databaseName = "notebook";
echo "<link href='style.css' rel='stylesheet' type='text/css' />";

$connection = mysql_connect("localhost", "assignment2", "winning") or die("Database connection to MySql server could not be established");

$status = mysql_select_db($databaseName, $connection);

if (!$status) {
    $createDB = mysql_query("CREATE DATABASE $databaseName", $connection);
    if ($createDB) {
        print("Created initial database $databaseName. <br/>");
        $status = mysql_select_db($databaseName, $connection);
        if (!$status) {
            die("Couldnt open $databaseName - fatal error" . mysql_error());
        } else {
            print("Creation of database $databaseName worked. <br/>");
        }
    }
}

$connectTable = mysql_query("SHOW TABLES;");
if (!$connectTable) {
    print mysql_error();
}

$tableCount = mysql_num_rows($connectTable);
if ($tableCount == 0) {
    $createTableSchema = mysql_query("CREATE TABLE {$tableName} (idNotes INT NOT NULL AUTO_INCREMENT,topic VARCHAR(255) NULL,dateCreated INT(11) NULL,dateEdited INT(11) NULL,notes TEXT NULL, PRIMARY KEY (idNotes));") or die(print mysql_error());
    print "Created table schema {$tableName}.";
}
$db = mysql_select_db("notebook", $connection) or die("Could not connect to table {$tableName}");

function createTableStart() {

    print "<table id='mytable' cellspacing='0' summary='All topics list'>
                  <tr>
                   <th scope='col' width='500px'>Topic</th>
                   <th scope='col' width='170px'>Last Edit</th>
                   <th scope='col' width='25px'></th>
                   <th scope='col' width='30px'></th>
                  </tr>
               ";
}
function login($credentials,$moe){
    if($credentials == "admin" and $moe = "ttty"){
        return 1;
    }
    else{
        return 0;
    }
}
function convertUnixTime($time) {
    return gmdate("H:i:s d-m-Y ", $time);
}
?>
