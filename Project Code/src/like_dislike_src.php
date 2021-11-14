<?php
require_once './dbh_src.php';
session_start();
$user_id = $_SESSION['userid'];
$post_id = $_POST['post_id'];
$post_slug = $_POST['post_slug'];
$isLiked = 0; //declare isLiked variable
if(isset($_POST['like-button'])){
    $isLiked = 1;
    echo "liked post";
} else if(isset($_POST['dislike-button'])){
    $isLiked = 0;
    echo "disliked post";
} else {
    echo "error";
    return;
}

echo $post_id;

//Check if user has liked or disliked this post
$sql = "SELECT * FROM `post_likes_dislikes` WHERE userId = $user_id AND postId = $post_id";
$result = mysqli_query($conn,$sql);
if(!mysqli_num_rows($result)){
    //if user has not liked or disliked, insert into likes_dislikes table
    $sql = "INSERT INTO post_likes_dislikes(postId,userId,isLiked) VALUES($post_id,$user_id,$isLiked)";
} else {
    //if user has liked or disliked, update the post_likes_dislikes row for the user and given post
    $sql = "UPDATE post_likes_dislikes SET isLiked = $isLiked WHERE postId = $post_id  AND userId = $user_id";
}
$likes_count = 0;
$dislikes_count = 0;
if(mysqli_query($conn,$sql)){
    //if inserting into like_dislike table is successful, update the like and dislike count for the given post's db table
    //update likes count
    $sql = "SELECT COUNT(*) AS likes_count FROM `post_likes_dislikes` WHERE isLiked = 1 AND postId = $post_id";
    $resultData = mysqli_query($conn,$sql);
    $likes_count = mysqli_fetch_assoc($resultData)['likes_count'];
    $sql = "UPDATE post SET likesCount='$likes_count' WHERE id = '$post_id'";
    mysqli_query($conn,$sql);
    //update dislikes count
    $sql = "SELECT COUNT(*) AS dislikes_count FROM `post_likes_dislikes` WHERE isLiked = 0 AND postId = $post_id";
    $resultData = mysqli_query($conn,$sql);
    $dislikes_count = mysqli_fetch_assoc($resultData)['dislikes_count'];
    $sql = "UPDATE post SET dislikesCount='$dislikes_count' WHERE id = '$post_id'";
    mysqli_query($conn,$sql);
} else {
    echo "\nconnection with database failed";
}

mysqli_close($conn);
header("Location: ../single-post.php?post=$post_slug&error=none");