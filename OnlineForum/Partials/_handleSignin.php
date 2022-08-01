<?php
$showAlert = "false";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include "_dbconnect.php";
    $user_Email = $_POST['signinEmail'];
    $user_Password = $_POST['signinPassword'];

    //Check whether this email exist or not
    $exist_sql = "SELECT * FROM `users` WHERE User_Email = '$user_Email'";
    $result = mysqli_query($connect, $exist_sql);
    $num_rows = mysqli_num_rows($result);
    if($num_rows==1){
        $row = mysqli_fetch_assoc($result);
        if (password_verify($user_Password, $row['User_Password'])) {
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['User_ID'] = $row['User_ID'];
            $_SESSION['User_Email'] = $user_Email;
            header("Location: /PHP/OnlineForum/");
            exit();
        }
        else{
            echo "Invalid credentials";
        }
    } 
    else{
        echo "Email doesn't exist";
    }
}
?>