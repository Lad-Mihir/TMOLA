<?php
define('Server', 'Localhost');
define('Password', 'TMOLA@54321');
define('Username', 'tmolasit_Admin');
define('DatabaseName', 'tmolasit_Main');

//connect to DB
global $conn;
static $conn;
$conn = mysqli_connect(Server, Username, Password, DatabaseName);

//check for the connection 
if (!$conn) {
    echo "DatabeError";
}
?>