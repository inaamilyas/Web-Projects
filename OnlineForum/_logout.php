<?php
echo "Logging you out";
session_start();
session_destroy();
header("Location: /PHP/OnlineForum/")


?>