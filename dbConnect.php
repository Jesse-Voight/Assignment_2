<?php

#declare varriables
$tableName = "notes";
$databaseName = "notebook";
#

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

    print "<table id='mytable' cellspacing='0' border='1px' summary='All topics list'>
                  <tr>
                   <th scope='col' width='400px'>Topic</th>
                   <th scope='col' width='140px'>Last Edit</th>
                  </tr>
               ";
}

function convertUnixTime($time) {
    return gmdate("H:i:s Y-m-d ", $time);
}

?>
