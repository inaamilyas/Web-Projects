<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iDiscuss | Catrgories</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleThreadsList.css">
</head>

<body>
    <!-- Connecting to the database  -->
    <?php include "Partials/_dbconnect.php" ?>
    <!-- Including Header -->
    <?php include "Partials/_header.php" ?>

    <?php
    $showAlert = false;
    $category_exist = false;
    $method = $_SERVER['REQUEST_METHOD'];
    if($method == 'POST'){
        $category_Title = $_POST['categoryTitle'];
        // Saving from XSS attack
        $category_Title = str_replace("<", "@lt", $category_Title);
        $category_Title = str_replace(">", "@gt", $category_Title);

        $category_Description = $_POST['categoryDescription'];
        // Saving from XSS attack
        $category_Description = str_replace("<", "@lt", $category_Description);
        $category_Description = str_replace(">", "@gt", $category_Description);

        // $sql = "SELECT * FROM `categories` WHERE Category_Name = '$category_Title'" ;
        //  $result = mysqli_query( $connect, $sql);
        // if(!$result){
            //   Loop to iterate the categries from the database
            // while($row = mysqli_fetch_assoc($result)){
                $sql = "INSERT INTO `categories` (`Category_Name`, `Category_Description`, `Created`) VALUES ('$category_Title', '$category_Description', current_timestamp())";
                $result = mysqli_query($connect, $sql);
            // }
        // }
        // else{
        //     $category_exist = true;
        // }
        $showAlert = true;
    }
    ?>


<h1 class="text-center" style="margin-top:20px; font-size:50px; ">Categories</h1>
    <div class="container">

        <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']== true){

        // <!-- Category form -->
        echo '
            <form class="categoryForm" action="' . $_SERVER["REQUEST_URI"] . '" method="post">
                <label for="category-title">Enter Category Title</label>
                <input type="text" name="categoryTitle" id="categoryTitle" placeholder="Enter title here">';
                echo '<label for="category-title">Enter Category Description</label>
                <input type="text" name="categoryDescription" id="categoryDescription"  placeholder="Enter description here" required>
                <button type="submit" class="card-btn">Add Category</button>
            </form>';
        }
        else{
            echo '<div class="container container4 blur">
            <h1><a href="_loginForm.php" style="font-size: 50px; text-decoration: none;">Signin</a> to Post a Comment</h1>
            </div>';
        }
        ?>
</div>
        <hr>
        <h1 class="text-center">All Categories</h1>
        <div class="row">
            <!-- Fetch All the categories  -->
            <?php
             $sql = "SELECT * FROM `categories`" ;
             $result = mysqli_query( $connect, $sql);
            //   Loop to iterate the categries from the database
             while($row = mysqli_fetch_assoc($result)){
                //  echo $row['Category_ID']. " " . $row['Category_Name'] ." : ". $row['Category_Description'] . "<br>"; //Fetching categories from database

                $catID = $row['Category_ID'];
                $category = $row['Category_Name'];
                $catDescription = $row['Category_Description'];
                echo '<div class="card">
                <img src="1.jpg" alt="" class="category-img">
                <h3><a href="threadsList.php?catID=' . $catID . '">' . $category . '</a></h3>
                <p>' . substr($catDescription, 0, 30) . '.....</p>
                <a href="threadsList.php?catID=' . $catID .'"><button type="button" class="card-btn">View Threads</button></a>
            </div>';
             }
            ?>
        </div>

       
    <!-- </div> -->

    <!-- Including Footer -->
    <?php include "Partials/_footer.php" ?>
</body>

</html>