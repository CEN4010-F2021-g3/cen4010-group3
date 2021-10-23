<?php //DON'T FORGET php tag
function emptyInputSignUp($first, $last, $email, $username, $pwd, $pwdconfirm){
    $result = false;
    if(empty($first) || empty($last) || empty($email) || empty($username) || empty($pwd) || empty($pwdconfirm)){
        $result = true;
    }
    return $result;
}

function invalidUsername($username){
    $result = false;
    if(!preg_match('/^[a-zA-Z0-9]*$/',$username)){
        $result = true; //if username is invalid return true
    }
    return $result;
}

function invalidEmail($email){
    $result = false;
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $result = true; //if email is invalid return true
    }
    return $result;
}

function pwdNotMatch($pwd,$pwdconfirm){ 
    $result = false;
    if($pwd !== $pwdconfirm){ //return true if pwd and pwdconfirm do not match
        $result == true;
    }
    return $result;
}

function usernameExists($conn,$username, $email){ //used for signup and login
    $result = true;
    $sql = "SELECT * FROM users WHERE usersName = ? OR usersEmail = ?;";
    $stmt = mysqli_stmt_init($conn); //Initializing prepared statement which will prevent sql injection
    if(!mysqli_stmt_prepare($stmt, $sql)){ //check if stmt failed
        header('location: ../signup.php?error=stmtfailed');
        exit();
    }
    mysqli_stmt_bind_param($stmt,'ss',$username,$email); //second parameter is number of strings (ss since we are passing usersName and usersEmail)
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);
    if($row = mysqli_fetch_assoc($resultData)){
        return $row; //if user exists return the row of users table which will be used for LOGIN
        //this line is the reason we check in signup_src.php and login_src.php if values are !== false. True is never returned in this case.
    }
    mysqli_stmt_close($stmt);
    $result = false;
    return $result; //returns false if username or email does not exist in db (WE WANT THIS FOR SIGNUP)
}

function createUser($conn,$first,$last,$email,$username,$pwd){
    $result = false;
    $sql = "INSERT INTO users(usersFirst,usersLast,usersEmail,usersName,usersPwd) VALUES(?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn); //Initializing prepared statement which will prevent sql injection
    if(!mysqli_stmt_prepare($stmt, $sql)){ //check if stmt failed
        header('location: ../signup.php?error=stmtfailed');
        exit();
    }
    $hashedPwd = password_hash($pwd,PASSWORD_DEFAULT);
    mysqli_stmt_bind_param($stmt,'sssss', $first,$last,$email,$username,$hashedPwd);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location: ../signup.php?error=none');
    exit();
}

function emptyInputLogin($username, $pwd){
    $result = false;
    if(empty($username) || empty($pwd)){
        $result = true;
    }
    return $result;
}

function loginUser($conn, $username, $pwd){
    $usernameExists = usernameExists($conn,$username,$username); //pass username twice because usernameExists selects if username or email are in table users
    if($usernameExists == false){
        header('location: ../login.php?error=wronglogin');
        exit();
    }
    $pwdHashed = $usernameExists['usersPwd']; //function usernameExists() returns an associative array if given username exists
    $checkPwd = password_verify($pwd, $pwdHashed); //will return true if hashed pwd from db is equal to given pwd
    if($checkPwd === false){
        header('location: ../login.php?error=wronglogin');
    }
    else if($checkPwd == true){
        session_start();
        $_SESSION['userid'] = $usernameExists['usersId']; //variable usernameExists contains the row in db of user
        $_SESSION['username'] = $usernameExists['usersName'];
        $_SESSION['userfirst'] = $usernameExists['usersFirst'];
        $_SESSION['userlast'] = $usernameExists['usersLast'];
        $_SESSION['useremail'] = $usernameExists['usersEmail'];
        $_SESSION['useradmin'] = $usernameExists['usersAdmin'];
        header('location: ../index.php?info=Loggedin');
        exit();
    }
}

function isAdmin(){
    if($_SESSION['useradmin'] == 1) {return true;}
    else {return false;}        
}