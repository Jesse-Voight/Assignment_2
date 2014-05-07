<?php

include('dbConnect.php');
echo "<h2>Add note page</h2>";
$query = "SELECT * FROM notes ORDER BY topic";
$result = mysql_query($query);

while ($row = mysql_fetch_array($result, MYSQLI_ASSOC)) {
    $formTime = convertUnixTime($row['dateEdited']);
    echo "<tr>";
    echo "<td>{$row['topic']}</td>";
    echo "<td>{$formTime}</td>";
    echo "</tr>";
    echo "</table>";
    DisplayNameAdditionForm();
}

function DisplayNameAdditionForm() {
    global $this_script;
    print "
    <hr>
    <form method='POST' action='add.php'>
     <input type='hidden' name='cmd' value='add'>
     Topic:  <input type='text' name='name'    size='20'/><p>
     Message: <textarea type='text' name='address' size='20'></textarea><p>
     <input type='submit' value='  Add  ' name='B1'><p>
     </form>
  ";
}
?>

