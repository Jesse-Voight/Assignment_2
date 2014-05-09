<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
<?php
include('dbConnect.php');
?>

    <head>
        <meta charset="UTF-8">
        <title>Assignment 2 Welcome Page</title>
    </head>
    <body>
    <frame src="login.php">
        <h2>Notebook</h2>
        <?php
        createTableStart();
        if(isset($_SESSION["password"])){
            
            print "WOOOOOOOOOOOOOOOOOOOOOO";
        }

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
                echo ">{$row['topic']}</td>";
                $formTime = convertUnixTime($row['dateEdited']);
                echo "<td";
                if($oddRow){echo " class='alt'";}
                echo ">{$formTime}</td>";
                echo "<td";
                if($oddRow){echo " class='alt'";}
                echo "><a href='editNote.php?noteID={$row['idNotes']}' >Edit</a></td>";
                echo "<td";
                if($oddRow){echo " class='alt'";}
                echo "><a href='deleteNote.php?noteID={$row['idNotes']}' onclick='return confirm('Are you sure?');'>Delete</a></td>";
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
