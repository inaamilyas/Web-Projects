<?php
$showAlert = "fasle";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    include "_dbconnect.php";
    $user_Email = $_POST['signupEmail'];
    $user_Password = $_POST['signupPassword'];
    $Confrim_Password = $_POST['ConfrimPassword'];

    //Check whether this email exist or not
    $exist_sql = "SELECT * FROM `users` WHERE User_Email = '$user_Email'";
    $result = mysqli_query($connect, $exist_sql);
    $num_rows = mysqli_num_rows($result);
    if($num_rows>0){
        $showError = "Email alread exist";
    }
    else{
        if ($user_Password == $Confrim_Password) {
            $hash = password_hash($user_Password, PASSWORD_DEFAULT);
            $sql = "INSERT INTO `users` (`User_Email`, `User_Password`, `Signup_Timestamp`) VALUES ('$user_Email', '$hash', current_timestamp())";
            $result = mysqli_query($connect, $sql);
            if($result){
                $showAlert = true;
                header("Location: ../index.php?signupSuccess=true");
                exit();
            }
        }
        else{
            $showError = "Password don't match";
        }
        header("Location: ../index.php?signupSuccess=false&&error=$showError");
    }
}
?>