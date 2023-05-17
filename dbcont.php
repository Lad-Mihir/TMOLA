<?php
define('Server', 'Localhost');
define('Password', '');
define('Username', 'root');
define('DatabaseName', 'tmola');

//connect to DB
global $conn;
static $conn;
$conn = mysqli_connect(Server, Username, Password, DatabaseName);

//check for the connection 
if (!$conn) {
    echo "DatabeError";
}
?>