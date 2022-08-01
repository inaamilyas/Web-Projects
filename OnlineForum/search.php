<!-- ALTER TABLE threads ADD FULLTEXT(`Thread_Title` ,`Thread_Description`); //Enabling search functionality
SELECT * FROM `threads` WHERE MATCH (`Thread_Title`, `Thread_Description`) against ('install'); // Query to match records -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>iDiscuss | Coding Forum</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="styleThreadsList.css">
    <style>
        .container {
            min-height: 82vh;
            width: 70%;
            margin: 10px auto;
            padding: 10px;
        }
        .container ol li{
            margin: 10px 0;
        }
    </style>
</head>

<body>

    <!-- Including Header -->
    <?php include "Partials/_dbconnect.php" ?>
    <?php include "Partials/_header.php" ?>


    <div class="container">
        <h1>Search results for " <em>
            <?php echo $_GET['search']; ?>  </em>"
        </h1>
        <ol>
    <?php
    $noResult = false;
    $searchTerm = $_GET['search'];
    $sql = "SELECT * FROM `threads` WHERE MATCH (`Thread_Title`, `Thread_Description`) against ('$searchTerm')" ;
    $result = mysqli_query( $connect, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $thread_Title = $row['Thread_Title'];
        $thread_Description = $row['Thread_Description'];
        $thread_ID = $row['Thread_ID'];
        $url = "thread.php?thread_ID=$thread_ID";
        $noResult = true;

        //Display search results
        echo '<li>
            <div class="result">
                <h4> <a href="'.$url.'">'. $thread_Title .'</a> </h4>
                <p>' . $thread_Description . ' </p>
            </div>
        </li>';
        }
        if($noResult == false){
            echo '<div class="container3">
                <p>No results found</p>
            </div>';
        }
    ?>
    </ol>
    </div>

    <!-- Including Footer -->
    <?php include "Partials/_footer.php" ?>
</body>

</html>