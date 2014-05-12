<html><head></head><body>
        <?php
        include('dbConnect.php');
        if (isset($_GET['noteID'])) {
            $noteID = $_GET['noteID'];
            $query = "Select * From notes Where idNotes = {$noteID}";
            $result = mysql_query($query);
            if ($row = mysql_fetch_row($result, MYSQLI_ASSOC)) {
                print "<h1>{$row['topic']}</h1></br>";
                print "{$row['message']}";
            }
        }
        ?>
    </body>
</html>
