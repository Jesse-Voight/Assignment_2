<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
include('dbConnect.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Assignment_2_Title</title>
    </head>
    <body>
        <h2>Notebook</h2>
        <?php
        session_start();
        createTableStart();

        $query = "SELECT * FROM notes ORDER BY topic";
        $result = mysql_query($query, $connection);
        if (!$result) {
            print "no rows";
        } else {
            while ($row = mysql_fetch_array($result, MYSQLI_ASSOC)) {
                echo "<tr>";
                echo "<td>{$row['topic']}</td>";
                $formTime = convertUnixTime($row['dateEdited']);
                echo "<td>{$formTime}</td>";
                echo "</tr>";
            }
        }
        echo "</table>";

        print "<form method='link' action='addNew.php'>
               <input type='submit' value='New Note'/>
               </form>";
        ?>
    </body>
</html>
