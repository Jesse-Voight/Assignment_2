<?php

include('dbConnect.php');
login();
echo "<h2>Add note page</h2>";
$query = "SELECT * FROM notes ORDER BY topic";
$result = mysql_query($query);

echo convertUnixTime(time());
displayNewAdditionForm();


function DisplayNameAdditionForm() {
    global $this_script;
    print "
    <hr>
    <form method='post' action='add.php'>
     <p>Topic:  <input type='text' name='name' size='20'/></p>
     <p> Message: <textarea type='text' name='address' size='20'></textarea></p>
     <input type='submit'>
     </form>";
}
function displayNewAdditionForm(){
    print "<form action='addNote.php' method='post'> 
 <table> 
 <tr><td>Topic:</td><td><input type='text' name='Topic' /></td></tr> 
 <tr><td>Message:</td><td><textarea type='text' name='Message' rows='20' cols='150'></textarea></td></tr> 
 <tr><td colspan='2' align='center'><input type='submit' value='Add Note'/></td></tr> 
 </table> 
 </form> ";
}
?>

