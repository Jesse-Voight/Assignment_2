<?php

include('dbConnect.php');
echo "<h2>Edit note</h2>";

if (isset($_GET['noteID'])) {
    $currentTime = time();
    $notesIDLink = $_GET['noteID'];
    $query = "Select * From notes Where idNotes = {$notesIDLink}";
    $result = mysql_query($query);
    if (mysql_num_rows($result) == 0) {
        echo "No record for $notesIDLink was found in the database";
    }
    if ($row = mysql_fetch_row($result, MYSQLI_ASSOC)) {
        $formTime = convertUnixTime($row['dateEdited']);
        echo "Last Edited: {$formTime}<br/>";
        
        print "<form action='updateNote.php?noteID={$notesIDLink}&dc={$row['dateCreated']}' method='post'> 
        <table> 
        <tr><td>Topic:</td><td><input type='text' name='Topic' value='{$row['topic']}' /></td></tr> 
        <tr><td>Message:</td><td><textarea type='text' name='Message' rows='20' cols='150'>{$row['notes']}</textarea></td></tr> 
        <tr><td colspan='2' align='center'><input type='submit' value='Update Note'/></td></tr> 
        </table> 
        </form> ";
    }
}
?>

