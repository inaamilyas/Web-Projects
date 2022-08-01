<?php
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true){
    $loggedin = true;
}
else{
    $loggedin = false;
}

echo '<nav id="navbar">
    <a href="/PHP/LOGINSYSTEM/welcome.php" class="nav_items"><h1>PHP LOGIN SYSTEM</h1></a>
    <ul>
        <li><a href="/PHP/LOGINSYSTEM/welcome.php" class="nav_items">Home</a></li>';

        if(!$loggedin){
        echo '<li><a href="/PHP/LOGINSYSTEM//login.php" class="nav_items">Login</a></li>
        <li><a href="/PHP/LOGINSYSTEM//signup.php" class="nav_items">Sign Up</a></li>';
        }

        if($loggedin){
        echo '<li><a href="/PHP/LOGINSYSTEM//logout.php" class="nav_items">Logout</a></li>';
        }
    
   echo'</ul>
</nav>';
?>