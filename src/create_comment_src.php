<?php
session_start();
if(!isset($_SESSION['username']) || !isset($_POST['submit'])){
    header('Location: ../single-post.php?error=commenterror');
} else{
    require_once './dbh_src.php';
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['userid'];
    $content = $_POST['content'];
    $post_slug = $_POST['post_slug']; //used to redirect the user to selected blog post
    //inserting comment
    $sql = "INSERT INTO post_comment(postId, userId, content) VALUES(?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        header('Location: ../single-post.php?error=commenterror');
        exit();
    }
    mysqli_stmt_bind_param($stmt,'sss',$post_id,$user_id,$content);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: ../single-post.php?post=$post_slug&error=none");
}