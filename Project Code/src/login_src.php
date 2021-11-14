<?php
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];

    require_once 'dbh_src.php';
    require_once 'functions_src.php';

    if(emptyInputLogin($username,$pwd) !== false){ //check if any input is empty
        header('location: ../login.php?error=emptyinput');
        exit();
    }

    loginUser($conn, $username, $pwd);
} 
else { //user accessed this script without clicking on submit
    header('location: ../login.php');
    exit(); //exit the script
}