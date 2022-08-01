<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iDiscuss | Threads</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleThreadsList.css">
</head>

<body>

    <!-- Including Header -->
    <?php include "Partials/_header.php" ?>
    <?php include "Partials/_dbconnect.php" ?>
    <?php
    $thread_ID = $_GET['thread_ID'];
    $sql = "SELECT * FROM `threads` WHERE Thread_ID = '$thread_ID'" ;
    $result = mysqli_query( $connect, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $thread_Title = $row['Thread_Title'];
        $thread_Description = $row['Thread_Description'];
        $thread_User_ID = $row['Thread_User_ID'];

        //Query users table to get email of User_id thread user ID
        $sql2 = "SELECT * FROM `users` WHERE User_ID='$thread_User_ID'";
        $result2 = mysqli_query($connect, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_By = $row2['User_Email'];
        
    }
    ?>

<?php
    $showAlert = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        $comment_Content = $_POST['comment_Content'];
        // Saving from XSS attack
        $comment_Content = str_replace("<", "&lt", $comment_Content);
        $comment_Content = str_replace(">", "&gt", $comment_Content);
        
        $Comment_By = $_POST['User_ID'];
        if($comment_Content != NULL){
            $sql = "INSERT INTO `comments` (`Comment_Content`, `Thread_ID`, `Comment_By`, `Comment_Time`) VALUES ('$comment_Content', '$thread_ID', '$Comment_By', current_timestamp())";
            $result = mysqli_query($connect, $sql);
        }
        else{
            echo "Record was not inserted";
        }
        $showAlert = true;
    }
    ?>

    <div class="container">
        <h1> <?php echo $thread_Title; ?> </h1>
        <p><?php echo $thread_Description; ?></p>
        <p><Strong>Desclaimer: </Strong>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Impedit at, ab eveniet dolorem similique provident nemo distinctio expedita dolore iste. Tenetur, deleniti numquam.</p>
        <p>Posted by : <b><?php echo $posted_By ?></b></p>
    </div>

<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){
    echo '<div class="container container4 ">
        <h1>Post a Comment</h1>
        <form href="' . $_SERVER["REQUEST_URI"] . '" method="post" class="discussionForm">
            <label for="ThreadDescription">Type your comment</label>
            <textarea name="comment_Content" id="comment" cols="20" rows="5" placeholder="Enter your comment here"></textarea>
            <input type="submit" name="submit" id="submit" value="Post">
            <input type="hidden" name="User_ID" id="User_ID" value="'.$_SESSION['User_ID'].'">
        </form>
    </div>';
}
else{
    echo '<div class="container container4 blur">
    <h1><a href="_loginForm.php" style="font-size: 50px; text-decoration: none;">Signin</a> to Post a Comment</h1>
</div>';
}

?> 

    <div class="container2">
        <h1>Comments</h1>
    <?php
    $thread_ID = $_GET['thread_ID'];
    $sql = "SELECT * FROM `comments` WHERE Thread_ID = $thread_ID";
    $result = mysqli_query( $connect, $sql);
    $noResult = true;
    while($row = mysqli_fetch_assoc($result)){
        $noResult = false;
        $comment_ID = $row['Comment_ID'];
        $comment_Content = $row['Comment_Content'];
        $comment_Time = $row['Comment_Time'];
        $Comment_By = $row['Comment_By'];
        
        $sql2 = "SELECT * FROM `users` WHERE User_ID ='$Comment_By'";
        $result2 = mysqli_query( $connect, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        // echo "User email is ". $row2['User_Email'];
        echo '<div class="questions-box">
             <div class="user">
                 <img src="user.png" alt="">
             </div>
             <div class="question">
                 <p style="font-weight: bold; text-decoration: underline;" >'.$row2['User_Email'] .' '.$comment_Time.'</p>
                 <p>'.$comment_Content.'</p>
             </div>
         </div>';
    }
    if($noResult == true){
        echo '<div class="container3">
            <p>No comments for this thread</p>
            <p>Be the first to add a comment?</p>
        </div>';
    }
    ?>


    </div>

    <!-- Including Footer -->
    <?php include "Partials/_footer.php" ?>
</body>

</html>