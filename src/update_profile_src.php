<?php
if(isset($_POST['submit'])){
    //if(!(isset($_POST[]))
    session_start();
    $username = $_SESSION['username'];
    require_once './dbh_src.php';
    $sql = "SELECT usersFirst,usersLast,usersEmail,usersBio,usersImg FROM users WHERE usersName='$username'";
    $resultData = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($resultData);
    //Check if optional fields are empty, set to db query results
    if($_POST['firstname'] == ''){
        $firstname = $row['usersFirst'];
    } else {
        $firstname = $_POST['firstname'];
    }
    if($_POST['lastname'] == ''){
        $lastname = $row['usersLast'];
    } else {
        $lastname = $_POST['lastname'];
    }
    if($_POST['email'] == ''){
        $email = $row['usersEmail'];
    } else {
        //check if email already exists
        require_once 'functions_src.php';
        if(usernameExists($conn,$_POST['email'],$_POST['email']) !== false){
            //TODO show error message in profile.php
            header('Location: ../profile.php?username='.$username.'&err=emailExists');
        }else{
            $email = $_POST['email'];
        }
    }
    if($_POST['biography'] == ''){
        $biography = $row['usersBio'];
    } else {
        $biography = $_POST['biography'];
    }
    //validating image file
    $fileName = $_FILES["img_file"]["name"];
    $fileTmpName = $_FILES["img_file"]["tmp_name"];
    $fileSize = $_FILES["img_file"]["size"];
    $fileError = $_FILES["img_file"]["error"];
    $fileType = $_FILES["img_file"]["type"];

    $fileExt = explode('.',$fileName);
    $fileActualExt = strtolower(end($fileExt));

    $allowed = array("jpg","png","jpeg","bmp","gif");

    if($fileName == "" || $fileSize <= 0){ //if image not selected, use existing image path
        $filePathDb = $row['usersImg']; 
    }
    elseif(in_array($fileActualExt,$allowed)){
        if($fileError === 0){
            $fileNameNew = "profile_".$username.".".$fileActualExt;
            $filePathDb = 'assets/profile-img/'.$fileNameNew; //Save new path to be saved in DB
            $fileDestination = '../assets/profile-img/'.$fileNameNew;
            unlink("../".$row['usersImg']); //delete previous profile pic
            move_uploaded_file($fileTmpName,$fileDestination); //add new profile pic
        }else{
            echo "There was an error uploading your image";
        }
    }else{
        echo "You cannot upload files/images of this type!";
    }

    $sql = "UPDATE users SET usersFirst=?,usersLast=?,usersEmail=?,usersBio=?,usersImg=? WHERE usersName=?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo "There was an error";
        exit();
    } else{
        mysqli_stmt_bind_param($stmt,'ssssss',$firstname,$lastname,$email,$biography,$filePathDb,$username);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header('Location: ../profile.php?username='.$username.'&err=none');
    }

} else{
    header('Location: ../profile.php?username='.$username);
}