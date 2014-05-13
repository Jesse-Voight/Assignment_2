<?php

session_start();
echo "<html><head>";
echo "<style>form{position:fixed;top:38%;left:37%;width:400px;}</style>";
echo "</head><body>";
echo "<link href='style.css' rel='stylesheet' type='text/css' />";
if (isset($_POST['User']) and isset($_POST['Password'])) {
    $userName = $_POST['User'];
    $password = $_POST['Password'];
    if ($userName == "admin" and $password == "n013b0oK") {
        $_SESSION['pw'] = true;
        header("Location:http://{$_SERVER["HTTP_HOST"]}/index.php");
    } else {
        print '<script type="text/javascript">'; 
        print 'alert("Incorrect Password")'; 
        print '</script>';  
    }
}
if (isset($_POST['Leave'])) {
    session_destroy();
    echo "<center><h1>Successfully logged out</h1></center>";
}
print "<form action='login.php' method='post'> 
        <table> 
        <tr><td>User:</td><td><input type='text' name='User' /></td></tr> 
        <tr><td>Password:</td><td><input type='password' name='Password' /></td></tr> 
        <tr><td colspan='2' align='center'><input type='submit' value='Log In'/></td></tr> 
        </table> 
        </form>";
echo "</body></html>";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

