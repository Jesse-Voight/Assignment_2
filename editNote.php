<?php
include('dbConnect.php');

if (isset($_GET['noteID'])){
    $notesID = $_GET['noteID'];
    $query = "Select * From notes Where idNotes = {$notesID}";
    $result = mysql_query($query);
    if (mysql_num_rows($result) == 0){
        echo "No record for $notesID was found in the database";
    }
    while ($row = mysql_fetch_array($result, MYSQLI_ASSOC)) {
    $formTime = convertUnixTime($row['dateEdited']);
    echo "{$row['idNotes']}<br/>";
    echo "{$row['topic']}<br/>";
    echo "{$formTime}<br/>";
    echo "{$row['notes']}<br/>";
    echo "<h2>FIN</h2>";
}
}
?>

