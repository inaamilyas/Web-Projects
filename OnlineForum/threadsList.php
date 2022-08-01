<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iDiscuss | Threads List</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleThreadsList.css">
</head>

<body>

    <!-- Including Header -->
    <?php include "Partials/_header.php" ?>
    <?php include "Partials/_dbconnect.php" ?>
    <?php
    $catID = $_GET['catID'];
    $sql = "SELECT * FROM `categories` WHERE Category_ID = $catID" ;
    $result = mysqli_query( $connect, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $category_Name = $row['Category_Name'];
        $category_Description = $row['Category_Description'];
    }
    ?>

    <?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        $thread_Title = $_POST['ThreadTitle'];
        // Saving from XSS attack
        $thread_Title = str_replace("<", "@lt", $thread_Title);
        $thread_Title = str_replace(">", "@gt", $thread_Title);

        $thread_Description = $_POST['ThreadDescription'];
        // Saving from XSS attack
        $thread_Description = str_replace("<", "@lt", $thread_Description);
        $thread_Description = str_replace(">", "@gt", $thread_Description);

        $thread_User_ID = $_POST['User_ID'];
        if($thread_Title != NULL && $thread_Description != NULL){
            $sql = "INSERT INTO `threads` (`Thread_Title`, `Thread_Description`, `Thread_User_ID`, `Thread_Category_ID`, `Timestamp`) VALUES ('$thread_Title', '$thread_Description', '$thread_User_ID', '$catID', current_timestamp())";
            $result = mysqli_query($connect, $sql);
        }
        else{
            // echo "Record was not inserted";
        }
        $showAlert = true;
    }
    ?>


    <div class="container">
        <h1>Welcome to <?php echo $category_Name; ?> Forum</h1>
        <p><?php echo $category_Description; ?></p>

        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima quia, reiciendis consequatur soluta, tenetur
            odit dolore doloremque exercita</p>
        <a href="#" type="button">Learn More</a>
    </div>

<?php

if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
    echo '<div class="container container4">
        <h1>Start a Discussion</h1>
        <form href="' . $_SERVER["REQUEST_URI"] . '" method="post" class="discussionForm">
            <label for="ThreadTitle">Thread Title</label>
            <input type="text" name="ThreadTitle" id="ThreadTitle" placeholder="Enter your thread title">
            <label for="ThreadDescription">Thread Description</label>
            <textarea name="ThreadDescription" id="ThreadDescription" cols="20" rows="5" placeholder="Enter your Thread description here"></textarea>
            <input type="submit" name="submit" id="submit">
            <input type="hidden" name="User_ID" id="User_ID" value="'.$_SESSION['User_ID'].'"><input type="hidden" name="User_ID" id="User_ID" value="'.$_SESSION['User_ID'].'">
        </form>
    </div>';
} 
else{
    echo '<div class="container container4 blur">
    <h1><a href="_loginForm.php" style="font-size: 50px; text-decoration: none;">Signin</a> to Start Discussion</h1>
    </div>';
}
?>

    <div class="container2">
        <h1>Browse Questions</h1>

    <?php
    $catID = $_GET['catID'];
    $sql = "SELECT * FROM `threads` WHERE Thread_category_ID = $catID";
    $result = mysqli_query( $connect, $sql);
    $noResult = true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $thread_ID = $row['Thread_ID'];
        $thread_Title = $row['Thread_Title'];
        $thread_Description = $row['Thread_Description'];
        $thread_Time = $row['Timestamp'];
        $thread_User_ID = $row['Thread_User_ID'];
        // echo "Thread user id = ". $thread_User_ID;
        $sql2 = "SELECT * FROM `users` WHERE User_ID=$thread_User_ID";
        $result2 = mysqli_query($connect, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        // echo "<br>User email is ". $row2['User_Email'];


        echo '<div class="questions-box">
             <div class="user">
                 <img src="user.png" alt="">
             </div>
             <div class="question">
                 <a href="thread.php?thread_ID=' .$thread_ID. '"><h3>'.$thread_Title.'</h3></a>
                 <p style="font-weight: bold; font-size: 10px; text-decoration: underline;" >' . $row2['User_Email'] . ' '.$thread_Time.'</p>
                 <p>'.$thread_Description.'</p>
             </div>
         </div>';
    }
    if($noResult == true){
        echo '<div class="container3">
            <p>No related discussion for this category</p>
            <p>Be the first to ask question?</p>
        </div>';
    }
    ?>

    </div>

    <!-- Including Footer -->
    <?php include "Partials/_footer.php" ?>
</body>

</html>