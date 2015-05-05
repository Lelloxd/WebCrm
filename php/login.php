<?php
function mssql_escape($str)
{
    if(get_magic_quotes_gpc())
    {
        $str= stripslashes($str);
    }
    return str_replace("'", "''", $str);
}
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['utente']) || empty($_POST['password'])) {
$error = "Username or Password is invalid";
}
else
{
require('connection.php');
// Define $username and $password
$username=$_POST['utente'];
$password=$_POST['password'];
$password=sha1($password);
// Establishing Connection with Server by passing server_name, user_id and password as a parameter
// To protect MySQL injection for Security purpose
/*$username = stripslashes($username);
$password = stripslashes($password);
$username = mssql_escape($username);
$password = mssql_escape($password);*/
// Selecting Database
// SQL query to fetch information of registerd users and finds user match.
$query = sqlsrv_query($conn,"SELECT * FROM Utenti WHERE PasswordWeb='$password' AND MailUser='$username'");
if ($val=sqlsrv_fetch_array($query)) {
$_SESSION['login_user']=$username; // Initializing Session
$_SESSION['login_id']=$val["IdUtente"];
header("location: ../crm/activity.php"); // Redirecting To Other Page
} else {
$error = "Username or Password is invalid";
echo $error;
}
}
sqlsrv_close($conn); // Closing Connection
}
?>