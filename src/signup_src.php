<?php

if(isset($_POST['submit'])){ //if user pressed submit button, assign input values to variables
    $first = $_POST['first'];
    $last = $_POST['last'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $pwd = $_POST['pwd'];
    $pwdconfirm = $_POST['pwdconfirm'];

    require_once './dbh_src.php'; //database handler script
    require_once './functions_src.php'; //error check functions script

    if(emptyInputSignUp($first,$last,$email,$username,$pwd,$pwdconfirm) !== false){ //check if any input is empty
        header('location: ../signup.php?error=emptyinput');
        exit();
    }
    if(invalidUsername($username) !== false){ //check if username is invalid
        header('location: ../signup.php?error=invalidusername');
        exit();
    }
    if(invalidEmail($email) !== false){ //check if email is invalid
        header('location: ../signup.php?error=invalidemail');
        exit();
    }
    if(pwdNotMatch($pwd,$pwdconfirm) !== false){ //check if passwords match
        header('location: ../signup.php?error=passwordsdontmatch');
        exit();
    }
    if(usernameExists($conn,$username,$email) !== false){ //this needs the connection to database to check if user exists already
        header('location: ../signup.php?error=usernametaken');
        exit();
    }

    createUser($conn, $first, $last, $email, $username, $pwd); //no errors, then insert to db

} else {
    header('location: ../signup.php'); //if user did not press submit, redirect to signup page
}