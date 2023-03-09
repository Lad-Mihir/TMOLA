<?php
//include('Header.php');



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forget Password</title>
</head>

<body>
    <h1>Forget Password?</h1>
    <p>If you have already account <a href="index.php"> Login </a></p>
    <p>If you don't have account <a href="Signup.php"> Create Account </a></p><br />

    <form action="index.php" method="POST">
        Email Id: <input type="text" name="forgetemailId"> <br>
        Password: <input type="password" name="forgetuserPassword"><br>
        <input type="submit" name="login" value="Login"><br>

    </form>
</body>
<?php
//include('Footer.php');
?>

</html>