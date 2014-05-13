<html><head></head><body>
        <?php
        include('dbConnect.php');
        if (isset($_GET['noteID'])) {
            $noteID = $_GET['noteID'];
            $query = "Select * From notes Where idNotes = {$noteID}";
            $result = mysql_query($query);
            if ($row = mysql_fetch_row($result, MYSQLI_ASSOC)) {
                print "<font face='verdana'><h1>{$row['topic']}</h1></font></br>";
                print "<table border='1'><tr><td>{$row['message']}</tr></td></table>";
                print "<center>{$row['dateEdited']}<center>";
            }
        }
       print "<center><br/><br/><br/><a href='index.html'>Home</a></center>"
        ?>
    </body>
</html>
