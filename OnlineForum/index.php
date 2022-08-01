<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iDiscuss | Coding Forum</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <!-- Including Header -->
    <?php include "Partials/_dbconnect.php" ?>
    <?php include "Partials/_header.php" ?>

    <div class="container">
        <div class="landing">
            
            <div>
                <h1>iDiscuss</h1>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Aliquam iure nostrum iusto vero pariatur?
                </p>
            </div>
            <img src="bg.jpg" alt="">

        </div>

        <h2 class="text-center">iDiscuss -Browse Categories</h2>
<!-- Categories Container  -->
        <div class="row">
            <!-- Fetch All the categories  -->
            <?php
             $sql = "SELECT * FROM `categories`" ;
             $result = mysqli_query( $connect, $sql);
            //   Loop to iterate the categries from the database
            $category_count=0; //Variable for categories count 
             while($row = mysqli_fetch_assoc($result)){
                //  echo $row['Category_ID']. " " . $row['Category_Name'] ." : ". $row['Category_Description'] . "<br>"; //Fetching categories from database
                $category_count++;
                $catID = $row['Category_ID'];
                $category = $row['Category_Name'];
                $catDescription = $row['Category_Description'];
                echo '<div class="card">
                <img src="1.jpg" alt="" class="category-img">
                <h3><a href="threadsList.php?catID=' . $catID . '">' . $category . '</a></h3>
                <p>' . substr($catDescription, 0, 30) . '.....</p>
                <a href="threadsList.php?catID=' . $catID .'"><button type="button" class="card-btn">View Threads</button></a>
            </div>';

            if($category_count>4){
                echo '<a href="categories.php">Load More</a>';
                exit;
            }
             }
            ?>
        </div>
    </div>

    <!-- Including Footer -->
    <?php include "Partials/_footer.php" ?>
</body>

</html>