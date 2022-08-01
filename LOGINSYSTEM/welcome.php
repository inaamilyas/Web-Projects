<?php
session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin']!=true){
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iSecure | Wellcome -<?php echo $_SESSION['username'] ?> </title>
    <link rel="stylesheet" href="partials/style.css">
</head>
<body>
    <?php require "partials/_nav.php"; ?>
    <h1 class="t-center">Wellcome -<?php echo $_SESSION['username'] ?></h1>
    <h2>This is welcome.php</h2>
    <h3><a href="logout.php">Click Here</a> to logout</h3>
</body>
</html>