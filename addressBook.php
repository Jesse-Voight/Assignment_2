<?php
#====================================================================================
# Here's a minimal PHP application to add, view and delete entries from
# a MySQL database
#
# Points to Note
#
#   - This code is designed to be hopefully short and easy to follow and therefore
#     has very little error checking.
#
#   - There's only one script and no HTML form.
#       - this script displays what's in the addressbook, then appends forms to let 
#         you add entries and search
#
#   - Before it runs, the user MUST have been set up with rights to create databases
#     (or just 'all' rights in the MySQL server).
# 
#     You can use "phpMyAdmin" from the TOOLS menu in XAMPP's home page to add users
#
# ==================================================================================
# >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>   WARNING  <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
#
#                           THIS IS NOT A SECURE SCRIPT 
#
# It's designed to show command routing in a script - getting data from a user into 
# a database and out again.
# 
# This script is easy to hack using an "SQL INJECTION ATTACK" - malicious use input
# so don't put it or any script based on it on any public webserver without modifying
# it to use one of the following techniques:
#
#   (1) the mysql_real_escape_string() function
#       see http://nz2.php.net/mysql_real_escape_string
#
#   (2) parameterised queries to MySQL 
#       This would be better long term approach 
#       http://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php
#
# The attack won't compromise the server itself, just the data in your database.
#------------------------------------------------------------------------------------
#
# written by Giovanni Moretti - g.moretti@massey.ac.nz (2014)
#
#====================================================================================
# Define the user and site-specific variables
#====================================================================================
  $userName 	  	= "root";
  $password 		= "";
  $hostname 		= "localhost";
  $databaseName 	= "YourUsernameDB";
  $tableName        = "Addressbook";

  $this_script = $_SERVER['SCRIPT_NAME'];

 if (isset($_REQUEST['cmd'])) $cmd = $_REQUEST['cmd'];
 if (!isset($cmd)) $cmd = 'home';   # Make sure there is a command
  
 $myDB = mysql_connect("localhost", $userName, $password); 
 
 if (!$myDB) die("Couldn't establish a connection to MySQL server" . mysql_error()); 

#====================================================================================
# We now have a connection to the MySQL server, 
# Now try to open the "AddressBookDB" database, creating if needed
# When using an ISP (or a Massey Webserver), the database will have been created for you
# If you can't open it, abort with an error message
#====================================================================================
     $status = mysql_select_db($databaseName, $myDB);       # Try selecting the the database

     if (!$status)    # Open failed, assume it wasn't there so try to create it
      { 
         $createdOK = mysql_query("CREATE DATABASE $databaseName", $myDB);
         if ($createdOK) print("Creation of database $databaseName succeeded<p>");
         else    die("Creation of database $databaseName failed:" . mysql_error());
      }
     # Database should exist - Select it
     $status = mysql_select_db($databaseName, $myDB);
     if (!$status) die("Couldn't open $databaseName - fatal error" . mysql_error());

     # Database has been selected
     # Check for the existence of $tableName.  If it doesn't exist, then create it.

     $queryTableStmt = "SHOW TABLES;";
     $result = mysql_query($queryTableStmt, $myDB);  # query the table
     if (!$result) print mysql_error();

     # The following code is simplistic - it assumes the database is ONLY used for 
     # the addressbook, so it's sufficient to check for any tables existing
     
     $numberOfTables = mysql_num_rows($result);  # find no of existing tables
     if ($numberOfTables == 0){                  # if none, create one
       # Create the query as a long (multi-line) string
       $createTableStmt = "CREATE TABLE $tableName
                           (NAME CHAR(255), ADDRESS CHAR(255), PHONE CHAR(255),
                           ID INT PRIMARY KEY AUTO_INCREMENT)";

       $status = mysql_query($createTableStmt, $myDB);  # create the table

       if ($status) echo "Added table $tableName<p>";
       else die("Couldn't add table $tableName failed<p>");
    }


#=======================================================================================
# If we get to here, we have successfully:
                                                   
#  1) connected to the MySQL server
#  2) selected the AddressBookDB database (adding it if necessary) 
       #  3) created the Addressbook table (is necessary)
#
# Database is open and ready for use - See what the user wants to do, but first
# lets a collection of functions.

# In a real application, these would be in another file and loaded with an INCLUDE line

#=======================================================================================
#  SKIP PAST THE FUNCTIONS and continue at the "Main code starts executing here" 
#  which is near the bottom
#
# Note that (after the first time - once the database exists) nothing above this point
# has generated any output, but will have established a connection to the database.

#=======================================================================================
# td() - a tiny function to create a table cell out of some text

function td ($item) {
   return "<td>$item</td>\n"; 
}

#====================================================================================
# Create an anchor tag (a link on a web page). 
#
# Don't try to use the name 'link' as it's used by PHP

function link2 ($url, $whatToDisplay) {
  return "<a href='$url'>$whatToDisplay</a>";
}
#====================================================================================
# Display a Form to search for particular names

function DisplayFindForm() {
  global $this_script;
  print "
    <hr>
    <form method='POST' action='$this_script'>
       <input type='hidden' name='cmd'  value='find'><p>
       <input type='submit' value='  Find names starting with: ' name='B1'>
       <input type='text'   name='findField' size='20'><p>
     </form>
  ";
}

#====================================================================================
# Display a Form to add a new name

#   Note the hidden "cmd" field (with a value of 'add')
#   This hidden field is uploaded with the other fields
#   It lets the script know that the user clicked the "Add" button
#
#   Also a good illustration of a multi-line string (it's all one string)

function DisplayNameAdditionForm() {
  global $this_script;
  print "
    <hr>
    <form method='POST' action='$this_script'>
             <input type='hidden' name='cmd' value='add'>
     Name    <br> <input type='text' name='name'    size='20'><p>
     Address <br> <input type='text' name='address' size='20'><p>
     Phone   <br> <input type='text' name='phone'   size='20'><p>
     <input type='submit' value='  Add  ' name='B1'><p>
     </form>
  ";
}

#====================================================================================
# AddName() - only get here if the command is "add", in which case the fields
#             from the DisplayNameAdditionForm() form will be available.
#====================================================================================
function AddName() {
  global $myDB, $this_script, $tableName;

  $name    = $_POST['name'   ];
  $address = $_POST['address'];
  $phone   = $_POST['phone'  ];

  $query = "insert into $tableName
            values('$name', '$address', '$phone',NULL);"; # NULL is for the key field

  $result = mysql_query($query, $myDB);

  if (!$result) print mysql_error($myDB);
}
#====================================================================================
# DeleteName() -- get here if the user clicked on the DELETE link at the end of a row
#                 Such a link ends with "?cmd=del&id=nnn" 
#                 where the nnn is the row to delete
#====================================================================================
function DeleteName() {
  global $myDB, $this_script, $tableName;
  $id      = $_REQUEST['id'];

  $query = "delete from $tableName where id='$id';";

  $result = mysql_query($query, $myDB);
  if (!$result) print mysql_error($myDB);
}

#====================================================================================
# Frontpage - display all the addressbook entries, unless the cmd is "find".
#             When finding, use the supplied 'name' from the search form to build 
#             an SQL "WHERE" clause.
#====================================================================================

function FrontPage() {
  global $myDB, $this_script, $tableName;

  if (isset($_REQUEST['findField'])) 
       $where = $_REQUEST['findField'];  
  else $where = '';

  $query = "Select id, name, address, phone from $tableName";

  # If there's a name to look for, add the WHERE clause after the "Select id ..." part
  if ($where) $query = $query . " where name like '%$where%'"; 

  $query = $query .";" ; // Add terminating semicolon to the end of the Select line

  # Get the data from the database into $result
  $result = mysql_query($query, $myDB );
  if (!$result) print mysql_error($myDB);

  # Display page header
  print("<h2 style='font-family:arial'>159.352 - PHP/MySQL Address Book Demo</h2>");

  # Display all the names in the database nicely formatted into a table
  print "<table border='1' style='background-color:#ffffcc' width='80%'>\n";

      while ($row =mysql_fetch_object($result)):
         print "<tr>";
           $id = $row->id;
           print td($row->name). td($row->address). td($row->phone) .
                 td(link2($this_script."?cmd=del&id=$id", "Delete"));
         print "</tr>\n";
      endwhile;

  print "<table>\n";

  mysql_free_result($result);    # free result data set memory
  
  # Add the forms for search and addition to the end of the HTML
  print DisplayFindForm();
  print DisplayNameAdditionForm();

}
#===============================================================================
# Main code starts executing here
#===============================================================================
#  The Add and Delete commands don't produce any output, so, after they've 
#  added or deleted the data, redirect the browser to show the home page.

#  This redirection MUST HAPPEN BEFORE the <html> (or anything) is output
#  which is why it's done here, not below

#  I could have just called Frontpage() after AddName() or DeleteName()
#  but I wanted to show an example of browser redirection 

  $done = false;
  switch ($cmd):
    case 'add'  : AddName();     $done = true; break;
    case 'del'  : DeleteName();  $done = true; break;
  endswitch;

  if ($done) {           # tidy up and exit immediately
    mysql_close($myDB);
    header("Location: $this_script");
  }
  
  #  otherwise carry on and output HTML tags 
  #  and generate output
  #
  # That's the end of this PHP fragment (for now) more below
?>  

<!------------------------------- HTML STARTS HERE -----------------------------!>
<html>
<head> 
  <title> 159.352 PHP/MySQL Addressbook Demo</title>
</head>
<body>

<?php
#=================================================================================
# Select an action based on "cmd" (can't be 'add' or 'del')

  switch ($cmd):
    case 'home' : FrontPage()  ; break;   # here they both call Frontpage
    case 'find' : Frontpage()  ; break;   # but generally this won't be the case
  endswitch;

 mysql_close($myDB);  # Close Database connection
?>
</body>
</html>


