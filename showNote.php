<html><head></head><body>
        <?php
        print '<h2>Show Note</h2>';
        include('dbConnect.php');
        if (isset($_GET['noteID'])) {
            $noteID = $_GET['noteID'];
            $query = "Select * From notes Where idNotes = {$noteID}";
            $result = mysql_query($query);
            if ($row = mysql_fetch_row($result, MYSQLI_ASSOC)) {
                $convTime = convertUnixTime($row['dateEdited']);
                print "<font face='verdana'><h1>{$row['topic']}</h1></font></br>";
                print "<center><table border='1' width='800px'><tr><td>{$row['notes']}</tr></td></table></center>";
                print "<center>Last Edited ~ {$convTime}<center>";
            }
        }
       print "<center><br/><br/><a style='font-size: 26pt;'  href='index.php'>Home</a></center>"
        ?>
    </body>
</html>
