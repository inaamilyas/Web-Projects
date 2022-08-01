<?php
session_start();

echo '<header>
<nav id="navbar">
    <div class="nav-left">
    <ul>
            <a href="index.php"><h1>iDiscuss</h1></a>
            <li><a href="index.php">Home</a></li>
            <li><a href="categories.php">Categories</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="about.php">About Us</a></li>
        </ul>
    </div>

    <div class="nav-right">
        <form method="get" action="search.php">
            <input type="text" name="search" id="search" placeholder="Search" class="input-box">
            <button type="submit" class=" search-btn btn">Search</button>
        </form>';
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] = true){
            echo '<p>' . $_SESSION['User_Email'] . '</p>'.
            '<a href="_logout.php"><button name="logout" type="button" class="btn">Logout</button></a>';
        }
        else{
        echo '<a href="_signupForm.php"><button name="signup" type="button" class="btn">Signup</button></a>
        <a href="_loginForm.php"><button name="signin" type="button" class="btn">Signin</button></a>';
        }
    echo'</div>

</nav>
</header>';

if(isset($_GET['signupSuccess']) && $_GET['signupSuccess'] == "true"){
    // echo "yes"; //Add Alert here on signin success
}


?>