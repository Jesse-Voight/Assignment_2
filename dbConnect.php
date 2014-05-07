<?php

$connection = mysql_connect("localhost", "assignment2", "winning")
        or die("Database connection could not be established");
$db = mysql_select_db("notebook", $connection)
        or die("Could not connect to table 'notes'");

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
