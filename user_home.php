<?php
session_start();
if(isset($_SESSION['username']) && $_SESSION['username'] == "admin") {  
    header("location:admin.php");
    exit; 
} else {   
    header("location:home.php");
}
?>
