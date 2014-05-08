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
        <title>Assignment 2 Welcome Page</title>
    </head>
    <body>
        <h2>Notebook</h2>
        <?php
        session_start();
        createTableStart();

        $query = "SELECT * FROM notes ORDER BY topic";
        $result = mysql_query($query, $connection);
        $oddRow = true;
        if (!$result) {
            print "no rows";
        } else {
            while ($row = mysql_fetch_array($result, MYSQLI_ASSOC)) {
                echo "<tr>";
                echo "<td";
                if($oddRow){echo " class='alt'";}
                echo "><a href=editNote.php?noteID={$row['idNotes']} />{$row['topic']}</td>";
                $formTime = convertUnixTime($row['dateEdited']);
                echo "<td";
                if($oddRow){echo " class='alt'";}
                echo ">{$formTime}</td>";
                echo "</tr>";
                if($oddRow == false){$oddRow=true;}else{$oddRow = false;}
            }
        }
        echo "</table>";

        print "<form method='link' action='addNew.php'>
               <input type='submit' value='New Note'/>
               </form>";
        ?>
    </body>
</html>
