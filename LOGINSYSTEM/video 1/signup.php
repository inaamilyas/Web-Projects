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
    <div class="container">
        <h1 class="t-center">Sign Up To Our Website</h1>
        <form action="/PHP/LOGINSYSTEM/signup" method="post" class="form">
            <input type="text" name="username" placeholder="Enter UserName" required>
            <input type="password" name="password" placeholder="Enter password" required>
            <!-- <small>Enter password again</small> -->
            <input type="password" name="confirmPassword" placeholder="Confirm password" required>
            <input type="submit" placeholder="SignUp">
        </form>
    </div>
</body>
</html>