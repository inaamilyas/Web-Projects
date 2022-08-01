<?php
$showAlert = false;
$showError = false;
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include "partials/_dbconnect.php";
    $username = $_POST["username"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];

    $exists = false;
    if(($password == $confirmPassword) && $exists == false){
        $sql = "INSERT INTO `users` (`Name`, `Password`, `Date`) VALUES ( '$username', '$password', current_timestamp())";
        $result = mysqli_query($connect, $sql);
        if($result){
            $showAlert = true;
        }
    }
    else{
        $showError = "Password don't match";
    }
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iSecure | SignUp</title>
    <link rel="stylesheet" href="partials/style.css">
</head>
<body>
    <?php require "partials/_nav.php"; ?>
    
    <?php
    if($showAlert){
        echo "Sign in successfully<br>";
    }
    if($showError){
        echo $showError;
    }
    ?>

    <div class="container">
        <h1 class="t-center">Sign Up To Our Website</h1>
        <form action="/PHP/LOGINSYSTEM/signup.php" method="post" class="form">
            <input type="text" name="username" placeholder="Enter UserName" required>
            <input type="password" name="password" placeholder="Enter password" required>
            <input type="password" name="confirmPassword" placeholder="Confirm password" required>
            <input type="submit" placeholder="SignUp">
        </form>
    </div>
</body>
</html>