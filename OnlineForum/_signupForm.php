<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iDuscuss | Signin</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleLoginSignup.css">
</head>

<body>
    <!-- Including Header -->
    <?php include "Partials/_header.php" ?>
    <div class="container">
        <div class="box">
            <form action="Partials/_handleSignup.php" method="post">
                <div class="email">
                    <p>Enter Email</p>
                    <input type="email" name="signupEmail" id="signupEmail" placeholder="Enter email here">
                </div>

                <div class="email">
                    <p>Enter Password</p>
                    <input type="password" name="signupPassword" id=signupPassword" placeholder="Enter password here">
                </div>

                <div class="email">
                    <p>Confirm Password</p>
                    <input type="password" name="ConfrimPassword" id=ConfirmPassword" placeholder="Enter password here">
                </div>
                <button type="submit">Signup</button>
            </form>
        </div>
    </div>

    <!-- Including Footer -->
    <?php include "Partials/_footer.php" ?>
</body>

</html>