<?php
$login = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include "partials/_dbconnect.php";
    $username = $_POST["username"];
    $password = $_POST["password"];

    // $sql = "SELECT * FROM `users` WHERE `Name` = '$username' AND`Password` = '$password' ";
    $sql = "SELECT * FROM `users` WHERE `Name` = '$username'";
    $result = mysqli_query($connect, $sql);
    $num = mysqli_num_rows($result);
    if($num == 1){
        while($rows = mysqli_fetch_assoc($result)){
            if(password_verify($password, $rows['Password'])){
                $login = true;
                session_start();
                $_SESSION['loggedin'] = true;
                $_SESSION['username'] = $username;
                header("location: welcome.php"); //function to redirect
            }
            else{
                $showError = "Invalid Credentials";
            }
        }
    }
    else{
        $showError = "Invalid Credentials";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iSecure | Login</title>
    <link rel="stylesheet" href="partials/style.css">
</head>
<body>
    <?php require "partials/_nav.php"; ?>
    
    <?php
    if($login){
        echo "You are logged in"; 
    }
    if($showError){
        echo $showError;
    }
    ?>

    <div class="container">
        <h1 class="t-center">Signin To Our Website</h1>
        <form action="/PHP/LOGINSYSTEM/login.php" method="post" class="form">
            <input type="text" name="username" placeholder="Enter UserName" required>
            <input type="password" name="password" placeholder="Enter password" required>
            <input type="submit" placeholder="Login">
        </form>
    </div>
</body>
</html>